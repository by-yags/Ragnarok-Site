@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4 text-white">Game Guide – Item Database</h1>

    <div class="bg-gray-800 p-4 rounded-lg mb-8">
        <form action="{{ route('game-guide') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ old('search', request()->input('search')) }}" placeholder="Enter item name or ID..." class="w-full bg-gray-700 text-white p-2 rounded">
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">Search</button>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" id="advanced-search-toggle" class="text-blue-400 hover:text-blue-300">Advanced Search</button>
            </div>

            <div id="advanced-search" class="hidden mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="item_name_contains" class="block text-sm font-medium text-gray-300">Item Name Contains</label>
                        <input type="text" name="item_name_contains" id="item_name_contains" value="{{ old('item_name_contains', request()->input('item_name_contains')) }}" class="w-full bg-gray-700 text-white p-2 rounded">
                    </div>
                    <div>
                        <label for="description_keyword" class="block text-sm font-medium text-gray-300">Description Keyword</label>
                        <input type="text" name="description_keyword" id="description_keyword" value="{{ old('description_keyword', request()->input('description_keyword')) }}" class="w-full bg-gray-700 text-white p-2 rounded">
                    </div>
                    <div>
                        <label for="script_keyword" class="block text-sm font-medium text-gray-300">Script Keyword</label>
                        <input type="text" name="script_keyword" id="script_keyword" value="{{ old('script_keyword', request()->input('script_keyword')) }}" class="w-full bg-gray-700 text-white p-2 rounded">
                    </div>
                    <div>
                        <label for="item_type" class="block text-sm font-medium text-gray-300">Item Type</label>
                        <select name="item_type" id="item_type" class="w-full bg-gray-700 text-white p-2 rounded">
                            <option value="">All</option>
                            <option value="Weapon" @if(old('item_type', request()->input('item_type')) == 'Weapon') selected @endif>Weapon</option>
                            <option value="Armor" @if(old('item_type', request()->input('item_type')) == 'Armor') selected @endif>Armor</option>
                            <option value="Card" @if(old('item_type', request()->input('item_type')) == 'Card') selected @endif>Card</option>
                            <option value="Usable Item" @if(old('item_type', request()->input('item_type')) == 'Usable Item') selected @endif>Usable Item</option>
                        </select>
                    </div>
                    <div>
                        <label for="job" class="block text-sm font-medium text-gray-300">Applicable Jobs</label>
                        <select name="job[]" id="job" class="w-full bg-gray-700 text-white p-2 rounded" multiple>
                            <option value="Novice" @if(in_array('Novice', old('job', request()->input('job', [])))) selected @endif>Novice</option>
                            <option value="Thief" @if(in_array('Thief', old('job', request()->input('job', [])))) selected @endif>Thief</option>
                            <option value="All" @if(in_array('All', old('job', request()->input('job', [])))) selected @endif>All</option>
                        </select>
                    </div>
                    <div>
                        <label for="item_slot" class="block text-sm font-medium text-gray-300">Item Slot</label>
                        <select name="item_slot" id="item_slot" class="w-full bg-gray-700 text-white p-2 rounded">
                            <option value="">All</option>
                            <option value="Right Hand" @if(old('item_slot', request()->input('item_slot')) == 'Right Hand') selected @endif>Right Hand</option>
                            <option value="Armor" @if(old('item_slot', request()->input('item_slot')) == 'Armor') selected @endif>Armor</option>
                            <option value="Weapon" @if(old('item_slot', request()->input('item_slot')) == 'Weapon') selected @endif>Weapon</option>
                            <option value="Consumable" @if(old('item_slot', request()->input('item_slot')) == 'Consumable') selected @endif>Consumable</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-300">Sort by</label>
                        <select name="sort" id="sort" class="w-full bg-gray-700 text-white p-2 rounded">
                            <option value="name_asc" @if(old('sort', request()->input('sort')) == 'name_asc') selected @endif>Item Name Ascending</option>
                            <option value="name_desc" @if(old('sort', request()->input('sort')) == 'name_desc') selected @endif>Item Name Descending</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 col-span-full">
                    <div class="flex items-center">
                        <input id="hide_not_dropped" name="hide_not_dropped" type="checkbox" value="1" @if(old('hide_not_dropped', request()->input('hide_not_dropped'))) checked @endif class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="hide_not_dropped" class="ml-2 block text-sm text-gray-300">Hide items not dropped by monsters</label>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('game-guide') }}" class="bg-gray-500 hover:bg-gray-600 text-white p-2 rounded">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-gray-800 p-4 rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Image</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Item Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- <img src="{{ asset('images/' . $item->image_url) }}" alt="{{ $item->name }}" class="w-10 h-10"> --}}
                                <img src="https://via.placeholder.com/40" alt="{{ $item->name }}" class="w-10 h-10">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ $item->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $item->type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300">{{ $item->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-400 hover:text-blue-300">View Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-300">No items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    </div>
</div>

<script>
    document.getElementById('advanced-search-toggle').addEventListener('click', function () {
        var advancedSearch = document.getElementById('advanced-search');
        if (advancedSearch.classList.contains('hidden')) {
            advancedSearch.classList.remove('hidden');
        } else {
            advancedSearch.classList.add('hidden');
        }
    });
</script>
@endsection
