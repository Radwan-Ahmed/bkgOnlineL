@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $quantity)
                    @php
                        $product = \App\Models\Product::find($id);
                    @endphp
                    <tr>
                        <td>{{ $product->name ?? 'Deleted Product' }}</td>
                        <td>{{ $quantity }}</td>
                        <td class="d-flex gap-2">
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>

                            @if($product)
                            <form action="{{ route('order.store', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="{{ $quantity }}">
                                <button type="submit" class="btn btn-primary btn-sm">Order</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
