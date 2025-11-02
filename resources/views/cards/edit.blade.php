{{-- resources/views/profile/edit.blade.php --}}
<x-layout title="Profiel">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-gray-100">
        <h1 class="text-2xl font-semibold mb-6">Mijn profiel</h1>

        @if (session('status'))
            <div class="mb-6 rounded-md border border-green-700 bg-green-900/40 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <div class="space-y-10">
            <section class="rounded-lg border border-gray-800 bg-gray-900/50 p-6">
                <h2 class="text-lg font-medium mb-4">Profielgegevens</h2>
                @include('profile.partials.update-profile-information-form')
            </section>

            <section class="rounded-lg border border-gray-800 bg-gray-900/50 p-6">
                <h2 class="text-lg font-medium mb-4">Wachtwoord wijzigen</h2>
                @include('profile.partials.update-password-form')
            </section>

            <section class="rounded-lg border border-gray-800 bg-gray-900/50 p-6">
                <h2 class="text-lg font-medium mb-4 text-red-300">Account verwijderen</h2>
                @include('profile.partials.delete-user-form')
            </section>
        </div>
    </div>
</x-layout>
