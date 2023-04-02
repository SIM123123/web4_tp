<x-navbar>
    <div class="w-full max-w-md mx-auto">
        <form method="POST" action="{{ route('store') }}" class="bg-white shadow-md rounded px-8 pb-8 mt-28" enctype="multipart/form-data">
            @csrf
            <div class="text-center">{{ __('create.Add') }}</div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse">
                    {{ __('create.Address') }}
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="adresse"
                       name="adresse"
                       type="text"
                       value="{{ $nom ?? "" }}"
                >
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    {{ __('create.Description') }}
                </label>
                <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" type="text">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    {{ __('create.Image') }}
                </label>
                <input class="w-full py-2 px-3" id="image" type="file" name="image"  accept="image/*">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('create.Add') }}
                </button>
            </div>
        </form>
    </div>
</x-navbar>
