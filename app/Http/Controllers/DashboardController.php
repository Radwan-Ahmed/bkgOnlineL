<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalOrders = $user->orders()->count();
        $totalWishlist = $user->wishlist()->count();
        $recentOrders = $user->orders()->latest()->take(5)->get();
        $recentWishlist = $user->wishlist()->latest()->take(5)->get();
        $recentProducts = Product::latest()->take(8)->get();


        return view('dashboard', compact('totalOrders', 'totalWishlist', 'recentOrders', 'recentProducts'));


    }
}
