<x-layout title="Pokémon Cards">
    <div class="theme-card p-5 mb-6">
        <form method="get" action="{{ route('cards.index') }}" class="grid md:grid-cols-3 gap-3">
            <input class="input" type="text" name="q" value="{{ request('q') }}" placeholder="Zoek op naam of beschrijving…">
            <select class="select" name="rarity">
                <option value="">Alle rarities</option>
                @foreach(($rarities ?? []) as $rarity)
                    <option value="{{ $rarity->id }}" @selected(request('rarity') == $rarity->id)>{{ $rarity->name }}</option>
                @endforeach
            </select>
            <div class="flex items-center gap-3">
                <button class="btn" type="submit">Zoeken</button>
                @auth
                    <a class="btn-outline px-4 py-2 rounded-md" href="{{ route('cards.create') }}">Nieuwe kaart</a>
                @endauth
            </div>
        </form>
    </div>

    <div class="table-wrap">
        <table class="table">
            <thead>
            <tr>
                <th style="width: 64px;">Img</th>
                <th>Naam</th>
                <th>Rarity</th>
                <th>Omschrijving</th>
                <th>Owner</th>
                <th class="td-actions">Acties</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cards as $card)
                <tr>
                    <td>
                        @if($card->image_url)
                            <img src="{{ $card->image_url }}" alt="" class="h-12 w-12 object-cover rounded">
                        @else
                            <div class="h-12 w-12 rounded bg-[var(--muted)] grid place-items-center text-xs text-[var(--subtle)]">—</div>
                        @endif
                    </td>
                    <td class="font-semibold">
                        <a href="{{ route('cards.show',$card) }}">{{ $card->name }}</a>
                    </td>
                    <td><span class="badge">{{ $card->rarity->name }}</span></td>
                    <td class="text-sm text-[var(--subtle)]">
                        {{ \Illuminate\Support\Str::limit($card->description, 80) }}
                    </td>
                    <td class="text-sm">{{ $card->user->username ?? $card->user->name ?? '—' }}</td>
                    <td class="td-actions">
                        <a href="{{ route('cards.show',$card) }}" class="btn-outline px-3 py-1.5 rounded">Details</a>
                        @auth
                            @if(auth()->id() === $card->user_id || auth()->user()->role)
                                <a href="{{ route('cards.edit',$card) }}" class="btn-outline px-3 py-1.5 rounded">Bewerken</a>
                                <form action="{{ route('cards.destroy',$card) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Verwijderen?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-outline px-3 py-1.5 rounded">Verwijderen</button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-[var(--subtle)] py-6">Geen kaarten gevonden.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end pagination">
        {{ $cards->links() }}
    </div>
</x-layout>
