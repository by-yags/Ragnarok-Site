<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen flex flex-col bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
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
            <div class="flex w-full max-w-sm flex-col gap-2">
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
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

        @fluxScripts

        <script>
            const navToggle = document.getElementById('nav-toggle');
            const navLinks = document.getElementById('nav-links');

            if (navToggle) {
                navToggle.addEventListener('click', () => {
                    navLinks.classList.toggle('active');
                });
            }
        </script>
    </body>
</html>
