<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Story - Ragnarok - New Journey</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
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

    <main>
        <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
            <h1 class="text-3xl font-bold mb-4">The History of Ragnarok Online in the Philippines</h1>

            <p class="mb-4">
            Ragnarok Online, often affectionately called “RO” or “Ragna,” is a fantasy MMORPG rooted in Norse mythology and inspired by the Korean manhwa by Lee Myung-jin. Developed by Gravity Co., Ltd., it first launched in South Korea in 2002. The game arrived in the Philippines on June 1, 2003, published by Level Up! Games, and quickly became a cultural phenomenon.
            </p>

            <p class="mb-4">
            Internet cafés across the country transformed into battlegrounds and social hubs as players formed guilds, hunted MVPs, and traded zeny. Servers like Chaos, Loki, Iris, and Fenrir became legendary, with Chaos peaking at over 57,000 concurrent users. Filipino gamers embraced the game’s job system, from humble Novices to powerful Knights, Priests, and Alchemists. RO also introduced a new gaming vocabulary—terms like “gg,” “afk,” “pvp,” and “pots” became part of everyday lingo.
            </p>

            <p class="mb-4">
            Despite its massive success, Ragnarok Online faced a decline as newer games emerged. The original Philippine servers eventually shut down, but nostalgia brought it back. Electronics Extreme revived the game in 2017, followed by the launch of Ragnarok Online Ascendance by Gravity Game Hub in 2022. Mobile versions like Ragnarok M: Eternal Love (2018) and Ragnarok Origin (2023) reignited interest, proving RO’s enduring legacy among Filipino gamers.
            </p>

            <p class="mb-4">
            From its humble beginnings to its modern iterations, Ragnarok Online remains a beloved part of Philippine gaming history—a game that shaped communities, friendships, and an entire generation of players.
            </p>

            <p class="text-sm text-gray-500">
            Sources: <a href="https://steemit.com/gaming/@awchel/ragnarok-online-ph-a-brief-history-and-how-the-first-biggest-online-mmorpg-in-the-philippines-started-until-its-end" target="_blank">Steemit</a>, <a href="https://pinoytechsaga.blogspot.com/2017/11/list-of-all-time-favorite-mmorpgs-in-philippines.html" target="_blank">PinoyTechSaga</a>
            </p>
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

    <script>
        const navToggle = document.getElementById('nav-toggle');
        const navLinks = document.getElementById('nav-links');

        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>
</html>
