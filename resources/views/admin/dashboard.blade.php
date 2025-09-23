@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Dashboard cards --}}
       <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text display-4">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text display-4">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Admins</h5>
                    <p class="card-text display-4">{{ $totalAdmins }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Search form --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="{{ request('search') }}">
        <button class="btn btn-primary">Search</button>
    </form>

    {{-- Latest Products Table --}}
    <div class="card">
        <div class="card-header">
            Latest Products
        </div>
        <div class="card-body table-responsive">
            <h2 class="mt-5">Latest Products</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Added By</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($latestProducts as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
            <td>{{ $product->admin ? $product->admin->name : 'Unknown' }}</td>
            <td>{{ $product->created_at->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

            {{-- Pagination links --}}
            <div class="mt-3">
                {{ $latestProducts->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
