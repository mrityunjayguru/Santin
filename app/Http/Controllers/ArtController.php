<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\ArtImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ArtController extends Controller
{
    public function index(Request $request)
    {
        return view('art.index');
    }

    public function create(Request $request)
    {
        return view('art.create');
    }

    public function edit(Request $request)
    {
        return view('art.bulk-upload');
    }

    // ─── Auto-generate Art ID (ART00001, ART00002, ...) ─────────────────────

    private function generateArtId(): string
    {
        $last = Art::where('art_id', 'like', 'ART%')
            ->orderByRaw('CAST(SUBSTRING(art_id, 4) AS UNSIGNED) DESC')
            ->value('art_id');

        $next = $last ? (int) substr($last, 3) + 1 : 1;

        return 'ART' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }

    // ─── Convert share URLs to direct download URLs ───────────────────────────

    private function resolveDirectUrl(string $url): string
    {
        // Google Drive: https://drive.google.com/file/d/FILE_ID/view
        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://drive.google.com/uc?export=download&id=' . $m[1];
        }

        // Google Drive: https://drive.google.com/open?id=FILE_ID
        if (preg_match('/drive\.google\.com\/open\?id=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://drive.google.com/uc?export=download&id=' . $m[1];
        }

        // Dropbox: change dl=0 to dl=1
        if (str_contains($url, 'dropbox.com')) {
            return preg_replace('/[?&]dl=0/', '', $url) . (str_contains($url, '?') ? '&dl=1' : '?dl=1');
        }

        // Direct URL — return as-is
        return $url;
    }

    // ─── Detect image extension from URL or content ───────────────────────────

    private function detectExtension(string $url, string $content): string
    {
        // Try from URL path first
        $path = parse_url($url, PHP_URL_PATH);
        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return $ext;
        }

        // Detect from file content (magic bytes)
        $bytes = substr($content, 0, 4);
        if (str_starts_with($bytes, "\xFF\xD8")) return 'jpg';
        if (str_starts_with($bytes, "\x89PNG"))  return 'png';
        if (str_starts_with($bytes, 'GIF8'))     return 'gif';
        if (str_starts_with($bytes, 'RIFF'))     return 'webp';

        return 'jpg'; // default
    }

    // ─── Bulk CSV Upload ──────────────────────────────────────────────────────

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'file'     => 'required|file|mimes:csv,txt',
            'images.*' => 'nullable|file|image|max:10240', // optional actual image files
        ]);

        $handle = fopen($request->file('file')->getRealPath(), 'r');
        fgetcsv($handle); // skip header

        $inserted   = 0;
        $duplicates = [];
        $errors     = [];
        $rowNumber  = 1;

        // Index uploaded image files by original filename for quick lookup
        $uploadedFiles = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $uploadedFiles[$file->getClientOriginalName()] = $file;
            }
        }

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            if (empty(array_filter($row))) continue;

            // CSV column order (art_id is auto-generated):
            // 0:artist | 1:images(comma-sep filenames) | 2:title  | 3:type
            // 4:size   | 5:frame  | 6:date | 7:location
            // 8:ownership | 9:inventory_status | 10:bundle | 11:pkg_quantity | 12:notes
            $artist          = trim($row[0]  ?? '');
            $imagesRaw       = trim($row[1]  ?? '');
            $title           = trim($row[2]  ?? '');
            $type            = trim($row[3]  ?? '');
            $size            = trim($row[4]  ?? '');
            $frame           = trim($row[5]  ?? '');
            $date            = trim($row[6]  ?? '') ?: null;
            $location        = trim($row[7]  ?? '');
            $ownership       = trim($row[8]  ?? '');
            $inventoryStatus = trim($row[9]  ?? '');
            $bundle          = trim($row[10] ?? '') !== '' ? (int) $row[10] : null;
            $pkgQuantity     = trim($row[11] ?? '') !== '' ? (int) $row[11] : null;
            $notes           = trim($row[12] ?? '');

            // Duplicate check: artist + title
            if (Art::where('artist', $artist)->where('title', $title)->exists()) {
                $duplicates[] = compact(
                    'artist',
                    'title',
                    'type',
                    'size',
                    'frame',
                    'date',
                    'location',
                    'ownership',
                    'inventoryStatus',
                    'bundle',
                    'pkgQuantity',
                    'notes',
                    'imagesRaw'
                );
                continue;
            }

            // ── Insert art record ──────────────────────────────────────────
            try {
                $art = Art::create([
                    'art_id'           => $this->generateArtId(),
                    'artist'           => $artist,
                    'title'            => $title,
                    'type'             => $type,
                    'size'             => $size,
                    'frame'            => $frame,
                    'date'             => $date,
                    'location'         => $location,
                    'ownership'        => $ownership,
                    'inventory_status' => $inventoryStatus,
                    'bundle'           => $bundle,
                    'pkg_quantity'     => $pkgQuantity,
                    'notes'            => $notes,
                ]);
            } catch (\Exception $e) {
                $errors[] = [
                    'row'     => $rowNumber,
                    'artist'  => $artist,
                    'title'   => $title,
                    'stage'   => 'DB Insert',
                    'message' => $e->getMessage(),
                ];
                continue;
            }

            // ── Upload images to S3 ────────────────────────────────────────
            $imageErrors = [];

            if ($imagesRaw !== '') {
                $imageNames = array_filter(array_map('trim', explode(',', $imagesRaw)));

                foreach ($imageNames as $imageName) {
                    try {
                        $s3Path = null;

                        // Check if it's a URL (Google Drive, Dropbox, direct image URL)
                        if (filter_var($imageName, FILTER_VALIDATE_URL)) {
                            // Convert Google Drive share URL to direct download URL
                            $downloadUrl = $this->resolveDirectUrl($imageName);

                            $context = stream_context_create([
                                'http' => [
                                    'timeout'          => 30,
                                    'follow_location'  => true,
                                    'user_agent'       => 'Mozilla/5.0',
                                ],
                                'ssl' => [
                                    'verify_peer'      => false,
                                    'verify_peer_name' => false,
                                ],
                            ]);

                            $imageContent = @file_get_contents($downloadUrl, false, $context);

                            if ($imageContent === false || strlen($imageContent) < 100) {
                                $imageErrors[] = "{$imageName} → Failed to download from URL (check if file is publicly accessible)";
                                continue;
                            }

                            // Detect extension from content or URL
                            $ext      = $this->detectExtension($imageName, $imageContent);
                            $filename = 'image_' . uniqid() . '.' . $ext;
                            $s3Path   = 'arts/' . $art->art_id . '/' . $filename;

                            Storage::disk('s3')->put($s3Path, $imageContent, 'private');
                        } elseif (isset($uploadedFiles[$imageName])) {
                            // Actual file uploaded with form
                            $file   = $uploadedFiles[$imageName];
                            $s3Path = 'arts/' . $art->art_id . '/' . $imageName;
                            Storage::disk('s3')->putFileAs(
                                'arts/' . $art->art_id,
                                $file,
                                $imageName,
                                ['visibility' => 'private']
                            );
                        } else {
                            // Treat as existing S3 key — verify it exists
                            $s3Path = $imageName;
                            if (!Storage::disk('s3')->exists($imageName)) {
                                $imageErrors[] = "{$imageName} → Not found on S3, not uploaded in form, and not a valid URL";
                                continue;
                            }
                        }

                        ArtImages::create([
                            'art_id' => $art->id,
                            'path'   => $s3Path,
                        ]);
                    } catch (\Exception $e) {
                        $imageErrors[] = "{$imageName} → " . $e->getMessage();
                    }
                }
            }

            if (!empty($imageErrors)) {
                $errors[] = [
                    'row'     => $rowNumber,
                    'artist'  => $artist,
                    'title'   => $title,
                    'stage'   => 'S3 Upload',
                    'message' => implode(' | ', $imageErrors),
                ];
            }

            $inserted++;
        }

        fclose($handle);

        return view('art.bulk-upload', [
            'inserted'     => $inserted,
            'duplicates'   => $duplicates,
            'uploadErrors' => $errors,
            'processed'    => true,
        ]);
    }

    // ─── Single Art Image Download (zip all images of one art) ───────────────

    public function downloadSingle(Art $art)
    {
        $images = ArtImages::where('art_id', $art->id)->get();

        if ($images->isEmpty()) {
            return back()->with('error', 'No images found for this artwork.');
        }

        $zipName = tempnam(sys_get_temp_dir(), 'art_') . '.zip';
        $zip     = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE);

        foreach ($images as $index => $image) {
            $s3Path  = $image->path;
            $content = Storage::disk('s3')->get($s3Path);
            $ext     = pathinfo($s3Path, PATHINFO_EXTENSION) ?: 'jpg';
            $zip->addFromString("image_" . ($index + 1) . ".{$ext}", $content);
        }

        $zip->close();

        $slug = str($art->title ?? $art->art_id)->slug()->value();

        return response()->download($zipName, "{$slug}_images.zip")->deleteFileAfterSend(true);
    }

    // ─── Bulk Download (zip images of multiple selected arts) ────────────────

    public function downloadBulk(Request $request)
    {
        $request->validate([
            'art_ids'   => 'required|array|min:1',
            'art_ids.*' => 'integer|exists:art,id',
        ]);

        $arts = Art::with('images')->whereIn('id', $request->art_ids)->get();

        if ($arts->isEmpty()) {
            return back()->with('error', 'No artworks selected.');
        }

        $zipName = tempnam(sys_get_temp_dir(), 'bulk_art_') . '.zip';
        $zip     = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE);

        foreach ($arts as $art) {
            if ($art->images->isEmpty()) continue;

            $folder = str($art->title ?? $art->art_id)->slug()->value();

            foreach ($art->images as $index => $image) {
                try {
                    $content = Storage::disk('s3')->get($image->path);
                    $ext     = pathinfo($image->path, PATHINFO_EXTENSION) ?: 'jpg';
                    $zip->addFromString("{$folder}/image_" . ($index + 1) . ".{$ext}", $content);
                } catch (\Exception $e) {
                    // skip missing S3 files
                    continue;
                }
            }
        }

        $zip->close();

        return response()->download($zipName, 'artworks_bulk_download.zip')->deleteFileAfterSend(true);
    }
}
