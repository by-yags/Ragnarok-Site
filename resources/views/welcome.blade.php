<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ragnarok - New Journey</title>
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
                <li><a href="{{ route('gallery') }}">Gallery</a></li>
                <li><a href="{{ route('login') }}">Login/Register</a></li>
            </ul>
            <button class="nav-toggle" id="nav-toggle">☰</button>
        </nav>
    </header>

    <main>
        <section class="hero-banner">
            <div class="hero-content">
                <h1>A New Journey Begins</h1>
                <p>Explore a vast world of myth and adventure.</p>
            </div>
        </section>

        <div class="container">
            <!-- Latest Updates Section -->
            <section id="updates" class="section">
                <h2 class="section-title">Latest Updates</h2>
                <div class="card-grid">
                    @isset($updates)
                        @foreach ($updates as $update)
                            <div class="card">
                                <img src="{{ asset('images/update-thumb.jpg') }}" alt="Update Thumbnail" class="card-img">
                                <div class="card-content">
                                    <p class="date">{{ $update['date'] }}</p>
                                    <h3>{{ $update['title'] }}</h3>
                                    <a href="#" class="btn">Read more</a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </section>

            <!-- Events & Promotions Section -->
            <section id="events" class="section">
                <h2 class="section-title">Events & Promotions</h2>
                <div class="card-grid">
                    @isset($events)
                        @foreach ($events as $event)
                            <div class="card">
                                <img src="{{ asset('images/event-thumb.jpg') }}" alt="Event Thumbnail" class="card-img">
                                <div class="card-content">
                                    <p class="date">{{ $event['date'] }}</p>
                                    <h3>{{ $event['title'] }}</h3>
                                    <a href="#" class="btn">Read more</a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </section>

            <!-- Patch Notes Section -->
            <section id="patch-notes" class="section">
                <h2 class="section-title">Patch Notes / Maintenance</h2>
                <div class="card-grid">
                    @isset($patchNotes)
                        @foreach ($patchNotes as $note)
                            <div class="card">
                                <img src="{{ asset('images/patch-thumb.jpg') }}" alt="Patch Thumbnail" class="card-img">
                                <div class="card-content">
                                    <p class="date">{{ $note['date'] }}</p>
                                    <h3>{{ $note['title'] }}</h3>
                                    <a href="#" class="btn">Read more</a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </section>
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
