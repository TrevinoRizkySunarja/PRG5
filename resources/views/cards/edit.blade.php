{{-- resources/views/cards/edit.blade.php --}}
<x-layout title="Kaart bewerken">
    <div class="max-w-3xl mx-auto p-6 space-y-6">
        <h1 class="text-2xl font-semibold">Kaart bewerken</h1>

        <form method="POST" action="{{ route('cards.update', $card) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm mb-1">Naam</label>
                <input name="name" type="text" value="{{ old('name', $card->name) }}"
                       class="w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2" required>
                @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Afbeelding URL</label>
                <input name="image_url" type="url" value="{{ old('image_url', $card->image_url) }}"
                       class="w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2">
                @error('image_url') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Rarity</label>
                <select name="rarity_id"
                        class="w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2">
                    <option value="">-- kies --</option>
                    @foreach ($rarities as $rarity)
                        <option value="{{ $rarity->id }}"
                            @selected(old('rarity_id', $card->rarity_id) == $rarity->id)>
                            {{ $rarity->name }}
                        </option>
                    @endforeach
                </select>
                @error('rarity_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm mb-1">Beschrijving</label>
                <textarea name="description" rows="5"
                          class="w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2">{{ old('description', $card->description) }}</textarea>
                @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button class="inline-flex items-center rounded-md bg-red-600 hover:bg-red-700 px-4 py-2">
                    Opslaan
                </button>
                <a href="{{ route('cards.show', $card) }}"
                   class="inline-flex items-center rounded-md bg-gray-800 hover:bg-gray-700 px-4 py-2">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
</x-layout>
