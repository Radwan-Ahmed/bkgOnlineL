@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mt-4">

    {{-- Product Details --}}
    <div class="row mb-5">
        <div class="col-md-6">
            @if($product->image)
                <img src="{{ asset('images/products/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="h4 text-success">৳ {{ $product->price }}</p>
            <p>{{ $product->description }}</p>

            {{-- Add to Cart --}}
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-3">
                @csrf
                <button type="submit" class="btn btn-success btn-lg w-100">Add to Cart</button>
            </form>
        </div>
    </div>

    {{-- Related Products --}}
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <h3 class="mb-4">Related Products</h3>
    <div class="row">
        @foreach($relatedProducts as $related)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($related->image)
                        <img src="{{ asset('images/products/'.$related->image) }}" class="card-img-top" alt="{{ $related->name }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $related->name }}</h5>
                        <p class="card-text">৳ {{ $related->price }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('product.show', $related->id) }}" class="btn btn-primary btn-sm mb-2 w-100">View</a>
                            <form action="{{ route('cart.add', $related->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
