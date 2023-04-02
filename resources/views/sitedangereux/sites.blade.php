<x-navbar>
    <div class="max-w-lg rounded overflow-hidden shadow-lg mt-32 mx-auto">
        <ul>
            @foreach ($sites as $site)
                <li>
                    <div class="px-6 py-4">
                        <div class="font-bold text-3xl mb-2 flex justify-between">
                            <a class="hover:text-orange-400" href="{{ route('show', ['id' => $site['IdSite']]) }}">
                                {{ $site['Adresse'] }}
                            </a>
                            @if($site['Votes'] < 10)
                                <form action="{{ route('destroy', $site['IdSite']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash hover:text-red-600"></i></button>
                                </form>
                            @endif
                        </div>
                        <p class="text-gray-700 text-md">
                            {{ __('sites.Votes') }} : {{ $site['Votes'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-navbar>
