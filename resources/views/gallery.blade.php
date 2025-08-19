@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endpush

@section('content')
<div class="container gallery-container">
    <h1 class="gallery-title">Gallery</h1>
    <div class="thumbnail-grid">
        @for ($i = 1; $i <= 6; $i++)
            <div class="thumbnail" data-full="{{ asset('images/gallery/' . $i . '.jpg') }}">
                <img src="{{ asset('images/gallery/' . $i . '.jpg') }}" alt="Gallery Image {{ $i }}">
            </div>
        @endfor
    </div>
</div>

<div id="modal" class="modal">
    <span class="close-button">&times;</span>
    <img class="modal-content" id="modal-image">
    <a class="prev-button">&#10094;</a>
    <a class="next-button">&#10095;</a>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
@endpush
