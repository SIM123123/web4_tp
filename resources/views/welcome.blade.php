<?php

?>
<x-navbar>
    <div class="flex flex-col h-screen justify-center">
        <div class="flex justify-center items-center">
            <h1 class="font-sans text-4xl mb-4">Recherche</h1>
        </div>
        <div>
            <form  action="{{route('search')}}" method="GET" class="flex items-center justify-center">
                <input
                    type="search"
                    id="search"
                    name="search"
                    class="w-1/2 bg-blue-200"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="button-addon1"
                    value="<?= $_GET['search'] ?? "" ?>"/>
                <button
                    class="p-2 bg-blue-200"
                    type="submit"
                    id="button-addon1"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    Recherche
                </button>
            </form>
        </div>
        <div class="flex flex-col items-center justify-center mt-5">
            @if(@isset($tableau))
                @if( sizeof($tableau) != 0)
                    <table class=" w-1/2 p-1 bg-blue-100 border-blue-500 border-2 border-solid ">
                        @foreach($tableau as $site)
                            <thead class=" text-xs text-amber-500 uppercase bg-blue-500">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom du site
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre de votes
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre de commentaire
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b dark:bg-blue-300 dark:border-blue-200">
                                <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap dark:text-white">
                                    {{ $site->adresse_site }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $site->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $site->nb_votes }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $site->nb_commentaires }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('show', [ 'id' => $site->id]) }}" class="text-blue-500 hover:text-amber-500">Consulter</a>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <div> {{ 'le site est pas present ajoutez le' }}</div>
                    <div> {{ 'cliquer ' }} <a href="{{route('remplir',['nom' =>  $_GET['search']])}}" class="text-amber-600"> {{ 'ici' }}</a></div>
                @endif
            @endif
        </div>
    </div>
</x-navbar>
