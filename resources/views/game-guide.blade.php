@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4 text-white">Game Guide – Item Database</h1>

    <div class="bg-gray-800 p-4 rounded-lg mb-8">
        <form action="{{ route('game-guide') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Enter item name..." class="w-full bg-gray-700 text-white p-2 rounded">
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">Search</button>
                </div>
            </div>
        </form>
    </div>

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
@endsection
