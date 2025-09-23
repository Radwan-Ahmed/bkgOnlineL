@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="container mt-4">
    <h2>My Wishlist</h2>
    <div class="row">
        @forelse($wishlists as $wishlist)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($wishlist->product->image)
                        <img src="{{ asset('images/products/'.$wishlist->product->image) }}" class="card-img-top" alt="{{ $wishlist->product->name }}">
                    @endif
                    <div class="card-body">
                        <h5>{{ $wishlist->product->name }}</h5>
                        <p>৳{{ $wishlist->product->price }}</p>
                        <form action="{{ route('wishlist.remove', $wishlist->product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No products in your wishlist.</p>
        @endforelse
    </div>
</div>
@endsection
