{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ Route::has('home') ? route('home') : url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Route::has('home'))
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            {{ __('Home') }}
                        </x-nav-link>
                    @endif

                    @if (Route::has('cards.index'))
                        <x-nav-link :href="route('cards.index')" :active="request()->routeIs('cards.index')">
                            {{ __('Pokémon Cards') }}
                        </x-nav-link>
                    @endif

                    @auth
                        @if (Route::has('cards.create'))
                            <x-nav-link :href="route('cards.create')" :active="request()->routeIs('cards.create')">
                                {{ __('Nieuwe kaart') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                                <div>{{ auth()->user()->username ?? auth()->user()->name ?? auth()->user()->email }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Route::has('profile.edit'))
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:underline">{{ __('Register') }}</a>
                        @endif
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Route::has('home'))
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            @endif
            @if (Route::has('cards.index'))
                <x-responsive-nav-link :href="route('cards.index')" :active="request()->routeIs('cards.index')">
                    {{ __('Pokémon Cards') }}
                </x-responsive-nav-link>
            @endif
            @auth
                @if (Route::has('cards.create'))
                    <x-responsive-nav-link :href="route('cards.create')" :active="request()->routeIs('cards.create')">
                        {{ __('Nieuwe kaart') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                        {{ auth()->user()->username ?? auth()->user()->name ?? auth()->user()->email }}
                    </div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if (Route::has('profile.edit'))
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-600 hover:underline">{{ __('Login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block py-2 text-sm text-gray-600 hover:underline">{{ __('Register') }}</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
