<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/4cd8c72940.js" crossorigin="anonymous"></script>
    <title>{{ config('app.name', 'Site Dangereux') }}</title>
</head>
<body class="antialiased">
    <header>
        @if (Route::has('login'))
            <div class=" flex flex-row place-content-center items-center sm:fixed sm:top-0 sm:right-0 p-2 text-right bg-blue-500 w-full">
                <div>
                    <h1  class="text-xl font-bold font-sans text-amber-500"> <a href="/"> SaferBrowser </a>  </h1>
                </div>

                <div class="grow h-14"></div>

                <a href="/" class="font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm">{{ __('header.Home') }}</a>
                <a href="{{ route('create') }}" class="ml-4 font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm">{{ __('header.Add') }}</a>
                @auth
                    <a href="{{ route('lister') }}" class="ml-4 font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm">{{ __('header.List') }}</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="ml-4 font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('header.Logout') }}
                        </a>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="ml-4 font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm">{{ __('header.Connexion') }}</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-amber-500 focus:outline focus:outline-2 focus:rounded-sm">{{ __('header.Register') }}</a>
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
