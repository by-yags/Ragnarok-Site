@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4 text-white">Game Guide – Item Database</h1>

    <div class="bg-gray-800 p-4 rounded-lg mb-8">
        <form action="{{ route('game-guide') }}" method="GET" id="search-form">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" id="search-input" value="{{ $search ?? '' }}" placeholder="Enter item name or ID..." class="w-full bg-gray-700 text-white p-2 rounded">
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div id="results-container">
        @if($items->count() > 0)
        <div class="bg-gray-800 p-4 rounded-lg">
            <ul class="divide-y divide-gray-700">
                @foreach ($items as $item)
                    <li class="py-4">
                        <h3 class="text-xl font-bold text-white">{{ $item['name'] }}</h3>
                        <p class="text-gray-300">{{ $item['description'] ?? 'No description available.' }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        @elseif($search)
            <div class="bg-gray-800 p-4 rounded-lg text-white text-center">
                <p>No items found for "{{ $search }}".</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const resultsContainer = document.getElementById('results-container');
        const searchForm = document.getElementById('search-form');

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
        });

        let debounceTimer;

        searchInput.addEventListener('input', function (e) {
            const query = e.target.value.trim();

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                if (query.length > 0) {
                    fetch(`{{ route('game-guide') }}?search=${encodeURIComponent(query)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        if (data.length > 0) {
                            const itemsHtml = data.map(item => `
                                <li class="py-4">
                                    <h3 class="text-xl font-bold text-white">${item.name}</h3>
                                    <p class="text-gray-300">${item.description || 'No description available.'}</p>
                                </li>
                            `).join('');
                            html = `<div class="bg-gray-800 p-4 rounded-lg"><ul class="divide-y divide-gray-700">${itemsHtml}</ul></div>`;
                        } else {
                            html = `
                                <div class="bg-gray-800 p-4 rounded-lg text-white text-center">
                                    <p>No items found for "${query}".</p>
                                </div>`;
                        }
                        resultsContainer.innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
                } else {
                    resultsContainer.innerHTML = '';
                }
            }, 2000);
        });
    });
</script>
@endpush
