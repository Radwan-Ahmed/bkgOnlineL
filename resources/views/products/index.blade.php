@extends('layouts.app') {{-- Use your main user layout --}}

@section('title', 'Products')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">All Products</h1>

    {{-- Category Filter --}}
    <div class="mb-4">
        <strong>Filter by Category:</strong>
        @foreach($categories as $category)
            <a href="{{ route('category.show', $category->id) }}" class="btn btn-outline-secondary btn-sm">{{ $category->name }}</a>
        @endforeach
    </div>

    {{-- Products Grid --}}
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('images/products/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Price: ৳{{ $product->price }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm mb-2 w-100">View</a>
                            {{-- Add to Cart --}}
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
