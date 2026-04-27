<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        @yield('page-title')
    </title>
    <script src="{{ asset('build/assets/main.js') }}" defer></script>
    
</head>

<body class="bg-white text-gray-800 font-sans flex h-screen overflow-hidden relative px-2 md:px-4">
    @include('layouts.sidebar')
    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden px-4 md:px-8 pt-4 md:pt-8">
        <!-- Header -->
        <header class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <!-- Hamburger Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 -ml-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
                <h1 class="text-lg md:text-xl font-semibold" id="page-title">
                    @yield('page-title')
                </h1>
            </div>
            <div class="flex items-center space-x-2 md:space-x-4">
                <span class="text-xs md:text-sm font-medium hidden sm:inline">Jaxson
                    Hooper</span>
                <div class="relative">
                    <button onclick="toggleProfileDropdown()"
                        class="flex items-center space-x-1 bg-[#F0F1F4] p-1 focus:outline-none hover:bg-gray-50 rounded-full pr-1 transition-colors">
                        <div
                            class="w-6 h-6 md:w-8 md:h-8 bg-[#2B2B2B] rounded-full flex items-center justify-center overflow-hidden">
                            <img src="{{ asset('build/assets/images/icons/user-profile.svg') }}" alt="">
                        </div>
                        <svg class="w-3 h-3 md:w-4 md:h-4 text-gray-500 transition-transform duration-200 transform profile-dropdown-icon"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown Menu -->
                    <div id="profile-dropdown"
                        class="hidden absolute right-0 mt-2 w-48 bg-[#F0F1F4] rounded-3xl shadow-lg ring-1 ring-gray-100 z-[70] ">
                        <a href="#"
                            class="block px-4 py-2 text-sm bg-white rounded-full hover:bg-gray-50 transition-colors">Admin</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-[#4B5563] rounded-full hover:bg-gray-50 transition-colors">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <script>
            function toggleProfileDropdown() {
                const dropdown = document.getElementById('profile-dropdown');
                const icon = document.querySelector('.profile-dropdown-icon');

                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    icon.classList.add('rotate-180');
                } else {
                    dropdown.classList.add('hidden');
                    icon.classList.remove('rotate-180');
                }
            }

            window.addEventListener('click', function (e) {
                const dropdown = document.getElementById('profile-dropdown');
                const btn = e.target.closest('button[onclick="toggleProfileDropdown()"]');

                if (!btn && dropdown && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                    const icon = document.querySelector('.profile-dropdown-icon');
                    if (icon) icon.classList.remove('rotate-180');
                }
            });
        </script>
        <div class="border-b border-[#A7AEA1] my-2"></div>