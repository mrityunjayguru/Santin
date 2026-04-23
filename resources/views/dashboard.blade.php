<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    <form action="{{ route('bulk-upload') }}" method="post" enctype="multipart/form-data">
                        <lable class="form-lable">Bulk Upload</lable><br>
                        <input type="file" name="file" id="file" class="form-control">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
