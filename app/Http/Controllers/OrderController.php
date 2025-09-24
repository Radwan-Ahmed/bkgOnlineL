<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Place an order
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        Order::create([
            'user_id' => Auth::id(),
            'product_name' => $product->name,
            'quantity' => $request->quantity ?? 1,
            'price' => $product->price * ($request->quantity ?? 1),
            'status' => 'pending',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    // Show logged-in user's orders
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    // Show single order
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Checkout page
    public function checkout(Product $product)
    {
        return view('orders.checkout', compact('product'));
    }

    // Cancel order
    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())->where('status', 'pending')->findOrFail($id);
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled!');
    }
}
