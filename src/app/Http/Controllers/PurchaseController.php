<?php

namespace App\Http\Controllers;

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

        $user = auth()->user();

        $shipping = [
            'postal_code' => data_get($user, 'postal_code', ''),
            'address' => data_get($user, 'address', ''),
            'building' => data_get($user, 'building', ''),
        ];

        return view('purchase.create', compact('item', 'shipping'));
    }

    public function address($item_id)
    {
        $item = Item::findOrFail($item_id);

        if ($item->purchase) {
            return redirect()
                ->route('items.show', ['item_id' => $item->id])
                ->with('error', '売り切れの商品です。');
        }

        $user = auth()->user();

        $shipping = [
            'postal_code' => data_get($user, 'postal_code', ''),
            'address' => data_get($user, 'address', ''),
            'building' => data_get($user, 'building', ''),
        ];

        return view('purchase.address', compact('item', 'shipping'));
    }
}