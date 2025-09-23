@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">


    {{-- Top Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="fs-3">{{ $totalOrders ?? 0 }}</p>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">View Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Wishlist Items</h5>
                    <p class="fs-3">{{ $totalWishlist ?? 0 }}</p>
                    <a href="{{ route('wishlist.index') }}" class="btn btn-sm btn-outline-success">View Wishlist</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Recent Products</h5>
                    <p class="fs-3">{{ $recentProducts->count() ?? 0 }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Shop Now</a>
                </div>
            </div>
        </div>

    </div>

    {{-- Latest Products --}}
    <h3 class="mb-3">Latest Products</h3>
    <div class="row g-4">
        @foreach($recentProducts as $product)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">
                @if($product->image)
                <img src="{{ asset('images/products/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title">{{ $product->name }}</h6>
                    <p class="mb-2 text-primary">৳{{ $product->price }}</p>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-primary">View</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Recent Orders --}}
    <h3 class="mt-5 mb-3">Recent Orders</h3>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Date</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>{{ $order->products_count ?? 0 }}</td>
                    <td>৳{{ $order->total_price ?? 0 }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No recent orders found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
