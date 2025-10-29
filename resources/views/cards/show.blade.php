{{-- resources/views/cards/show.blade.php --}}
<x-layout title="Kaart: {{ $card->name }}">
    <a href="{{ route('cards.index') }}" class="text-sm text-gray-600">&larr; Terug</a>

    <div class="mt-4 bg-white border rounded-lg p-6">
        <div class="flex flex-col md:flex-row gap-6">
            @if($card->image_url)
                <img src="{{ $card->image_url }}" alt="{{ $card->name }}" class="w-full md:w-1/2 rounded">
            @endif

            <div class="flex-1">
                <h1 class="text-3xl font-bold">{{ $card->name }}</h1>
                <div class="mt-2 text-gray-600">
                    Rarity: <strong>{{ $card->rarity->name }}</strong>
                </div>
                <p class="mt-4">{{ $card->description }}</p>
                <p class="mt-2 text-sm text-gray-500">
                    Toegevoegd door {{ $card->user->username ?? $card->user->name ?? $card->user->email }}
                </p>

                @auth
                    @if(auth()->id() === $card->user_id || auth()->user()->role)
                        <div class="mt-6 flex gap-3">
                            <a class="px-4 py-2 rounded bg-blue-600 text-white" href="{{ route('cards.edit',$card) }}">Bewerken</a>
                            <form method="POST" action="{{ route('cards.destroy',$card) }}"
                                  onsubmit="return confirm('Weet je zeker dat je deze kaart wil verwijderen?')">
                                @csrf @method('DELETE')
                                <button class="px-4 py-2 rounded bg-red-600 text-white">Verwijderen</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-layout>
