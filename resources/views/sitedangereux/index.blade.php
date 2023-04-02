<x-navbar>
    <div class="flex flex-col h-screen justify-center">
        <ul>
            @foreach ($sites as $site)
                <li> {{ $site->adresse_site }}</li>
            @endforeach
        </ul>
    </div>
</x-navbar>
