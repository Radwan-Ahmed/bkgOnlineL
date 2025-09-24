@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">📦 Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            ➕ Add Product
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Added By</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td class="fw-semibold">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '—' }}</td>
                            <td>{{ $product->admin ? $product->admin->name : 'Unknown' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('images/products/'.$product->image) }}"
                                         alt="Product Image"
                                         class="img-thumbnail" width="60">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        🗑 Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                🚫 No products available
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
