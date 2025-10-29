<x-layout title="Profile">
    <h1 class="text-2xl font-bold mb-4">Profile</h1>

    @if (session('status'))
        <div class="mb-4 text-green-700">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-3 max-w-md">
        @csrf @method('PATCH')
        <label class="block">Name
            <input class="w-full border p-2 rounded" name="name" value="{{ old('name', $user->name) }}" required>
        </label>
        <label class="block">Email
            <input class="w-full border p-2 rounded" name="email" value="{{ old('email', $user->email) }}" required>
        </label>
        <label class="block">New password (optional)
            <input type="password" class="w-full border p-2 rounded" name="password">
        </label>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
    </form>

    <hr class="my-6">

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Delete account?')">
        @csrf @method('DELETE')
        <label class="block mb-2">Confirm password
            <input type="password" class="w-full border p-2 rounded" name="password" required>
        </label>
        <button class="px-4 py-2 bg-red-600 text-white rounded">Delete account</button>
    </form>
</x-layout>
