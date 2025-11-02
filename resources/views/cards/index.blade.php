{{-- resources/views/cards/index.blade.php --}}
<x-layout title="Pokémon Cards">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{-- Header + acties --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold">Pokémon Cards</h1>

            @auth
                <a href="{{ route('cards.create') }}"
                   class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Nieuwe kaart
                </a>
            @endauth
        </div>

        {{-- Filters --}}
        <form method="GET" action="{{ route('cards.index') }}" class="mb-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Zoek op naam of beschrijving…"
                       class="col-span-1 sm:col-span-2 block w-full rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500"/>

                <div class="flex gap-2">
                    <select name="rarity" class="flex-1 rounded-md bg-gray-900 border border-gray-700 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
                        <option value="">Alle rarities</option>
                        @foreach($rarities as $r)
                            <option value="{{ $r->id }}" @selected(request('rarity') == $r->id)>
                                {{ $r->name }}
                            </option>
                        @endforeach
                    </select>

                    <button class="rounded-md bg-gray-800 px-4 py-2 text-sm font-medium hover:bg-gray-700 border border-gray-700">
                        Zoeken
                    </button>
                </div>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="overflow-x-auto rounded-lg border border-gray-800 bg-gray-900/50">
            <table class="min-w-full table-fixed">
                <colgroup>
                    <col class="w-16">            {{-- Img --}}
                    <col class="w-48">            {{-- Naam --}}
                    <col class="w-36">            {{-- Rarity --}}
                    <col>                          {{-- Omschrijving (flex) --}}
                    <col class="w-40">            {{-- Owner --}}
                    <col class="w-44">            {{-- Acties --}}
                </colgroup>

                <thead class="bg-gray-900/70">
                <tr class="text-xs uppercase text-gray-400">
                    <th class="px-4 py-3 text-left">Img</th>
                    <th class="px-4 py-3 text-left">Naam</th>
                    <th class="px-4 py-3 text-left">Rarity</th>
                    <th class="px-4 py-3 text-left">Omschrijving</th>
                    <th class="px-4 py-3 text-left">Owner</th>
                    <th class="px-4 py-3 text-left">Acties</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-800">
                @forelse($cards as $card)
                    <tr class="align-middle">
                        {{-- Img --}}
                        <td class="px-4 py-3">
                            @if ($card->image_url)
                                <img src="{{ $card->image_url }}" alt="{{ $card->name }}"
                                     class="h-12 w-12 object-cover rounded-md border border-gray-700">
                            @else
                                <div class="h-12 w-12 rounded-md bg-gray-800/60 border border-gray-700"></div>
                            @endif
                        </td>

                        {{-- Naam --}}
                        <td class="px-4 py-3 whitespace-nowrap font-medium">
                            <a href="{{ route('cards.show', $card) }}" class="hover:underline">
                                {{ $card->name }}
                            </a>
                        </td>

                        {{-- Rarity --}}
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ optional($card->rarity)->name ?? '—' }}
                        </td>

                        {{-- Omschrijving  --}}
                        <td class="px-4 py-3">
                            <p class="line-clamp-2 text-sm text-gray-300">
                                {{ $card->description ?: '—' }}
                            </p>
                        </td>

                        {{-- Owner --}}
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                            {{ optional($card->user)->name ?? optional($card->user)->username ?? '—' }}
                        </td>

                        {{-- Acties --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('cards.show', $card) }}" class="text-sm hover:underline">Details</a>

                                @can('update', $card)
                                    <a href="{{ route('cards.edit', $card) }}" class="text-sm text-gray-200 hover:underline">
                                        Bewerken
                                    </a>
                                @endcan

                                @can('delete', $card)
                                    <form method="POST" action="{{ route('cards.destroy', $card) }}"
                                          onsubmit="return confirm('Weet je zeker dat je deze kaart wilt verwijderen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-sm text-red-400 hover:text-red-300">
                                            Verwijderen
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-400">
                            Geen kaarten gevonden.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginatie --}}
        <div class="mt-6">
            {{ $cards->withQueryString()->links() }}
        </div>
    </div>
</x-layout>
