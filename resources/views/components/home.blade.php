<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white min-h-screen">
<!-- Header -->
<header class="shadow py-4 px-4">
    <div class="max-w-7xl mx-auto">
        @include('components.home-navigation')
    </div>
</header>
<!-- Page Content -->
<main class="px-4">
    {{ $slot }}
</main>
<!-- Footer -->
<footer class="bg-teal-800 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h4 class="font-bold text-lg mb-4">Tentang Isyara</h4>
                <p class="text-sm">
                    Isyara adalah platform belajar Bahasa Isyarat Indonesia yang interaktif. Jelajahi berbagai topik dan
                    tingkatkan kemampuan berkomunikasi dengan komunitas tuli.
                </p>
            </div>
            <!-- Links Section -->
            <div>
                <h4 class="font-bold text-lg mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-teal-300">Beranda</a></li>
                    <li><a href="#" class="hover:text-teal-300">Belajar</a></li>
                    <li><a href="#" class="hover:text-teal-300">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-teal-300">Kontak</a></li>
                </ul>
            </div>
            <!-- Contact Section -->
            <div>
                <h4 class="font-bold text-lg mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-sm">
                    <li><i class='bx bx-envelope mr-2'></i>support@isyara.com</li>
                    <li><i class='bx bx-phone mr-2'></i>+62 812 3456 7890</li>
                    <li><i class='bx bxl-instagram mr-2'></i>@isyara_id</li>
                </ul>
            </div>
        </div>
        <div class="mt-8 border-t border-teal-700 pt-4 text-center text-sm">
            <p>&copy; {{ date('Y') }} Isyara. Semua Hak Dilindungi.</p>
        </div>
    </div>
</footer>
</body>
</html>
