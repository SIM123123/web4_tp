<x-navbar>
    <div class="flex flex-col h-screen justify-center">
        <div class="flex justify-center items-center">
            <h1 class="font-sans text-4xl mb-4">Recherche</h1>
        </div>
        <div>
            <form method="GET" class="flex items-center justify-center">
                <input
                    type="search"
                    id="search"
                    name="search"
                    class=" rounded w-1/2 bg-blue-200"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="button-addon1"
                    value="{{ request()->get('search') }}"/>
                <button
                    class="p-2"
                    type="submit"
                    id="button-addon1"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="flex flex-col items-center justify-center mt-5">
            <div class=" w-1/2 p-1 bg-blue-100 rounded  border-blue-500 border-2 border-solid">
                @if(sizeof($tableau) < 3)
                @else
                    @foreach($tableau as $site)
                        <div class="flex flex-row">
                            <a class="p-1">
                                {{ 'Nom du site ' }} : {{ $site->adresse_site }}
                            </a>
                            <a class="p-1">
                                {{ 'Description ' }} : {{ $site->description }}
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-navbar>
