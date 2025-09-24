@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mt-4">
    <h2>My Orders</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Placed On</th>
                <th>Action</th>
            </tr>
        </thead>
 <tbody>
    @forelse($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>৳{{ number_format($order->price, 2) }}</td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
<td class="d-flex gap-2">
    {{-- View Order --}}
    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
        <i class="bi bi-eye"></i> View
    </a>

    {{-- Cancel Order (only if pending) --}}
    @if($order->status === 'pending')
        <form action="{{ route('orders.cancel', $order->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to cancel this order?');">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="bi bi-x-circle"></i> Cancel
            </button>
        </form>
    @else
        @php
            $badgeClass = match($order->status) {
                'completed' => 'success',
                'cancelled' => 'danger',
                'pending'   => 'warning',
                default     => 'secondary',
            };
        @endphp
        <span class="badge bg-{{ $badgeClass }}">
            {{ ucfirst($order->status) }}
        </span>
    @endif
</td>

        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted py-3">
                <i class="bi bi-bag-x"></i> No orders found.
            </td>
        </tr>
    @endforelse
</tbody>

    </table>

    {{-- Pagination Links --}}
    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection
