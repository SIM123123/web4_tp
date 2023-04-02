<x-navbar>
    <div class="max-w-lg rounded overflow-hidden shadow-lg mt-32 mx-auto">
        @if($site->image != null)
            <img class="m-auto" src="{{ asset('storage/image/'.$site->image) }}" alt="Image">
        @endif
        <div class="px-6 py-4">
            <div class="font-bold text-3xl mb-2">{{ $site->adresse_site }}</div>
                <p class="text-gray-700 text-base">
                    {{ $username }}
                </p>
            <p class="text-gray-700 text-lg">
                {{ $site->description }}
            </p>
            <p class="text-gray-700 text-md">
                {{ __('show.Votes') }}  : {{ $votes }}
            </p>
            @auth
                @if(sizeof($voteUser) == 0)
                    <form action="{{ route('voter', ['id' => $site->id])}}" method="POST" name="voter">
                        @csrf
                        <button type="submit" class="px-8 py-3 text-white bg-blue-600 rounded focus:outline-none hover:bg-blue-300">
                            {{ __('show.Vote') }}
                        </button>
                    </form>
                @else
                    <button type="button" class="px-8 py-3 text-white bg-blue-300 rounded focus:outline-none"
                            disabled>{{ __('show.Vote') }} </button>
                @endif

            @endauth
            @auth
                <form class="mt-8 space-y-6" action="{{ route('commenter', ['id' => $site->id])}}" method="POST" name="commenter">
                    @csrf
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="commentaire" class="sr-only">Commentaire</label>
                            <textarea id="commentaire" name="commentaire" rows="4" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Ajouter un commentaire" required></textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="group w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('show.Comment') }}
                        </button>
                    </div>
                </form>
            @else
                <label>
                    <textarea rows="4" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="{{ __('show.ConnexionMessage') }}" disabled></textarea>
                </label>
                <a href="{{ route('login') }}">
                    <button class="group w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-1" >
                        {{ __('show.Connexion') }}
                    </button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="group w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-400 mt-1">
                        {{ __('show.Register') }}
                    </button>
                </a>
            @endauth
            <div class="mt-2">
            @if(sizeof($commentaires) < 1)
                <p> {{ __('show.NoComment') }} </p>
            @else
                <ul>
                @foreach($commentaires as $com)
                    <li>
                        <div class="max-w-2xl mx-auto px-4">
                            <div class="p-3 mb-3 text-base bg-white rounded-lg">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center">
                                        <p class="inline-flex items-center mr-3 text-md text-dark">
                                            {{ \App\Models\User::find($com->idUser)->name }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-500">{{ $com->commentaire }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @endif
            </div>
        </div>
    </div>
</x-navbar>
