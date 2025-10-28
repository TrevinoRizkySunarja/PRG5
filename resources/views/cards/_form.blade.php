@csrf
<div style="display:grid;gap:12px">
    <label>Naam
        <input name="name" value="{{ old('name', $card->name ?? '') }}" required>
        @error('name') <div class="muted">{{ $message }}</div> @enderror
    </label>

    <label>Afbeelding URL
        <input name="image_url" value="{{ old('image_url', $card->image_url ?? '') }}" placeholder="https://…">
        @error('image_url') <div class="muted">{{ $message }}</div> @enderror
    </label>

    <label>Rarity
        <select name="rarity_id" required>
            <option value="">Kies rarity…</option>
            @foreach($rarities as $rarity)
                <option value="{{ $rarity->id }}" @selected(old('rarity_id', $card->rarity_id ?? '')==$rarity->id)>{{ $rarity->name }}</option>
            @endforeach
        </select>
        @error('rarity_id') <div class="muted">{{ $message }}</div> @enderror
    </label>

    <label>Toegekend aan gebruiker (optioneel)
        <select name="user_id">
            <option value="">—</option>
            @foreach($users as $u)
                <option value="{{ $u->id }}" @selected(old('user_id', $card->user_id ?? '')==$u->id)>{{ $u->username }}</option>
            @endforeach
        </select>
        @error('user_id') <div class="muted">{{ $message }}</div> @enderror
    </label>

    <label>Beschrijving
        <textarea name="description" rows="4">{{ old('description', $card->description ?? '') }}</textarea>
        @error('description') <div class="muted">{{ $message }}</div> @enderror
    </label
