<nav x-data="{ open: false }" class="bg-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-end gap-4">
                <span
                    class="font-bold font-sans text-2xl text-gray-800 hover:text-gray-600 transition duration-300 ease-in-out">
                    Isyara
                </span>
                <div class="hidden space-x-4 sm:flex">
                    <x-home-nav-link href="/" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-home-nav-link>
                    <x-home-nav-link href="/learn" :active="request()->routeIs('learn')">
                        {{ __('Belajar') }}
                    </x-home-nav-link>
                    <x-home-nav-link href="/dictionary" :active="request()->routeIs('dictionary')">
                        {{ __('Kamus') }}
                    </x-home-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                @auth
                    <div class="relative">
                        <button @click="open = !open"
                                class="flex items-center gap-2 font-bold text-gray-800 focus:outline-none">
                            {{ auth()->user()->name }}
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md z-50">
                            <a href="/saved-words"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Saved Words</a>
                            <a href="/attempted-quiz"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Attempted Quiz</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="font-bold underline">Masuk</a>
                    <a href="/register" class="font-bold underline">Daftar</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16m-7 6h7"/>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-x-2 ml-4">
            <x-home-nav-link href="/" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-home-nav-link>
            <x-home-nav-link href="/learn" :active="request()->routeIs('learn')">
                {{ __('Belajar') }}
            </x-home-nav-link>
            <x-home-nav-link href="/dictionary" :active="request()->routeIs('dictionary')">
                {{ __('Kamus') }}
            </x-home-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 ml-4">
            @auth
                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }}</span>
                </div>
                <div class="mt-3 space-x-2">
                    <a href="/saved-words" class="block font-bold text-gray-700">Saved Words</a>
                    <a href="/attempted-quiz" class="block font-bold text-gray-700">Attempted Quiz</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block font-bold text-gray-700">Logout</button>
                    </form>
                </div>
            @else
                <div class="space-x-2">
                    <a href="/login" class="font-bold">Masuk</a>
                    <a href="/register" class="font-bold">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
