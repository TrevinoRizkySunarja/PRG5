<x-layout :title="$card->name">
    <div class="grid md:grid-cols-2 gap-6">
        <div class="theme-card p-5">
            @if($card->image_url)
                <img src="{{ $card->image_url }}" alt="{{ $card->name }}" class="w-full rounded">
            @else
                <div class="aspect-[4/3] rounded bg-[var(--muted)] grid place-items-center text-[var(--subtle)]">Geen afbeelding</div>
            @endif
        </div>

        <div class="theme-card p-6">
            <h1 class="text-3xl font-bold mb-2">{{ $card->name }}</h1>
            <div class="mb-4">
                <span class="badge">{{ $card->rarity->name }}</span>
            </div>
            <p class="text-[var(--subtle)] leading-relaxed">{{ $card->description ?: '—' }}</p>

            <dl class="mt-6 grid sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-[var(--subtle)]">Owner</dt>
                    <dd class="font-medium">{{ $card->user->username ?? $card->user->name ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-[var(--subtle)]">Aangemaakt</dt>
                    <dd class="font-medium">{{ $card->created_at->format('d-m-Y H:i') }}</dd>
                </div>
            </dl>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('cards.index') }}" class="btn-outline px-4 py-2 rounded">Terug</a>
                @auth
                    @if(auth()->id() === $card->user_id || auth()->user()->role)
                        <a href="{{ route('cards.edit',$card) }}" class="btn">Bewerken</a>
                        <form method="POST" action="{{ route('cards.destroy',$card) }}"
                              onsubmit="return confirm('Weet je zeker dat je deze kaart wil verwijderen?')">
                            @csrf @method('DELETE')
                            <button class="btn-outline px-4 py-2 rounded">Verwijderen</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-layout>
