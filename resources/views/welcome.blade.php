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
                    class="w-1/2 bg-blue-200"
                    placeholder="Search"
                    aria-label="Search"
                    aria-describedby="button-addon1"
                    value="{{ request()->get('search') }}"/>
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
        <div class=" m-3 ">
            @if(sizeof($tableau) < 3)
            @else
                @foreach($tableau as $site)
                    <ul>
                        <li> {{ $site->adresse_site }} </li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
</x-navbar>
