<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function show()
{
    $user = auth()->user();
    return view('mypage.index', compact('user'));
}
}

