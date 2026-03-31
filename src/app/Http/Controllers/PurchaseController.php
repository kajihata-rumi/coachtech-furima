<?php

namespace App\Http\Controllers;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use App\Models\Item;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function create(Item $item)
    {
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

    public function address(Item $item)
    {
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
    public function checkout(Request $request, Item $item)
{
    $request->validate([
        'payment_method' => ['required', 'in:konbini,card'],
    ]);

    if ($item->purchase) {
        return redirect()
            ->route('items.show', ['item_id' => $item->id])
            ->with('error', '売り切れの商品です。');
    }

    if ($item->user_id === auth()->id()) {
        return redirect()
            ->route('items.show', ['item_id' => $item->id])
            ->with('error', '自分の商品は購入できません。');
    }

if (empty(config('services.stripe.secret'))) {
    return redirect()
        ->route('purchase.create', ['item' => $item->id])
        ->with('error', 'Stripeの設定が未完了のため、現在決済機能を確認できません。');
}
    Stripe::setApiKey(config('services.stripe.secret'));

    $paymentMethod = $request->payment_method;

    $sessionParams = [
        'mode' => 'payment',
        'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',
                'product_data' => [
                    'name' => $item->name,
                ],
                'unit_amount' => $item->price,
            ],
            'quantity' => 1,
        ]],
        'success_url' => route('purchase.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('purchase.cancel', ['item' => $item->id]),

        'metadata' => [
        'item_id' => $item->id,
        'user_id' => auth()->id(),
        'payment_method' => $paymentMethod,
        'postal_code' => data_get(auth()->user(), 'postal_code', ''),
        'address' => data_get(auth()->user(), 'address', ''),
        'building' => data_get(auth()->user(), 'building', ''),
        ],
    ];

    if ($paymentMethod === 'card') {
        $sessionParams['payment_method_types'] = ['card'];
    }

    if ($paymentMethod === 'konbini') {
        $sessionParams['payment_method_types'] = ['konbini'];
        $sessionParams['payment_method_options'] = [
            'konbini' => [
                'expires_after_days' => 3,
            ],
        ];
        $sessionParams['customer_email'] = auth()->user()->email;
    }

    $session = Session::create($sessionParams);

    return redirect($session->url);
}

public function success(Request $request)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    $checkoutSession = Session::retrieve($request->session_id);
    $itemId = $checkoutSession->metadata->item_id;

    if (!Purchase::where('item_id', $itemId)->exists()) {
        Purchase::create([
            'user_id' => $checkoutSession->metadata->user_id,
            'item_id' => $itemId,
            'payment_method' => $checkoutSession->metadata->payment_method,
            'postal_code' => data_get($checkoutSession->metadata, 'postal_code', ''),
            'address' => data_get($checkoutSession->metadata, 'address', ''),
            'building' => data_get($checkoutSession->metadata, 'building', ''),
            'purchased_at' => now(),
        ]);
    }

    return view('purchase.success');
}

public function cancel(Item $item)
{
    return redirect()
        ->route('purchase.create', ['item' => $item->id])
        ->with('error', '決済をキャンセルしました。');
}
}