@extends('layouts.app')

@section('content')
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
@endsection
