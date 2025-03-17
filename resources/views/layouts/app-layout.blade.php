<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dim">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-base-200 h-screen w-screen flex">
    <aside class="w-1/6 bg-base-100 border-base-300 border h-screen">
        <div class="text-3xl h-20 flex items-center justify-center border-b border-base-300">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <ul class="menu bg-base-100 w-full gap-2">
            <li>
                <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.*') ? 'menu-active' : '' }} flex items-center">
                    <i class="iconoir-stats-up-square"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'menu-active' : '' }} flex items-center">
                    <i class="iconoir-cube"></i>
                    Products
                </a>
            </li>
            <li>
                <a>
                    <i class="iconoir-user"></i>
                    Users
                </a>
            </li>
        </ul>
    </aside>

    <main class="flex flex-col h-screen w-full overflow-x-auto">
        <header class="h-20 flex items-center justify-between w-5/6 px-10 fixed bg-base-200 z-1">
            <h2 class="text-2xl w-52">{{ $title }}</h2>
            <div class="flex-1"></div>
            <livewire:search width="w-1/3"/>
            <div class="flex-1"></div>
            <div class="flex items-center space-x-4">
                <livewire:notification-indicator />
                <div class="dropdown dropdown-end">
                    <div class="avatar avatar-placeholder" tabindex="0" role="button">
                        <div class="bg-neutral text-neutral-content w-10 rounded-full">
                            <span>{{ auth()->user()->initials() }}</span>
                        </div>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm mt-2">
                        <li><a>Item 1</a></li>
                        <li><a>Item 2</a></li>
                        <li><a>Item 3</a></li>
                        <div class="divider m-1"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li><button>Logout</button></li>
                        </form>
                    </ul>
                </div>
            </div>
        </header>
        <div class="px-10 mt-20">
            {{ $slot }}
        </div>
    </main>

    @if(Session::has('error_message'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 10000)"
             x-show="show"
             x-transition.opacity.duration.1000ms
             @click="show = false"
             role="alert"
             class="alert alert-error absolute bottom-10 right-10 cursor-pointer transition-opacity duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ Session::get('error_message') }}</span>
        </div>
    @endif
    @if(Session::has('success_message'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 10000)"
             x-show="show"
             x-transition.opacity.duration.1000ms
             @click="show = false"
             role="alert"
             class="alert alert-success absolute bottom-5 left-5 cursor-pointer transition-opacity duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ Session::get('success_message') }}</span>
        </div>
    @endif
    @livewireScripts
</body>
</html>
