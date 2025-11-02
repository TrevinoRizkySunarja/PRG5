<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Kaart bewerken
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 rounded border border-green-700 bg-green-900/40 text-green-200 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded border border-red-700 bg-red-900/40 text-red-200 px-4 py-3">
            <ul class="list-disc space-y-1 ps-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cards.update', $card) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm mb-1">Naam</label>
            <input name="name" type="text" value="{{ old('name', $card->name) }}"
                   class="w-full rounded bg-gray-800 border-gray-700"
                   required>
        </div>

        <div>
            <label class="block text-sm mb-1">Afbeelding URL</label>
            <input name="image_url" type="url" value="{{ old('image_url', $card->image_url) }}"
                   class="w-full rounded bg-gray-800 border-gray-700">
        </div>

        <div>
            <label class="block text-sm mb-1">Rarity</label>
            <select name="rarity_id" class="w-full rounded bg-gray-800 border-gray-700" required>
                <option value="">-- kies --</option>
                @foreach ($rarities as $rarity)
                    <option value="{{ $rarity->id }}"
                        @selected(old('rarity_id',$card->rarity_id) == $rarity->id)>
                        {{ $rarity->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-1">Omschrijving</label>
            <textarea name="description" rows="5"
                      class="w-full rounded bg-gray-800 border-gray-700">{{ old('description', $card->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 rounded bg-red-600 hover:bg-red-500 text-white">Opslaan</button>
            <a href="{{ route('cards.show', $card) }}" class="px-4 py-2 rounded bg-gray-700 hover:bg-gray-600">Annuleren</a>
        </div>
    </form>
</x-layout>
