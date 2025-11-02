<x-layout title="Nieuwe Pokémonkaart">
    <h1 class="text-2xl font-bold mb-6">Nieuwe Pokémonkaart</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-50 text-red-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cards.store') }}" class="space-y-4 max-w-xl">
        @csrf
        <div>
            <label class="block font-medium">Naam</label>
            <input name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block font-medium">Afbeelding URL</label>
            <input name="image_url" value="{{ old('image_url') }}" class="w-full border rounded p-2" placeholder="https://...">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Rarity</label>
            <select name="rarity_id" class="w-full rounded bg-gray-900 border border-gray-700">
                <option value="">-- kies --</option>
                @foreach($rarities as $rarity)
                    <option value="{{ $rarity->id }}" @selected(old('rarity_id') == $rarity->id)>
                        {{ $rarity->name }}
                    </option>
                @endforeach
            </select>
            @error('rarity_id')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror

        </div>

        <div>
            <label class="block font-medium">Beschrijving</label>
            <textarea name="description" rows="4" class="w-full border rounded p-2">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 rounded bg-blue-600 text-white">Opslaan</button>
            <a href="{{ route('cards.index') }}" class="px-4 py-2 rounded border">Annuleren</a>
        </div>
    </form>
</x-layout>
