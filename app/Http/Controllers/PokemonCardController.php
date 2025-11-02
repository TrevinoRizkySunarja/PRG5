<?php

namespace App\Http\Controllers;

use App\Models\PokemonCard;
use App\Models\Rarity;
use Illuminate\Http\Request;

class PokemonCardController extends Controller
{
    public function index(Request $request)
    {
        $q      = trim($request->get('q',''));
        $rarity = $request->get('rarity');

        $cards = PokemonCard::query()
            ->with(['rarity','user'])
            ->when($q, fn($qr) => $qr->where(function($w) use ($q) {
                $w->where('name','like',"%$q%")
                    ->orWhere('description','like',"%$q%");
            }))
            ->when($rarity, fn($qr) => $qr->where('rarity_id',$rarity))
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        $rarities = Rarity::orderBy('rank')->get();

        return view('cards.index', compact('cards','rarities'));
    }

    public function show(PokemonCard $card)
    {
        $card->load(['rarity','user']);
        return view('cards.show', compact('card'));
    }

//    public function __construct()
//    {
//        // prima zo:
//        $this->middleware('auth')->except(['index','show']);
//    }

    public function create()
    {
        $rarities = Rarity::orderBy('rank')->get();  // haal alles op
        return view('cards.create', compact('rarities'));
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'image_url'   => ['nullable','url','max:2048'],
            'rarity_id'   => ['required','exists:rarities,id'],
            'description' => ['nullable','string'],
        ]);

        $data['user_id'] = auth()->id();
        $data['active']  = true;

        $card = PokemonCard::create($data);

        return redirect()->route('cards.show', $card)->with('success','Kaart aangemaakt.');
    }

    public function edit(PokemonCard $card)
    {
        $this->authorize('update', $card);
        $rarities = Rarity::orderBy('rank')->get();

        return view('cards.edit', compact('card','rarities'));
    }


    public function update(Request $request, PokemonCard $card)
    {
        $this->authorize('update', $card);

        $data = $request->validate([
            'name'        => ['required','string','max:255'],
            'image_url'   => ['nullable','url','max:2048'],
            'rarity_id'   => ['required','exists:rarities,id'],
            'description' => ['nullable','string'],
        ]);

        $card->update($data);

        return redirect()->route('cards.show',$card)->with('success','Kaart bijgewerkt.');
    }

    public function destroy(PokemonCard $card)
    {
        $this->authorize('delete', $card);
        $card->delete();
        return redirect()->route('cards.index')->with('success','Kaart verwijderd.');
    }

    // POST /cards/{card}/toggle-active
    public function toggleActive(PokemonCard $card)
    {
        $this->authorize('toggle', $card);
        $card->active = ! $card->active;
        $card->save();

        return back()->with('success', 'Status omgeschakeld naar '.($card->active ? 'actief' : 'inactief'));
    }
}
