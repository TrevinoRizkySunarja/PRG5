{{-- Profielgegevens updaten --}}
<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    <div>
        <label class="block text-sm text-gray-300 mb-1">Naam</label>
        <input
            name="name"
            type="text"
            value="{{ old('name', auth()->user()->name) }}"
            class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
        @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-1">E-mail</label>
        <input
            name="email"
            type="email"
            value="{{ old('email', auth()->user()->email) }}"
            class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
        @error('email') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="pt-2">
        <button
            type="submit"
            class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500 focus:outline-none">
            Opslaan
        </button>
    </div>
</form>
