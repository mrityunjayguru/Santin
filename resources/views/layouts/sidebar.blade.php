<!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-[#F0F1F4] flex flex-col p-4 m-0 lg:m-4 lg:rounded-[10px] h-full md:h-fit z-50 transform -                 translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out">
            <div
                class="flex mb-2 justify-between items-center lg:justify-center">
                <div
                    class="w-24 h-24 lg:w-30 lg:h-30 rounded-2xl flex items-center justify-center">
                    <img src="{{asset('build/assets/images/banner.svg')}}" alt="Logo"
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
                        <a href="#"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md hover:bg-gray-200 transition-colors group"
                            data-title="Dashboard">
                            <img src="{{asset('build/assets/images/icons/dashboard.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all">
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('art.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md hover:bg-gray-200 transition-colors group {{ request()->routeIs('art.*') ? 'bg-[#2B2B2B] text-white' : 'hover:bg-gray-200' }}"
                            data-title="Art management">
                            <img src="{{asset('build/assets/images/icons/brush.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('art.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Manage art</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('download-art.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md hover:bg-gray-200 transition-colors group {{ request()->routeIs('download-art.*') ? 'bg-[#2B2B2B] text-white' : 'hover:bg-gray-200' }}"
                            data-title="Download art">
                            <img src="{{asset('build/assets/images/icons/document-download.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('download-art.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Download art</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md hover:bg-gray-200 transition-colors group {{ request()->routeIs('users.*') ? 'bg-[#2B2B2B] text-white' : 'hover:bg-gray-200' }}"
                            data-title="Add Editor">
                            <img src="{{asset('build/assets/images/icons/user-cirlce-add.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all {{ request()->routeIs('users.*') ? 'invert' : '' }}">
                            <span class="text-sm font-medium">Add Editor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="nav-link flex items-center space-x-3 p-3 rounded-md hover:bg-gray-200 transition-colors group"
                            data-title="Customise fields">
                            <img src="{{asset('build/assets/images/icons/setting.svg')}}" alt
                                class="nav-icon w-5 h-5 transition-all">
                            <span class="text-sm font-medium">Customise
                                fields</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>