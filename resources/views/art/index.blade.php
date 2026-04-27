@include('layouts.header')

<!-- Main Content Area Scrollable -->
<div class="flex-1 py-3 flex flex-col min-h-0">
  <!-- Search and Actions -->
  <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 mb-4 flex-shrink-0">
    <div class="flex items-center space-x-2 md:space-x-4 flex-1 max-w-2xl">
      <div class="relative flex-1">
        <input type="text" placeholder="Search artwork..."
          class="w-full pl-4 pr-4 py-3 bg-gray-50 border border-[#A7AEA1] rounded-full focus:outline-none outline-none transition-all text-sm md:text-md">
        <div class="absolute right-3 top-1/2 -translate-y-1/2">
          <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>
      <div class="flex items-center space-x-1 md:space-x-2">
        <button id="grid-view-btn"
          class="p-2 bg-[#2B2B2B] border border-gray-200 rounded-xl hover:bg-[#3B3B3B] transition-colors">
          <img src="{{ asset('build/assets/images/icons/grid.svg') }}" alt class="w-5 h-5 invert">
        </button>
        <button id="list-view-btn"
          class="p-2 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition-colors">
          <img src="{{ asset('build/assets/images/icons/list.svg') }}" alt class="w-5 h-5">
        </button>
      </div>
    </div>
    <div class="flex items-center space-x-2 md:space-x-3 w-full lg:w-auto">
      <a href="{{ route('art.create') }}"
        class="flex-1  lg:flex-none text-center px-4 md:px-6 py-3 bg-[#2B2B2B] text-white rounded-full text-xs md:text-sm font-medium  hover:bg-[#3B3B3B] transition-colors">Add
        New</a>
      <button
        class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-white cursor-pointer border border-[#2B2B2B] rounded-full text-xs md:text-sm font-medium hover:bg-gray-50 transition-colors">Bulk
        Upload</button>
    </div>
  </div>
  <!-- Filters -->
  <div class="mb-8 flex flex-wrap items-center gap-3">
    <!-- Filters Dropdown -->
    <div class="relative filter-dropdown-container z-[60]">
      <button
        class="filter-dropdown-btn flex items-center gap-2 px-4 py-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-sm font-medium rounded-full transition-colors cursor-pointer">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <circle cx="14" cy="6" r="2"></circle>
          <line x1="4" y1="6" x2="12" y2="6"></line>
          <line x1="16" y1="6" x2="20" y2="6"></line>
          <circle cx="8" cy="12" r="2"></circle>
          <line x1="4" y1="12" x2="6" y2="12"></line>
          <line x1="10" y1="12" x2="20" y2="12"></line>
          <circle cx="16" cy="18" r="2"></circle>
          <line x1="4" y1="18" x2="14" y2="18"></line>
          <line x1="18" y1="18" x2="20" y2="18"></line>
        </svg>
        <span>Filters</span>
        <svg class="w-4 h-4 text-[#6B7280]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <div
        class="filter-menu hidden absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-lg z-[60] py-2">
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Available" data-group="Filters">
          <span class="text-sm text-gray-700">Available</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Sold" data-group="Filters">
          <span class="text-sm text-gray-700">Sold</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Reserved" data-group="Filters">
          <span class="text-sm text-gray-700">Reserved</span>
        </label>
      </div>
    </div>

    <!-- Medium Filter Dropdown -->
    <div class="relative filter-dropdown-container z-50">
      <button
        class="filter-dropdown-btn flex items-center gap-2 px-4 py-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-sm font-medium rounded-full transition-colors">
        Medium
        <svg class="w-4 h-4 text-[#6B7280]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <div
        class="filter-menu hidden absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-lg z-50 py-2">
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Oil on canvas" data-group="Medium">
          <span class="text-sm text-gray-700">Oil on canvas</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Watercolour" data-group="Medium">
          <span class="text-sm text-gray-700">Watercolour</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Acrylic" data-group="Medium">
          <span class="text-sm text-gray-700">Acrylic</span>
        </label>
      </div>
    </div>

    <!-- Type Filter Dropdown -->
    <div class="relative filter-dropdown-container z-40">
      <button
        class="filter-dropdown-btn flex items-center gap-2 px-4 py-2 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-sm font-medium rounded-full transition-colors">
        Type
        <svg class="w-4 h-4 text-[#6B7280]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>
      <div
        class="filter-menu hidden absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-lg z-50 py-2">
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Landscape" data-group="Type">
          <span class="text-sm text-gray-700">Landscape</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Portrait" data-group="Type">
          <span class="text-sm text-gray-700">Portrait</span>
        </label>
        <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
          <input type="checkbox"
            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
            value="Abstract" data-group="Type">
          <span class="text-sm text-gray-700">Abstract</span>
        </label>
      </div>
    </div>

    <div class="h-6 w-px bg-gray-300 mx-1 hidden" id="filters-divider"></div>

    <!-- Active Filters List -->
    <div id="active-filters-list" class="flex flex-wrap gap-2"></div>
  </div>

  <!-- Page start Here -->
  <!-- Grid View -->
  <div id="grid-view"
    class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 overflow-y-auto pb-10 pr-2">
    <!-- Card 1 -->
    <div class="group cursor-pointer art-card" data-current-slide="0">
      <div class="aspect-[16/9] rounded-3xl overflow-hidden mb-3 bg-gray-100 relative">
        <div class="carousel-container flex w-full h-full transition-transform duration-500 ease-out">
          <img src="{{ asset('build/assets/images/img4.png') }}" alt="The Starry Night 1"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img3.png') }}" alt="The Starry Night 2"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img5.png') }}" alt="The Starry Night 3"
            class="w-full h-full object-cover flex-shrink-0">
        </div>
        <!-- Carousel Controls -->
        <div
          class="absolute inset-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button class="prev-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button class="next-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        <div
          class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-100"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
        </div>
      </div>
      <p class="text-center text-xs md:text-sm font-medium text-gray-700">The Starry Night</p>
    </div>

    <!-- Card 2 -->
    <div class="group cursor-pointer art-card" data-current-slide="0">
      <div class="aspect-[16/9] rounded-3xl overflow-hidden mb-3 bg-gray-100 relative">
        <div class="carousel-container flex w-full h-full transition-transform duration-500 ease-out">
          <img src="{{ asset('build/assets/images/img5.png') }}" alt="Colourful eyes 1"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img3.png') }}" alt="Colourful eyes 2"
            class="w-full h-full object-cover flex-shrink-0">
        </div>
        <!-- Carousel Controls -->
        <div
          class="absolute inset-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button class="prev-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button class="next-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        <!-- Dots -->
        <div
          class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-100"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
        </div>
      </div>
      <p class="text-center text-xs md:text-sm font-medium text-gray-700">Colourful eyes</p>
    </div>

    <!-- Card 3 -->
    <div class="group cursor-pointer art-card" data-current-slide="0">
      <div class="aspect-[16/9] rounded-3xl overflow-hidden mb-3 bg-gray-100 relative">
        <div class="carousel-container flex w-full h-full transition-transform duration-500 ease-out">
          <img src="{{ asset('build/assets/images/img1.png') }}" alt="Splatter of joy 1"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img3.png') }}" alt="Splatter of joy 2"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img5.png') }}" alt="Splatter of joy 3"
            class="w-full h-full object-cover flex-shrink-0">
        </div>
        <!-- Carousel Controls -->
        <div
          class="absolute inset-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button class="prev-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button class="next-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        <!-- Dots -->
        <div
          class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-100"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
        </div>
      </div>
      <p class="text-center text-xs md:text-sm font-medium text-gray-700">Splatter of joy</p>
    </div>

    <!-- Card 4 -->
    <div class="group cursor-pointer art-card" data-current-slide="0">
      <div class="aspect-[16/9] rounded-3xl overflow-hidden mb-3 bg-gray-100 relative">
        <div class="carousel-container flex w-full h-full transition-transform duration-500 ease-out">
          <img src="{{ asset('build/assets/images/img4.png') }}" alt="The Starry Night 1"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img3.png') }}" alt="The Starry Night 2"
            class="w-full h-full object-cover flex-shrink-0">
          <img src="{{ asset('build/assets/images/img5.png') }}" alt="The Starry Night 3"
            class="w-full h-full object-cover flex-shrink-0">
        </div>
        <!-- Carousel Controls -->
        <div
          class="absolute inset-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity">
          <button class="prev-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </button>
          <button class="next-btn p-1.5 bg-white/80 rounded-full hover:bg-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </button>
        </div>
        <div
          class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-100"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
          <div class="dot w-1.5 h-1.5 rounded-full bg-white bg-opacity-40"></div>
        </div>
      </div>
      <p class="text-center text-xs md:text-sm font-medium text-gray-700">The Starry Night</p>
    </div>
  </div>

  <!-- List View Table -->
  <div id="list-view" class="hidden relative rounded-xl ring-1 ring-[#D1D5DB] bg-white overflow-x-auto">
    <table class="min-w-full text-sm text-[#2B2B2B]" style="border-collapse: separate; border-spacing: 0;">
      <thead class="bg-white">
        <tr>
          <th
            class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] rounded-tl-xl border-b border-[#D1D5DB]">
            Title</th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Artist</th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Medium</th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Location</th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Ownership
          </th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Type</th>
          <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Art ID</th>
          <th class="px-5 py-4 text-center text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">Preview
          </th>
          <th
            class="px-5 py-4 text-right text-[13px] font-medium text-[#9CA3AF] rounded-tr-xl border-b border-[#D1D5DB]">
          </th>
        </tr>
      </thead>
      <tbody>
        <!-- Row 1 -->
        <tr class="hover:bg-[#FAFAFA] transition-colors">
          <td class="px-5 py-4 font-medium text-[#374151] border-b border-[#D1D5DB]">The Starry Night</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Vincent van Gogh</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Oil on canvas</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Zundert</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">MoMA</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Landscape</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">ART00001</td>
          <td class="px-5 py-4 text-center border-b border-[#D1D5DB]">
            <button onclick="openPreview('{{ asset('build/assets/images/img4.png') }}')"
              class="inline-flex items-center justify-center p-2 rounded-lg text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
              <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview" class="w-5 h-5">
            </button>
          </td>
          <td class="px-5 py-4 text-right relative z-50 border-b border-[#D1D5DB]">
            <button onclick="toggleMenu(this)"
              class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-full transition-colors">
              <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
            </button>
            <div
              class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
              <div class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
                <span class="text-sm font-medium text-[#374151]">Active</span>
                <label class="relative inline-flex items-center cursor-pointer scale-75 origin-right">
                  <input type="checkbox" class="sr-only peer" checked>
                  <span
                    class="w-10 h-5 bg-[#D1D5DB] rounded-full peer-checked:bg-[#4A6FFF] transition-colors duration-200"></span>
                  <span
                    class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-transform duration-200"></span>
                </label>
              </div>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit" class="w-4 h-4">
                Edit Artwork
              </button>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete" class="w-4 h-4">
                Delete
              </button>
            </div>
          </td>
        </tr>

        <!-- Row 2 -->
        <tr class="hover:bg-[#FAFAFA] transition-colors">
          <td class="px-5 py-4 font-medium text-[#374151] border-b border-[#D1D5DB]">The Young Hare</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Albrecht Dürer</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Watercolour on paper</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Vienna</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Albertina</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Landscape</td>
          <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">ART00002</td>
          <td class="px-5 py-4 text-center border-b border-[#D1D5DB]">
            <button onclick="openPreview('{{ asset('build/assets/images/img5.png') }}')"
              class="inline-flex items-center justify-center p-2 rounded-xl text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
              <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview" class="w-5 h-5">
            </button>
          </td>
          <td class="px-5 py-4 text-right relative z-40 border-b border-[#D1D5DB]">
            <button onclick="toggleMenu(this)"
              class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-full transition-colors">
              <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
            </button>
            <div
              class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
              <div class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
                <span class="text-sm font-medium text-[#374151]">Active</span>
                <label class="relative inline-flex items-center cursor-pointer scale-75 origin-right">
                  <input type="checkbox" class="sr-only peer">
                  <span
                    class="w-10 h-5 bg-[#D1D5DB] rounded-full peer-checked:bg-[#4A6FFF] transition-colors duration-200"></span>
                  <span
                    class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-transform duration-200"></span>
                </label>
              </div>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit" class="w-4 h-4">
                Edit Artwork
              </button>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete" class="w-4 h-4">
                Delete
              </button>
            </div>
          </td>
        </tr>

        <!-- Row 3 -->
        <tr class="hover:bg-[#FAFAFA] transition-colors">
          <td class="px-5 py-4 font-medium text-[#374151] rounded-bl-xl">The Starry Night</td>
          <td class="px-5 py-4 text-[#4B5563]">Vincent van Gogh</td>
          <td class="px-5 py-4 text-[#4B5563]">Oil on canvas</td>
          <td class="px-5 py-4 text-[#4B5563]">Oil on canvas</td>
          <td class="px-5 py-4 text-[#4B5563]">MoMA</td>
          <td class="px-5 py-4 text-[#4B5563]">Landscape</td>
          <td class="px-5 py-4 text-[#4B5563]">ART00003</td>
          <td class="px-5 py-4 text-center">
            <button onclick="openPreview('{{ asset('build/assets/images/img4.png') }}')"
              class="inline-flex items-center justify-center p-2 rounded-lg text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
              <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview" class="w-5 h-5">
            </button>
          </td>
          <td class="px-5 py-4 text-right relative z-30 rounded-br-xl">
            <button onclick="toggleMenu(this)"
              class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-xl transition-colors">
              <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
            </button>
            <div
              class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
              <div class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
                <span class="text-sm font-medium text-[#374151]">Active</span>
                <label class="relative inline-flex items-center cursor-pointer scale-75 origin-right">
                  <input type="checkbox" class="sr-only peer" checked>
                  <span
                    class="w-10 h-5 bg-[#D1D5DB] rounded-full peer-checked:bg-[#4A6FFF] transition-colors duration-200"></span>
                  <span
                    class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-transform duration-200"></span>
                </label>
              </div>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit" class="w-4 h-4">
                Edit Artwork
              </button>
              <button
                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete" class="w-4 h-4">
                Delete
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Preview Modal -->
<div id="previewModal"
  class="fixed inset-0 bg-black/60 backdrop-blur-[2px] items-center justify-center z-[100] p-4 hidden">
  <div class="bg-white rounded-2xl overflow-hidden max-w-2xl w-full border border-white/70">
    <div class="flex items-center justify-between px-5 py-4 border-b border-[#ECEFF1]">
      <h3 class="text-base font-semibold text-[#2B2B2B]">Artwork Preview</h3>
      <button onclick="closePreview()"
        class="w-9 h-9 inline-flex items-center justify-center rounded-full hover:bg-[#F3F4F6] text-[#6B7280] transition-colors"
        aria-label="Close preview">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="bg-[#F7F8F8] p-4 md:p-5">
      <img id="previewImage" class="w-full max-h-[70vh] object-contain rounded-xl bg-white" />
    </div>
    <div class="p-4 md:p-5 text-right border-t border-[#ECEFF1]">
      <button onclick="closePreview()"
        class="px-5 py-2.5 bg-[#2B2B2B] text-white rounded-full text-sm font-medium hover:bg-[#3B3B3B] transition-colors">Close</button>
    </div>
  </div>
</div>
</div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const gridBtn = document.getElementById('grid-view-btn');
    const listBtn = document.getElementById('list-view-btn');
    const gridView = document.getElementById('grid-view');
    const listView = document.getElementById('list-view');

    function showGrid() {
      gridView.classList.remove('hidden');
      listView.classList.add('hidden');
      gridBtn.classList.remove('bg-gray-50', 'hover:bg-gray-100');
      gridBtn.classList.add('bg-[#2B2B2B]', 'hover:bg-[#3B3B3B]');
      gridBtn.querySelector('img').classList.add('invert');
      listBtn.classList.remove('bg-[#2B2B2B]', 'hover:bg-[#3B3B3B]');
      listBtn.classList.add('bg-gray-50', 'hover:bg-gray-100');
      listBtn.querySelector('img').classList.remove('invert');
    }

    function showList() {
      gridView.classList.add('hidden');
      listView.classList.remove('hidden');
      listBtn.classList.remove('bg-gray-50', 'hover:bg-gray-100');
      listBtn.classList.add('bg-[#2B2B2B]', 'hover:bg-[#3B3B3B]');
      listBtn.querySelector('img').classList.add('invert');
      gridBtn.classList.remove('bg-[#2B2B2B]', 'hover:bg-[#3B3B3B]');
      gridBtn.classList.add('bg-gray-50', 'hover:bg-gray-100');
      gridBtn.querySelector('img').classList.remove('invert');
    }

    gridBtn.addEventListener('click', showGrid);
    listBtn.addEventListener('click', showList);

    // Carousel Initialization
    const artCards = document.querySelectorAll('.art-card');
    artCards.forEach(card => {
      const container = card.querySelector('.carousel-container');
      const images = container.querySelectorAll('img');
      const nextBtn = card.querySelector('.next-btn');
      const prevBtn = card.querySelector('.prev-btn');
      const dots = card.querySelectorAll('.dot');

      let currentIndex = 0;
      const totalSlides = images.length;
      const updateCarousel = (index) => {
        currentIndex = index;
        container.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach((dot, i) => {
          if (i === currentIndex) {
            dot.classList.remove('bg-opacity-40');
            dot.classList.add('bg-opacity-100');
          } else {
            dot.classList.remove('bg-opacity-100');
            dot.classList.add('bg-opacity-40');
          }
        });
      };
      nextBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const nextIndex = (currentIndex + 1) % totalSlides;
        updateCarousel(nextIndex);
      });
      prevBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateCarousel(prevIndex);
      });
      dots.forEach((dot, i) => {
        dot.addEventListener('click', (e) => {
          e.stopPropagation();
          updateCarousel(i);
        });
      });
    });
  });
  function toggleMenu(btn) {
    const menu = btn.nextElementSibling;
    const isHidden = menu.classList.contains('hidden');

    document.querySelectorAll('.menu').forEach(m => {
      m.classList.add('hidden');
      m.style.position = '';
      m.style.top = '';
      m.style.left = '';
    });

    if (isHidden) {
      menu.classList.remove('hidden');

      const rect = btn.getBoundingClientRect();
      menu.style.position = 'fixed';

      let top = rect.bottom + 8;
      let left = rect.right - 176;

      if (top + menu.offsetHeight > window.innerHeight) {
        top = rect.top - menu.offsetHeight - 8;
      }

      menu.style.top = top + 'px';
      menu.style.left = left + 'px';
    }
  }

  window.addEventListener('scroll', function () {
    document.querySelectorAll('.menu:not(.hidden)').forEach(m => m.classList.add('hidden'));
  }, true);

  window.addEventListener('resize', function () {
    document.querySelectorAll('.menu:not(.hidden)').forEach(m => m.classList.add('hidden'));
  });

  window.addEventListener('click', function (e) {
    if (!e.target.closest('td')) {
      document.querySelectorAll('.menu').forEach(m => m.classList.add('hidden'));
    }
  });

  function openPreview(src) {
    document.getElementById('previewImage').src = src;
    document.getElementById('previewModal').classList.remove('hidden');
    document.getElementById('previewModal').classList.add('flex');
    document.body.classList.add('overflow-hidden');
  }

  function closePreview() {
    document.getElementById('previewModal').classList.add('hidden');
    document.getElementById('previewModal').classList.remove('flex');
    document.body.classList.remove('overflow-hidden');
  }

  const previewModal = document.getElementById('previewModal');
  previewModal.addEventListener('click', function (e) {
    if (e.target === previewModal) {
      closePreview();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && !previewModal.classList.contains('hidden')) {
      closePreview();
    }
  });

  // Filters Logic
  const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
  const activeFiltersList = document.getElementById('active-filters-list');
  const filtersDivider = document.getElementById('filters-divider');

  function updateFilters() {
    activeFiltersList.innerHTML = '';
    let anyChecked = false;
    let checkedBoxes = [];

    filterCheckboxes.forEach(checkbox => {
      if (checkbox.checked) {
        anyChecked = true;
        checkedBoxes.push(checkbox.value);
      }
    });

    if (checkedBoxes.length === 1) {
      const pill = document.createElement('div');
      pill.className = 'flex items-center gap-1.5 px-3 py-1.5 bg-[#2B2B2B] text-white text-sm font-medium rounded-full';
      pill.innerHTML = `
        <span>${checkedBoxes[0]}</span>
        <button class="hover:text-gray-300 transition-colors focus:outline-none flex items-center justify-center" onclick="removeFilter('${checkedBoxes[0]}')">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      `;
      activeFiltersList.appendChild(pill);
    } else if (checkedBoxes.length > 1) {
      const dropdownContainer = document.createElement('div');
      dropdownContainer.className = 'relative filter-dropdown-container z-50';

      let menuHtml = checkedBoxes.map(val => `
        <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-50 transition-colors">
          <span class="text-sm text-gray-700">${val}</span>
          <button class="text-gray-400 hover:text-red-500 transition-colors focus:outline-none flex items-center justify-center" onclick="removeFilter('${val}')">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
        </div>
        <div class="flex items-center space-x-2 md:space-x-3 w-full lg:w-auto">
            <a href="{{ route('art.create') }}"
                class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-[#2B2B2B] text-white rounded-full text-xs md:text-sm font-medium  hover:bg-[#3B3B3B] transition-colors">Add
                New</a>
            {{-- <button class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-white cursor-pointer border border-[#2B2B2B] rounded-full text-xs md:text-sm font-medium hover:bg-gray-50 transition-colors">Bulk
                Upload</button> --}}
            <label
                class="flex-1 lg:flex-none px-4 md:px-6 py-3 bg-white cursor-pointer border border-[#2B2B2B] rounded-full text-xs md:text-sm font-medium hover:bg-gray-50 transition-colors">
                Bulk Upload
                <input type="file" class="hidden" name="file">
            </label>
        </div>
      `;
      activeFiltersList.appendChild(dropdownContainer);

      const newBtn = dropdownContainer.querySelector('.filter-dropdown-btn');
      newBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const menu = newBtn.nextElementSibling;
        const isHidden = menu.classList.contains('hidden');
        document.querySelectorAll('.filter-menu').forEach(m => m.classList.add('hidden'));
        if (isHidden) {
          menu.classList.remove('hidden');
        }
      });
    }

    if (anyChecked && filtersDivider) {
      filtersDivider.classList.remove('hidden');
    } else if (filtersDivider) {
      filtersDivider.classList.add('hidden');
    }
  }

  window.removeFilter = function (value) {
    const checkbox = Array.from(filterCheckboxes).find(cb => cb.value === value);
    if (checkbox) {
      checkbox.checked = false;
      updateFilters();
    }
  };

  window.clearAllFilters = function () {
    filterCheckboxes.forEach(cb => cb.checked = false);
    updateFilters();
  };

  filterCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateFilters);
  });

  // Filter Dropdown Toggles
  const filterDropdownBtns = document.querySelectorAll('.filter-dropdown-btn');

  filterDropdownBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const menu = btn.nextElementSibling;
      const isHidden = menu.classList.contains('hidden');

      // Close all other menus
      document.querySelectorAll('.filter-menu').forEach(m => m.classList.add('hidden'));

      if (isHidden) {
        menu.classList.remove('hidden');
      }
    });
  });

  window.addEventListener('click', function (e) {
    if (!e.target.closest('.filter-dropdown-container')) {
      document.querySelectorAll('.filter-menu').forEach(m => m.classList.add('hidden'));
    }
  });

</script>

    @include('layouts.footer')
