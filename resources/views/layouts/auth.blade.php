<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ragnarok - New Journey</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col bg-neutral-950">
    <header class="main-header">
        <nav class="navbar container">
            <a href="{{ route('home') }}" class="nav-logo">Ragnarok ByYags</a>
            <ul class="nav-links" id="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('story') }}">Story</a></li>
                <li><a href="{{ route('game-guide') }}">Game Guide</a></li>
                <li><a href="{{ route('download') }}">Download</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="{{ route('login') }}">Login/Register</a></li>
            </ul>
            <button class="nav-toggle" id="nav-toggle">☰</button>
        </nav>
    </header>

    <div class="hero-banner"></div>

    <main class="flex-grow flex items-center justify-center">
        {{-- Normal Blade views --}}
        @yield('content')

        {{-- Livewire Volt components (like your Login/Register) --}}
        {{ $slot ?? '' }}
    </main>

    <footer class="footer">
        <div class="container">
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p>&copy; {{ date('Y') }} Your Game Company. All rights reserved.</p>
            <p>This is a fictional website for demonstration purposes and is not affiliated with the actual Ragnarok Online.</p>
        </div>
    </footer>

    @livewireScripts

    <script>
        const navToggle = document.getElementById('nav-toggle');
        const navLinks = document.getElementById('nav-links');

        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>
