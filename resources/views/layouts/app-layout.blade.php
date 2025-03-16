<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dim">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-base-200 h-screen flex">
    <aside class="w-56 bg-base-100 border-base-300 border h-screen">
        <div class="text-3xl h-20 flex items-center justify-center border-b border-base-300">
            <h1>{{ config('app.name') }}</h1>
        </div>
    </aside>

    <main class="flex flex-col h-screen w-full">
        <header class="h-20 flex items-center justify-between w-full px-10">
            <h2 class="text-2xl">{{ $title }}</h2>
            <livewire:search width="w-1/3"/>
            <div class="flex items-center space-x-4">
                <div class="indicator">
                    <span class="indicator-item status status-accent"></span>
                    <button class="btn btn-base border border-base-100 text-base-content">
                        <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z"/>
                        </svg>
                    </button>
                </div>

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
        <div class="px-10">
            {{ $slot }}
        </div>
    </main>
    @livewireScripts
</body>
</html>
