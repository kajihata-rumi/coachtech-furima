<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
        return view('purchase.create');
    }

    public function address($item_id)
    {
        return view('purchase.address');
    }
}