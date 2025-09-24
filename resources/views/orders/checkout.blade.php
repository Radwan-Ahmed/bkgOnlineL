@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Product Summary</h5>
                <p><strong>{{ $product->name }}</strong></p>
                <p>Price: ৳{{ $product->price }}</p>
                <img src="{{ asset('images/products/'.$product->image) }}"
                     alt="{{ $product->name }}" class="img-fluid" style="max-height:200px;">
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5>Your Information</h5>
                <form action="{{ route('order.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ Auth::user()->email ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
