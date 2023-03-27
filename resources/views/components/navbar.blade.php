<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Laravel</title>
</head>
<body class="antialiased">
    <header>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right bg-blue-500 w-full">
                <a href="/" class="font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('header.Home') }}</a>
                <a href="{{ route('create') }}" class="ml-4 font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('header.Add') }}</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    <a href="/" class="ml-4 font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('header.List') }}</a>
                @else
                    <a href="{{ route('login') }}" class="ml-4 font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('header.Connexion') }}</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-500 hover:text-gray-900 dark:text-gray-100 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('header.Register') }}</a>
                    @endif
                @endauth
            </div>
        @endif
    </header>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
