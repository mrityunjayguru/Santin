@include('layouts.header')

<div class="flex-1 overflow-y-auto pb-8">

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Bulk Upload</h2>
        <p class="text-sm text-gray-500 mt-1">Upload a CSV file to import art records. Images in column 3 are stored on S3.</p>
    </div>

    {{-- Alerts --}}
    @if(isset($processed))
        <div class="mb-4 p-4 rounded-lg border
            {{ count($uploadErrors ?? []) > 0
                ? 'bg-red-50 border-red-200 text-red-800'
                : (count($duplicates) === 0 ? 'bg-green-50 border-green-200 text-green-800' : 'bg-yellow-50 border-yellow-200 text-yellow-800') }}">
            <p class="font-medium text-sm">
                ✅ {{ $inserted }} record(s) inserted successfully.
                @if(count($duplicates) > 0)
                    &nbsp;⚠️ {{ count($duplicates) }} duplicate(s) skipped.
                @endif
                @if(count($uploadErrors ?? []) > 0)
                    &nbsp;❌ {{ count($uploadErrors) }} row(s) had errors.
                @endif
            </p>
        </div>
    @endif

    {{-- S3 / DB Upload Errors --}}
    @if(isset($processed) && count($uploadErrors ?? []) > 0)
        <div class="bg-white rounded-xl border border-red-200 shadow-sm p-6 mb-6">
            <h3 class="text-base font-semibold text-red-700 mb-1">
                ❌ Upload Errors — {{ count($uploadErrors) }} row(s) failed
            </h3>
            <p class="text-sm text-red-600 mb-4">
                These rows encountered errors during <strong>DB insert</strong> or <strong>S3 image upload</strong>.
                Art records with S3 errors are still saved — only images failed.
            </p>
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs text-left border-collapse">
                    <thead>
                        <tr class="bg-red-50 text-red-900 uppercase tracking-wide text-[11px]">
                            <th class="px-3 py-2 border border-red-200">Row #</th>
                            <th class="px-3 py-2 border border-red-200">Artist</th>
                            <th class="px-3 py-2 border border-red-200">Title</th>
                            <th class="px-3 py-2 border border-red-200">Stage</th>
                            <th class="px-3 py-2 border border-red-200">Error</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uploadErrors as $i => $err)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-red-50/40' }}">
                                <td class="px-3 py-2 border border-red-100 text-gray-500">{{ $err['row'] }}</td>
                                <td class="px-3 py-2 border border-red-100 font-medium">{{ $err['artist'] }}</td>
                                <td class="px-3 py-2 border border-red-100">{{ $err['title'] }}</td>
                                <td class="px-3 py-2 border border-red-100">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold
                                        {{ $err['stage'] === 'S3 Upload' ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $err['stage'] }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 border border-red-100 text-red-600 font-mono break-all">{{ $err['message'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg border bg-red-50 border-red-200 text-red-800 text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg border bg-red-50 border-red-200 text-red-800">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Upload Form --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8 max-w-2xl">
        <form action="{{ route('bulk-upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- CSV File --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    CSV File <span class="text-red-500">*</span>
                </label>
                <input type="file" name="file" accept=".csv,.txt"
                    class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer
                           file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                           file:text-sm file:font-medium file:bg-gray-800 file:text-white
                           hover:file:bg-gray-700 focus:outline-none">
            </div>

          
            {{-- CSV Format Guide --}}
            {{-- <div class="mb-5 p-3 bg-gray-50 rounded-lg border border-gray-200 text-xs text-gray-500">
                <p class="font-semibold text-gray-600 mb-1">Expected CSV column order:</p>
                <code class="block leading-relaxed break-all">
                    artist, <span class="text-blue-600 font-semibold">images (comma-sep filenames)</span>, title, type, size, frame, date, location, ownership, inventory_status, bundle, pkg_quantity, notes
                </code>
                <p class="mt-2 text-green-600 font-medium">✅ art_id is auto-generated (ART00001, ART00002, ...)</p>
                <p class="mt-1">Images column — 3 options:</p>
                <ul class="mt-1 space-y-1 list-disc list-inside">
                    <li><span class="text-blue-600 font-medium">Google Drive URL</span> — share link (file must be public)</li>
                    <li><span class="text-purple-600 font-medium">Dropbox URL</span> — share link (dl=0 auto-converted)</li>
                    <li><span class="text-green-600 font-medium">Direct image URL</span> — any public https image link</li>
                    <li><span class="text-gray-600 font-medium">Filename</span> — upload actual files in the Images field above</li>
                </ul>
            </div> --}}

            <button type="submit"
                class="bg-gray-800 text-white text-sm font-medium px-5 py-2.5 rounded-lg hover:bg-gray-700 transition">
                Upload &amp; Import
            </button>
        </form>
    </div>

    {{-- Duplicate Preview Table --}}
    @if(isset($processed) && count($duplicates) > 0)
        <div class="bg-white rounded-xl border border-yellow-200 shadow-sm p-6">
            <h3 class="text-base font-semibold text-yellow-800 mb-1">
                ⚠️ Duplicate Records — {{ count($duplicates) }} skipped
            </h3>
            <p class="text-sm text-yellow-700 mb-4">
                These rows already exist with the same <strong>Artist</strong> + <strong>Title</strong> combination.
            </p>
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs text-left border-collapse">
                    <thead>
                        <tr class="bg-yellow-50 text-yellow-900 uppercase tracking-wide text-[11px]">
                            <th class="px-3 py-2 border border-yellow-200">#</th>
                            <th class="px-3 py-2 border border-yellow-200">Artist</th>
                            <th class="px-3 py-2 border border-yellow-200">Title</th>
                            <th class="px-3 py-2 border border-yellow-200">Type</th>
                            <th class="px-3 py-2 border border-yellow-200">Size</th>
                            <th class="px-3 py-2 border border-yellow-200">Frame</th>
                            <th class="px-3 py-2 border border-yellow-200">Date</th>
                            <th class="px-3 py-2 border border-yellow-200">Location</th>
                            <th class="px-3 py-2 border border-yellow-200">Ownership</th>
                            <th class="px-3 py-2 border border-yellow-200">Inv. Status</th>
                            <th class="px-3 py-2 border border-yellow-200">Bundle</th>
                            <th class="px-3 py-2 border border-yellow-200">Pkg Qty</th>
                            <th class="px-3 py-2 border border-yellow-200">Notes</th>
                            <th class="px-3 py-2 border border-yellow-200">Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($duplicates as $i => $row)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-yellow-50/40' }}">
                                <td class="px-3 py-2 border border-yellow-100 text-gray-400">{{ $i + 1 }}</td>
                                <td class="px-3 py-2 border border-yellow-100 font-medium">{{ $row['artist'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100 font-medium">{{ $row['title'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['type'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['size'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['frame'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['date'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['location'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['ownership'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['inventoryStatus'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['bundle'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['pkgQuantity'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['notes'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100 text-blue-500 font-mono">{{ $row['imagesRaw'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@include('layouts.footer')

<script>
    document.getElementById('images-input').addEventListener('change', function () {
        const count = this.files.length;
        document.getElementById('images-count').textContent =
            count > 0 ? count + ' file(s) selected' : 'No files selected';
    });
</script>
