@php $old = fn($k, $def='') => old($k, $card->{$k} ?? $def); @endphp

<div>
    <label class="block font-medium">Naam</label>
    <input name="name" value="{{ $old('name') }}" class="w-full border rounded p-2" required>
    @error('name')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
</div>

<div>
    <label class="block font-medium">Afbeelding URL</label>
    <input name="image_url" value="{{ $old('image_url') }}" class="w-full border rounded p-2" placeholder="https://...">
    @error('image_url')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
</div>

<div>
    <label class="block font-medium">Rarity</label>
    <select name="rarity_id" class="w-full border rounded p-2" required>
        <option value="">-- kies --</option>
        @foreach($rarities as $r)
        <option value="{{ $r->id }}" @selected($old('rarity_id') == $r->id)>{{ $r->name }}</option>
        @endforeach
    </select>
    @error('rarity_id')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
</div>

<div>
    <label class="block font-medium">Beschrijving</label>
    <textarea name="description" rows="4" class="w-full border rounded p-2">{{ $old('description') }}</textarea>
    @error('description')<div class="text-sm text-red-600">{{ $message }}</div>@enderror
</div>
