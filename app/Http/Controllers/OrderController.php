<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders ?? []; // adjust if you have Order model
        return view('orders.index', compact('orders'));
    }
}
