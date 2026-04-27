<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\ArtImages;
use Illuminate\Http\Request;

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

    public function bulkUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file     = $request->file('file');
        $handle   = fopen($file->getRealPath(), 'r');

        // skip header row
        $header = fgetcsv($handle);

        $inserted   = 0;
        $duplicates = [];

        while (($row = fgetcsv($handle)) !== false) {
            // skip completely empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            // CSV column order:
            // 0:art_id | 1:artist | 2:images(comma-sep) | 3:title | 4:type
            // 5:size   | 6:frame  | 7:date              | 8:location | 9:ownership
            // 10:inventory_status | 11:bundle | 12:pkg_quantity | 13:notes

            $artId           = trim($row[0]  ?? '');
            $artist          = trim($row[1]  ?? '');
            $imagesRaw       = trim($row[2]  ?? '');
            $title           = trim($row[3]  ?? '');
            $type            = trim($row[4]  ?? '');
            $size            = trim($row[5]  ?? '');
            $frame           = trim($row[6]  ?? '');
            $date            = trim($row[7]  ?? '') ?: null;
            $location        = trim($row[8]  ?? '');
            $ownership       = trim($row[9]  ?? '');
            $inventoryStatus = trim($row[10] ?? '');
            $bundle          = trim($row[11] ?? '') !== '' ? (int) $row[11] : null;
            $pkgQuantity     = trim($row[12] ?? '') !== '' ? (int) $row[12] : null;
            $notes           = trim($row[13] ?? '');

            // Duplicate check: same artist + same title
            $exists = Art::where('artist', $artist)
                ->where('title', $title)
                ->exists();

            if ($exists) {
                $duplicates[] = [
                    'art_id'  => $artId,
                    'artist'  => $artist,
                    'title'   => $title,
                    'type'    => $type,
                    'size'    => $size,
                    'frame'   => $frame,
                    'date'    => $date,
                    'location'         => $location,
                    'ownership'        => $ownership,
                    'inventory_status' => $inventoryStatus,
                    'bundle'           => $bundle,
                    'pkg_quantity'     => $pkgQuantity,
                    'notes'            => $notes,
                    'images'           => $imagesRaw,
                ];
                continue;
            }

            // Insert art record
            $art = Art::create([
                'art_id'           => $artId,
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

            // Insert images
            if ($imagesRaw !== '') {
                $images = array_filter(array_map('trim', explode(',', $imagesRaw)));
                foreach ($images as $imgPath) {
                    ArtImages::create([
                        'art_id' => $art->id,
                        'path'   => $imgPath,
                    ]);
                }
            }

            $inserted++;
        }

        fclose($handle);

        return view('art.bulk-upload', [
            'inserted'   => $inserted,
            'duplicates' => $duplicates,
            'processed'  => true,
        ]);
    }
}
