<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'recommend');
        $keyword = $request->query('keyword');

        if ($tab === 'mylist') {
            if (!Auth::check()) {
                $items = collect();
            } else {
                $items = Item::query()->with(['purchase', 'likes'])
                    ->whereHas('likes', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->when($keyword, function ($query, $keyword) {
                        $query->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->latest()
                    ->get();
            }
        } else {
            $items = Item::query()->with(['purchase', 'likes'])
                ->when(Auth::check(), function ($query) {
                    $query->where('user_id', '!=', Auth::id());
                })
                ->when($keyword, function ($query, $keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->latest()
                ->get();
        }

        return view('items.index', compact('items', 'tab', 'keyword'));
    }

    public function show($item_id)
{
    $item = Item::with([
        'condition',
        'categories',
        'comments.user',
        'likes',
    ])->findOrFail($item_id);

    return view('items.show', compact('item'));
}
}
