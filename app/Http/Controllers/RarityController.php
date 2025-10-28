<?php

namespace App\Http\Controllers;

use App\Models\Rarity;
use Illuminate\Http\Request;

class RarityController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function index() {
        $rarities = Rarity::orderBy('rank')->orderBy('name')->get();
        return view('rarities.index', compact('rarities'));
    }

    public function store(Request $request) {
        if (!auth()->user()->role) abort(403);
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:rarities,name'],
            'rank' => ['nullable','integer','min:0']
        ]);
        Rarity::create($data);
        return back()->with('status','Rarity toegevoegd.');
    }
}
