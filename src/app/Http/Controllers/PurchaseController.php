<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->purchase) {
            return redirect()
                ->route('items.show', ['item_id' => $item->id])
                ->with('error', '売り切れの商品です。');
        }

        return view('purchase.create', compact('item'));
    }

    public function address($item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->purchase) {
            return redirect()
                ->route('items.show', ['item_id' => $item->id])
                ->with('error', '売り切れの商品です。');
        }

        return view('purchase.address', compact('item'));
    }
}