<!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black/50 z-[80] hidden lg:hidden"></div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-[#F0F1F4] flex flex-col p-4 m-0 lg:m-4 lg:rounded-[10px] h-full md:h-fit z-[90] transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out">
            <div
                class="flex mb-2 justify-between items-center lg:justify-center">
                <div
                    class="w-24 h-24 lg:w-30 lg:h-30 rounded-2xl flex items-center justify-center">
                    <img src="{{asset('build/assets/images/banner-black.svg')}}" alt="Logo"
                        class="w-20 h-20 lg:w-28 lg:h-28">
                </div>
                <!-- Close Button (Mobile Only) -->
                <button id="close-sidebar"
                    class="lg:hidden p-2 text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2" id="sidebar-nav">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md transition-colors group {{ request()->routeIs('dashboard') ? 'bg-[#2B2B2B] text-white hover:bg-[#3B3B3B]' : 'hover:bg-gray-200' }}"
                            data-title="Dashboard">
                            <img src="{{asset('build/assets/images/icons/dashboard.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('dashboard') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('art.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md transition-colors group {{ request()->routeIs('art.*') ? 'bg-[#2B2B2B] text-white hover:bg-[#3B3B3B]' : 'hover:bg-gray-200' }}"
                            data-title="Manage Art">
                            <img src="{{asset('build/assets/images/icons/brush.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('art.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Manage Art</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('download-art.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md transition-colors group {{ request()->routeIs('download-art.*') ? 'bg-[#2B2B2B] text-white hover:bg-[#3B3B3B]' : 'hover:bg-gray-200' }}"
                            data-title="Download Art">
                            <img src="{{asset('build/assets/images/icons/document-download.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('download-art.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Download Art</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md transition-colors group {{ request()->routeIs('users.*') ? 'bg-[#2B2B2B] text-white hover:bg-[#3B3B3B]' : 'hover:bg-gray-200' }}"
                            data-title="User Management">
                            <img src="{{asset('build/assets/images/icons/user-cirlce-add.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('users.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">User Management</span>
                        </a>
                    </li>
                    <li>
                        <button onclick="toggleSubmenu(this)"
                            class="w-full nav-link flex items-center justify-between p-3 rounded-md transition-colors group hover:bg-gray-200"
                            data-title="Customise">
                            <div class="flex items-center space-x-3">
                                <img src="{{asset('build/assets/images/icons/setting.svg')}}" alt
                                    class="nav-icon w-5 h-5 transition-all">
                                <span class="text-sm font-medium">Customise</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200 transform {{ request()->routeIs('roles.*') ? 'rotate-180' : '' }} submenu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul class="submenu space-y-2 mt-2 px-2 {{ request()->routeIs('roles.*') ? '' : 'hidden' }}">
                            <li>
                                <a href="#" class="flex items-center space-x-3 p-3 rounded-xl transition-colors group {{ request()->routeIs('roles.*') ? 'bg-[#2B2B2B] text-white hover:bg-[#3B3B3B]' : 'hover:bg-gray-200 text-[#4B5563]' }}">
                                    <svg class="w-5 h-5 {{ request()->routeIs('roles.*') ? 'text-white' : 'text-[#4B5563]' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                        <path d="M12 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                        <path d="M7 19v-1a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Manage roles</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <script>
            function toggleSubmenu(btn) {
                const submenu = btn.nextElementSibling;
                const icon = btn.querySelector('.submenu-icon');
                
                if (submenu.classList.contains('hidden')) {
                    submenu.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    submenu.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }
        </script>