{{-- Wachtwoord wijzigen --}}
<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
        <label class="block text-sm text-gray-300 mb-1">Huidig wachtwoord</label>
        <input
            name="current_password"
            type="password"
            class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
        @error('current_password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-1">Nieuw wachtwoord</label>
        <input
            name="password"
            type="password"
            class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
        @error('password') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-300 mb-1">Bevestig wachtwoord</label>
        <input
            name="password_confirmation"
            type="password"
            class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" />
    </div>

    <div class="pt-2">
        <button
            type="submit"
            class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500 focus:outline-none">
            Wachtwoord updaten
        </button>
    </div>
</form>
