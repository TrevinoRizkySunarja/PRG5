{{-- resources/views/profile/edit.blade.php --}}
<x-layout title="Profiel">
    <div class="max-w-3xl mx-auto p-6 space-y-10">
        <h1 class="text-2xl font-semibold">Mijn profiel</h1>

        @if (session('status'))
            <div class="rounded-md border border-green-500/30 bg-green-500/10 px-4 py-2 text-green-200">
                {{ session('status') }}
            </div>
        @endif

        @includeIf('profile.partials.update-profile-information-form')
        @includeIf('profile.partials.update-password-form')
        @includeIf('profile.partials.delete-user-form')
    </div>
</x-layout>
