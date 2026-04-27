@include('layouts.header')

<div class="flex-1 overflow-y-auto pb-8">

    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Bulk Upload</h2>
        <p class="text-sm text-gray-500 mt-1">Upload a CSV file to import art records in bulk.</p>
    </div>

    {{-- Success / Error alerts --}}
    @if(isset($processed))
        <div class="mb-6 p-4 rounded-lg border
            {{ count($duplicates) === 0 ? 'bg-green-50 border-green-200 text-green-800' : 'bg-yellow-50 border-yellow-200 text-yellow-800' }}">
            <p class="font-medium">
                ✅ {{ $inserted }} record(s) inserted successfully.
                @if(count($duplicates) > 0)
                    &nbsp;⚠️ {{ count($duplicates) }} duplicate(s) skipped.
                @endif
            </p>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg border bg-red-50 border-red-200 text-red-800">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Upload Form --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8 max-w-xl">
        <form action="{{ route('bulk-upload.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">CSV File</label>
                <input type="file" name="file" accept=".csv,.txt"
                    class="block w-full text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer
                           file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                           file:text-sm file:font-medium file:bg-gray-800 file:text-white
                           hover:file:bg-gray-700 focus:outline-none">
                <p class="text-xs text-gray-400 mt-2">
                    Column order: <span class="font-mono">art_id, artist, images (comma-sep), title, type, size, frame, date, location, ownership, inventory_status, bundle, pkg_quantity, notes</span>
                </p>
            </div>
            <button type="submit"
                class="bg-gray-800 text-white text-sm font-medium px-5 py-2 rounded-lg hover:bg-gray-700 transition">
                Upload &amp; Import
            </button>
        </form>
    </div>

    {{-- Duplicate Preview --}}
    @if(isset($processed) && count($duplicates) > 0)
        <div class="bg-white rounded-xl border border-yellow-200 shadow-sm p-6">
            <h3 class="text-base font-semibold text-yellow-800 mb-1">
                ⚠️ Duplicate Records ({{ count($duplicates) }})
            </h3>
            <p class="text-sm text-yellow-700 mb-4">
                These rows were skipped because an art record with the same <strong>Artist</strong> and <strong>Title</strong> already exists.
            </p>
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs text-left border-collapse">
                    <thead>
                        <tr class="bg-yellow-50 text-yellow-900 uppercase tracking-wide">
                            <th class="px-3 py-2 border border-yellow-200">#</th>
                            <th class="px-3 py-2 border border-yellow-200">Art ID</th>
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
                                <td class="px-3 py-2 border border-yellow-100 text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['art_id'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100 font-medium">{{ $row['artist'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100 font-medium">{{ $row['title'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['type'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['size'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['frame'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['date'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['location'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['ownership'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['inventory_status'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['bundle'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['pkg_quantity'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100">{{ $row['notes'] }}</td>
                                <td class="px-3 py-2 border border-yellow-100 text-blue-600">{{ $row['images'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>

@include('layouts.footer')
