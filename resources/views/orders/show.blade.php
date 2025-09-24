@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container mt-4">
    <h2>Order #{{ $order->id }}</h2>
    <p><strong>Product:</strong> {{ $order->product_name }}</p>
    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
    <p><strong>Price:</strong> ৳{{ number_format($order->price, 2) }}</p>
    <p><strong>Placed On:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">← Back to Orders</a>
</div>
@endsection
