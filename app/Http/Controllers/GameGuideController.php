<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

class GameGuideController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $items = new Collection();

        if ($search) {
            $json = File::get(storage_path('app/ratemyserver_items.json'));
            $allItems = new Collection(json_decode($json, true));

            $items = $allItems->filter(function ($item) use ($search) {
                return (isset($item['item_id']) && strpos((string)$item['item_id'], $search) !== false) ||
                       (isset($item['name']) && false !== stripos($item['name'], $search));
            });
        }

        if ($request->wantsJson()) {
            return response()->json($items);
        }

        return view('game-guide', [
            'items' => $items,
            'search' => $search,
        ]);
    }
}
