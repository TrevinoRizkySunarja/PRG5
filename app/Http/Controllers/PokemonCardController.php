<?php

namespace App\Http\Controllers;

use App\Models\PokemonCard;
use App\Models\Rarity;
use Illuminate\Http\Request;

class PokemonCardController extends Controller
{
    /**
     * Toon overzicht met filters (q, rarity) en paginatie.
     * Publiek toegankelijk.
     */
    public function index(Request $request)
    {
        // Dropdown-data voor filters
        $rarities = Rarity::orderBy('rank')->orderBy('name')->get();

        // Basisquery
        $query = PokemonCard::with(['rarity', 'user']);

        // Zoekterm in naam + beschrijving
        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter op rarity
        if ($rarityId = $request->input('rarity')) {
            $query->where('rarity_id', $rarityId);
        }

        // Resultaten (laatst toegevoegd eerst)
        $cards = $query->latest()->paginate(12)->withQueryString();

        return view('cards.index', compact('cards', 'rarities'));
    }

    /**
     * Details-pagina: toont 1 kaart met alle relaties.
     * Publiek toegankelijk.
     */
    public function show(PokemonCard $card)
    {
        $card->load(['rarity', 'user']);
        return view('cards.show', compact('card'));
    }

    /**
     * Formulier voor nieuwe kaart.
     * Vereist login.
     */
    public function create() {
        $rarities = \App\Models\Rarity::orderBy('rank')->orderBy('name')->get();
        return view('cards.create', compact('rarities'));
    }


    /**
     * Sla nieuwe kaart op.
     * Vereist login.
     */
    public function store(Request $request)
    {
        $this->mustBeLoggedIn();

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'image_url'   => ['nullable', 'url', 'max:2048'],
            'rarity_id'   => ['required', 'exists:rarities,id'],
            'description' => ['nullable', 'string'],
        ]);

        $data['user_id'] = auth()->id();

        $card = PokemonCard::create($data);

        return redirect()
            ->route('cards.show', $card)
            ->with('status', 'Pokémonkaart aangemaakt!');
    }

    /**
     * Formulier om kaart te bewerken.
     * Alleen eigenaar of admin.
     */
    public function edit(PokemonCard $card)
    {
        $this->authorizeCardOwner($card);

        $rarities = Rarity::orderBy('rank')->orderBy('name')->get();

        return view('cards.edit', compact('card', 'rarities'));
    }

    /**
     * Update kaart.
     * Alleen eigenaar of admin.
     */
    public function update(Request $request, PokemonCard $card)
    {
        $this->authorizeCardOwner($card);

        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'image_url'   => ['nullable', 'url', 'max:2048'],
            'rarity_id'   => ['required', 'exists:rarities,id'],
            'description' => ['nullable', 'string'],
        ]);

        $card->update($data);

        return redirect()
            ->route('cards.show', $card)
            ->with('status', 'Pokémonkaart bijgewerkt!');
    }

    /**
     * Verwijder kaart.
     * Alleen eigenaar of admin.
     */
    public function destroy(PokemonCard $card)
    {
        $this->authorizeCardOwner($card);

        $card->delete();

        return redirect()
            ->route('cards.index')
            ->with('status', 'Pokémonkaart verwijderd.');
    }

    /* ===================== Helpers ===================== */

    /**
     * Zorgt dat een gebruiker is ingelogd; anders 403.
     */
    private function mustBeLoggedIn(): void
    {
        if (!auth()->check()) {
            abort(403, 'Login vereist.');
        }
    }

    /**
     * Laat alleen de eigenaar of admin (role=1) bewerken/verwijderen.
     */
    private function authorizeCardOwner(PokemonCard $card): void
    {
        $user = auth()->user();

        if (!$user) abort(403, 'Login vereist.');

        $isOwner = $card->user_id === $user->id;
        $isAdmin = (bool) ($user->role ?? false);

        if (!$isOwner && !$isAdmin) {
            abort(403, 'Je hebt geen rechten voor deze actie.');
        }
    }
}
