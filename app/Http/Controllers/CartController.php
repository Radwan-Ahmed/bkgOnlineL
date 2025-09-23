<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Show cart
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Add product to cart
    public function add($id)
    {
        $cart = Session::get('cart', []);
        $cart[$id] = ($cart[$id] ?? 0) + 1; // Increment quantity if exists
        Session::put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove product from cart
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
