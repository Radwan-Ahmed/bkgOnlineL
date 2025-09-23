@extends('layouts.app')
@section('title', $category->name)

@section('content')
<h2 class="mb-4">{{ $category->name }}</h2>
<div class="row">
    @foreach($category->products as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            @if($product->image)
                <img src="{{ asset('images/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Price: ৳{{ $product->price }}</p>
                <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary btn-sm">View</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
