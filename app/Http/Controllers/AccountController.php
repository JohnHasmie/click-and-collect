<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = auth()->user()->orders;

        return view('orders', compact('orders'));
    }
}
