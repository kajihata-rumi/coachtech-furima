<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('mypage.profile');
    }

    public function update(Request $request)
    {
/** @var \App\Models\User $user */
    $user = auth()->user();

    $user->name = $request->input('name');
    $user->postal_code = $request->input('postal_code');
    $user->address = $request->input('address');
    $user->building = $request->input('building');

    $user->save();

    return redirect()->route('profile.show');
    }

    public function show(Request $request)
    {
    $user = auth()->user();
    $page = $request->query('page', 'sell');

    if ($page === 'buy') {
        $items = Purchase::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->pluck('item')
            ->filter();
    } else {
        $items = Item::where('user_id', $user->id)
            ->latest()
            ->get();
    }

    return view('mypage.index', compact('user', 'page', 'items'));
    }
}

