
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Site Dangereux') }}</title>

    <script src="https://kit.fontawesome.com/4cd8c72940.js" crossorigin="anonymous"></script>

</head>
<x-navbar>
    <div class="flex flex-col h-screen justify-center">
        <div class="flex justify-center items-center">
            <h1 class="font-sans text-4xl mb-4">Recherche</h1>
        </div>
        <div>
            <form action="{{ route('search') }}" method="GET" class="flex items-center justify-center">
                <?php
                $tableau = [];
                $adresses = //liste d'adresses
                $adresseRecherchee = //adresse recherchée par l'utilisateur
                foreach ($adresses as $adresse) {
                    $diff = levenshtein($adresseRecherchee, $adresse);
                    $tableau[$adresse] = $diff;
                }
                asort($tableau);

                $tableau[0];
                $tableau[1];
                $tableau[2];
                ?>
                <input
                    type="search"
                    id="search"
                    name="search"
                    class="w-1/2 bg-blue-200"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="button-addon1"/>
                <button
                    class="p-2 bg-blue-200"
                    type="submit"
                    id="button-addon1"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
</x-navbar>
</html>
