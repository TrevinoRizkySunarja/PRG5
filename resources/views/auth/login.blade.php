<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-semibold text-gray-100">Inloggen</h1>
        <p class="text-sm text-gray-400 mt-1">Log in om je Pokémon app te gebruiken</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-600 bg-gray-900 text-red-500 shadow-sm focus:ring-red-500"
                       name="remember">
                <span class="ms-2 text-sm text-gray-300">{{ __('Onthoud mij') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between gap-3">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-400 hover:text-gray-200"
                   href="{{ route('password.request') }}">
                    {{ __('Wachtwoord vergeten?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Inloggen') }}
            </x-primary-button>
        </div>
    </form>
<br>
    <!-- Registreren -->
    <div class="mt-8 text-center">
        <span class="text-gray-400 me-2">Nog geen account?  </span>
        <a href="{{ route('register') }}"
           class="inline-flex items-center px-4 py-2 rounded-md font-medium
                  bg-red-500 text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            {{ __('Account aanmaken') }}
        </a>
    </div>
</x-guest-layout>
