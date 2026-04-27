@include('layouts.header')

<!-- Main Content Area Scrollable -->
<div class="flex-1 py-3 flex flex-col min-h-0">
    <!-- Search and Actions -->
    <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 mb-6 flex-shrink-0">
        <div class="flex items-center space-x-2 md:space-x-4 flex-1 max-w-2xl">
            <div class="relative flex-1 max-w-md">
                <input type="text" placeholder="Search artwork..."
                    class="w-full pl-4 pr-10 py-2.5 bg-white border border-[#D1D5DB] rounded-full focus:outline-none focus:border-[#A7AEA1] focus:ring-1 focus:ring-[#A7AEA1] transition-all text-sm md:text-md">
                <div class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="relative filter-dropdown-container z-50">
                <button
                    class="filter-dropdown-btn flex items-center gap-2 px-4 py-2.5 bg-[#F3F4F6] hover:bg-[#E5E7EB] text-[#374151] text-sm font-medium rounded-full transition-colors cursor-pointer">
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
                    class="filter-menu hidden absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-lg z-50 py-2">
                    <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox"
                            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
                            value="Editor" data-group="Role">
                        <span class="text-sm text-gray-700">Editor</span>
                    </label>
                    <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox"
                            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
                            value="Viewer" data-group="Role">
                        <span class="text-sm text-gray-700">Viewer</span>
                    </label>
                    <label class="flex items-center px-4 py-2.5 hover:bg-gray-50 cursor-pointer transition-colors">
                        <input type="checkbox"
                            class="filter-checkbox mr-3 rounded text-[#2B2B2B] focus:ring-[#2B2B2B] border-gray-300 w-4 h-4"
                            value="Admin" data-group="Role">
                        <span class="text-sm text-gray-700">Admin</span>
                    </label>
                </div>
            </div>
            <div class="h-6 w-px bg-gray-300 mx-1 hidden" id="filters-divider"></div>
            <div id="active-filters-list" class="flex flex-wrap items-center gap-2"></div>
        </div>
        <div class="flex items-center justify-end">
            <button
                class="px-6 py-2.5 bg-[#2B2B2B] text-white rounded-full text-sm font-medium hover:bg-[#3B3B3B] transition-colors">
                Add New
            </button>
        </div>
    </div>

    <!-- List View Table -->
    <div class="relative rounded-xl ring-1 ring-[#D1D5DB] bg-white overflow-x-auto">
        <table class="min-w-full text-sm text-[#2B2B2B]" style="border-collapse: separate; border-spacing: 0;">
            <thead class="bg-white">
                <tr>
                    <th
                        class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] rounded-tl-xl border-b border-[#D1D5DB]">
                        Name</th>
                    <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">
                        Title</th>
                    <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">
                        Created</th>
                    <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">
                        Editor ID</th>
                    <th class="px-5 py-4 text-left text-[13px] font-medium text-[#9CA3AF] border-b border-[#D1D5DB]">
                        Image Preview</th>
                    <th
                        class="px-5 py-4 text-right text-[13px] font-medium text-[#9CA3AF] rounded-tr-xl border-b border-[#D1D5DB]">
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="hover:bg-[#FAFAFA] transition-colors">
                    <td class="px-5 py-4 font-medium text-[#374151] border-b border-[#D1D5DB]">Kenley Stevens</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Editor</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">24 April 2026</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">ED0001</td>
                    <td class="px-5 py-4 text-left border-b border-[#D1D5DB]">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-lg text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
                            <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview"
                                class="w-5 h-5">
                        </button>
                    </td>
                    <td class="px-5 py-4 text-right relative z-50 border-b border-[#D1D5DB]">
                        <button onclick="toggleMenu(this)"
                            class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-full transition-colors">
                            <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
                        </button>
                        <div
                            class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
                            <div
                                class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
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
                                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit"
                                    class="w-4 h-4">
                                Edit User
                            </button>
                            <button
                                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete"
                                    class="w-4 h-4">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="hover:bg-[#FAFAFA] transition-colors">
                    <td class="px-5 py-4 font-medium text-[#374151] border-b border-[#D1D5DB]">Kaitlynn Calderon</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">Viewer</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">21 April 2026</td>
                    <td class="px-5 py-4 text-[#4B5563] border-b border-[#D1D5DB]">ED0002</td>
                    <td class="px-5 py-4 text-left border-b border-[#D1D5DB]">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-lg text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
                            <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview"
                                class="w-5 h-5">
                        </button>
                    </td>
                    <td class="px-5 py-4 text-right relative z-40 border-b border-[#D1D5DB]">
                        <button onclick="toggleMenu(this)"
                            class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-full transition-colors">
                            <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
                        </button>
                        <div
                            class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
                            <div
                                class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
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
                                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit"
                                    class="w-4 h-4">
                                Edit User
                            </button>
                            <button
                                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete"
                                    class="w-4 h-4">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="hover:bg-[#FAFAFA] transition-colors">
                    <td class="px-5 py-4 font-medium text-[#374151] rounded-bl-xl">Lance Sutton</td>
                    <td class="px-5 py-4 text-[#4B5563]">Editor</td>
                    <td class="px-5 py-4 text-[#4B5563]">1 April 2026</td>
                    <td class="px-5 py-4 text-[#4B5563]">ED0003</td>
                    <td class="px-5 py-4 text-left">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-lg text-[#4A6FFF] hover:bg-[#EEF2FF] transition-colors">
                            <img src="{{ asset('build/assets/images/icons/preview.svg') }}" alt="Preview"
                                class="w-5 h-5">
                        </button>
                    </td>
                    <td class="px-5 py-4 text-right relative z-30 rounded-br-xl">
                        <button onclick="toggleMenu(this)"
                            class="inline-flex items-center justify-center w-[42px] h-[26px] bg-[#E5E7EB] hover:bg-[#D1D5DB] rounded-full transition-colors">
                            <img src="{{ asset('build/assets/images/icons/dots.svg') }}" alt="Actions" class="w-4 h-4">
                        </button>
                        <div
                            class="hidden w-44 bg-[#F3F4F6] rounded-3xl shadow-lg ring-1 ring-[#D1D5DB] z-[60] menu p-1.5 text-left">
                            <div
                                class="flex items-center justify-between px-3 py-2 bg-white rounded-full shadow-sm mb-1.5">
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
                                <img src="{{ asset('build/assets/images/icons/pencil.svg') }}" alt="Edit"
                                    class="w-4 h-4">
                                Edit User
                            </button>
                            <button
                                class="w-full text-left px-3 py-2 hover:bg-[#E5E7EB] text-sm text-[#4B5563] flex items-center gap-2 rounded-full transition-colors">
                                <img src="{{ asset('build/assets/images/icons/trash.svg') }}" alt="Delete"
                                    class="w-4 h-4">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
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
            let left = rect.right - 176; // 176px is w-44 width

            if (top + menu.offsetHeight > window.innerHeight) {
                top = rect.top - menu.offsetHeight - 8;
            }

            menu.style.top = top + 'px';
            menu.style.left = left + 'px';
        }
    }

    window.addEventListener('scroll', function() {
        document.querySelectorAll('.menu:not(.hidden)').forEach(m => m.classList.add('hidden'));
    }, true);

    window.addEventListener('resize', function() {
        document.querySelectorAll('.menu:not(.hidden)').forEach(m => m.classList.add('hidden'));
    });

    window.addEventListener('click', function (e) {
        if (!e.target.closest('td')) {
            document.querySelectorAll('.menu').forEach(m => m.classList.add('hidden'));
        }
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
            pill.className = 'flex items-center gap-1.5 px-3 py-1.5 bg-[#2B2B2B] text-white text-sm font-medium rounded-full flex-shrink-0';
            pill.innerHTML = `
                <span>${checkedBoxes[0]}</span>
                <button class="hover:text-gray-300 transition-colors focus:outline-none flex items-center justify-center" onclick="removeFilter('${checkedBoxes[0]}')">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;
            activeFiltersList.appendChild(pill);
        } else if (checkedBoxes.length > 1) {
            const dropdownContainer = document.createElement('div');
            dropdownContainer.className = 'relative filter-dropdown-container z-50 flex-shrink-0';

            let menuHtml = checkedBoxes.map(val => `
                <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-50 transition-colors">
                    <span class="text-sm text-gray-700">${val}</span>
                    <button class="text-gray-400 hover:text-red-500 transition-colors focus:outline-none flex items-center justify-center" onclick="removeFilter('${val}')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `).join('');

            dropdownContainer.innerHTML = `
                <button class="filter-dropdown-btn flex items-center gap-2 px-4 py-2 bg-[#2B2B2B] hover:bg-[#3B3B3B] text-white text-sm font-medium rounded-full transition-colors">
                    <span>${checkedBoxes.length} Filters Selected</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="filter-menu hidden absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 rounded-2xl shadow-lg z-50 py-2">
                    ${menuHtml}
                    <div class="px-4 pt-2 mt-2 border-t border-gray-100">
                        <button class="w-full py-1.5 text-xs font-medium text-red-500 hover:text-red-600 transition-colors" onclick="clearAllFilters()">Clear All</button>
                    </div>
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
</script>

@include('layouts.footer')