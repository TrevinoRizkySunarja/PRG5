<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800 text-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-red-500" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                                class="text-gray-300 hover:text-white">
                        Home
                    </x-nav-link>

                    <x-nav-link :href="route('cards.index')" :active="request()->routeIs('cards.index')"
                                class="text-gray-300 hover:text-white">
                        Pokémon Cards
                    </x-nav-link>

                    @auth
                        <x-nav-link :href="route('cards.create')" :active="request()->routeIs('cards.create')"
                                    class="text-red-400 hover:text-red-300">
                            Nieuwe kaart
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 rounded-md text-gray-300 hover:text-white focus:outline-none transition">
                                <div>
                                    {{ auth()->user()->username ?? auth()->user()->name ?? auth()->user()->email }}
                                </div>
                                <div class="ms-1">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.169l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profiel
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Uitloggen
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-sm text-red-400 hover:text-red-300">
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('cards.index')" :active="request()->routeIs('cards.index')">
                Pokémon Cards
            </x-responsive-nav-link>

            @auth
                <x-responsive-nav-link :href="route('cards.create')" :active="request()->routeIs('cards.create')">
                    Nieuwe kaart
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-800">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-100">
                        {{ auth()->user()->username ?? auth()->user()->name ?? auth()->user()->email }}
                    </div>
                    <div class="font-medium text-sm text-gray-400">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        Profiel
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            Uitloggen
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4">
                    <a href="{{ route('login') }}" class="block py-2 text-sm text-gray-300 hover:text-white">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block py-2 text-sm text-red-400 hover:text-red-300">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
