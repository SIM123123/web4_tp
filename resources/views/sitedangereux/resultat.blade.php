
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Site Dangereux') }}</title>

    <script src="https://kit.fontawesome.com/4cd8c72940.js" crossorigin="anonymous"></script>
    <title> Site </title>
</head>
<x-navbar>
    <div class="flex flex-col h-screen justify-center">
        @csrf
    </div>
</x-navbar>
</html>
