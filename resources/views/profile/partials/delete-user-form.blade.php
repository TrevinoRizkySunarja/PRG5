{{-- Account verwijderen --}}
<form method="post" action="{{ route('profile.destroy') }}" class="space-y-4"
      onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan gemaakt worden.');">
    @csrf
    @method('delete')

    <p class="text-sm text-gray-300">
        Dit verwijdert je account en al je gegevens permanent.
    </p>

    <button
        type="submit"
        class="inline-flex items-center rounded-md bg-red-700 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 focus:outline-none">
        Verwijder account
    </button>
</form>
