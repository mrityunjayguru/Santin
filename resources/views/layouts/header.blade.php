<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>
        Art management
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
                <h1 class="text-lg md:text-xl font-semibold" id="page-title">Art management</h1>
            </div>
            <div class="flex items-center space-x-2 md:space-x-4">
                <span class="text-xs md:text-sm font-medium hidden sm:inline">Jaxson
                    Hooper</span>
                <div class="relative">
                    <button class="flex items-center space-x-1 focus:outline-none">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Jaxson+Hooper&background=random"
                                alt="User Profile" class="w-full h-full object-cover">
                        </div>
                        <svg class="w-3 h-3 md:w-4 md:h-4 text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        <div class="border-b border-[#A7AEA1] my-2"></div>
