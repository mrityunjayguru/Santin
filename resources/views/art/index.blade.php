@include('layouts.header')

<!-- Main Content Area Scrollable -->
<div class="flex-1 py-4">
    <!-- Search and Actions -->
    <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 mb-8">
        <div class="flex items-center space-x-2 md:space-x-4 flex-1 max-w-2xl">
            <div class="relative flex-1">
                <input type="text" placeholder="Search artwork..."
                    class="w-full pl-4 pr-4 py-3 bg-gray-50 border border-[#A7AEA1] rounded-full focus:outline-none outline-none transition-all text-sm md:text-md">
                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center space-x-1 md:space-x-2">
                <button class="p-1 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100">
                    <img src="{{ asset('build/assets/images/icons/grid.svg') }}" alt class="w-5 h-5">
                </button>
                <button class="p-1 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100">
                    <img src="{{ asset('build/assets/images/icons/list.svg') }}" alt class="w-5 h-5">
                </button>
            </div>
        </div>
        <div class="flex items-center space-x-2 md:space-x-3 w-full lg:w-auto">
            <a href="{{ route('art.create') }}"
                class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-[#2B2B2B] text-white rounded-full text-xs md:text-sm font-medium  hover:bg-[#3B3B3B] transition-colors">Add
                New</a>
            <button
                class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-white cursor-pointer border border-[#2B2B2B] rounded-full text-xs md:text-sm font-medium hover:bg-gray-50 transition-colors">Bulk
                Upload</button>
        </div>
    </div>
    <!-- Page start Here -->

@include('layouts.footer')
