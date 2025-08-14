<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GameGuideController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'item_name_contains' => 'nullable|string|max:255',
            'description_keyword' => 'nullable|string|max:255',
            'script_keyword' => 'nullable|string|max:255',
            'item_type' => 'nullable|string|max:255',
            'job' => 'nullable|array',
            'job.*' => 'string|max:255',
            'item_slot' => 'nullable|string|max:255',
            'sort' => ['nullable', Rule::in(['name_asc', 'name_desc'])],
            'hide_not_dropped' => 'nullable|boolean',
        ]);

        $query = DB::table('items');

        // Search by name or ID
        if ($request->filled('search')) {
            $searchTerm = $validated['search'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('item_id', '=', $searchTerm);
            });
        }

        // Filter by item name contains
        if ($request->filled('item_name_contains')) {
            $query->where('name', 'like', '%' . $validated['item_name_contains'] . '%');
        }

        // Filter by description keyword
        if ($request->filled('description_keyword')) {
            $query->where('description', 'like', '%' . $validated['description_keyword'] . '%');
        }

        // Filter by script keyword
        if ($request->filled('script_keyword')) {
            // Assuming a 'script' column exists
            $query->where('script', 'like', '%' . $validated['script_keyword'] . '%');
        }

        // Filter by item type
        if ($request->filled('item_type')) {
            $query->where('type', $validated['item_type']);
        }

        // Filter by applicable job
        if ($request->filled('job')) {
            $query->whereIn('job', $validated['job']);
        }

        // Filter by item slot
        if ($request->filled('item_slot')) {
            $query->where('slot', $validated['item_slot']);
        }

        // Hide items not dropped by monsters
        if ($request->filled('hide_not_dropped') && $validated['hide_not_dropped']) {
            $query->where('dropped_by_monster', true);
        }

        // Sorting
        if ($request->filled('sort')) {
            $sort = $validated['sort'];
            if ($sort === 'name_asc') {
                $query->orderBy('name', 'asc');
            } elseif ($sort === 'name_desc') {
                $query->orderBy('name', 'desc');
            }
        } else {
            $query->orderBy('name', 'asc');
        }

        $items = $query->paginate(10)->withQueryString();

        return view('game-guide', [
            'items' => $items,
        ]);
    }
}
