<nav class="flex justify-between">
    <div class="flex gap-4">
        <x-home-nav-link href="/" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-home-nav-link>
        <x-home-nav-link href="/learn" :active="request()->routeIs('learn')">
            {{ __('Belajar') }}
        </x-home-nav-link>
        <x-home-nav-link href="/dictionary" :active="request()->routeIs('volunteer')">
            {{ __('Kamus') }}
        </x-home-nav-link>
        <x-home-nav-link href="/volunteer" :active="request()->routeIs('volunteer')">
            {{ __('Volunteer') }}
        </x-home-nav-link>
    </div>
    <div class="flex gap-4">
        <a href="/login" class="font-bold">Masuk</a>
        <a href="/register" class="font-bold">Daftar</a>
    </div>
</nav>
