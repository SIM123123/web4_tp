<x-navbar>
    <div class="max-w-sm rounded overflow-hidden shadow-lg mt-32">
        <img class="w-1/2" src="{{ asset('storage/app/'.$site->image) }}" alt="Image">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ $site->adresse_site }}</div>
                <p class="text-gray-700 text-base">
                    {{ $username }}
                </p>
            <p class="text-gray-700 text-sm">
                {{ $site->description }}
            </p>
        </div>
    </div>
</x-navbar>
