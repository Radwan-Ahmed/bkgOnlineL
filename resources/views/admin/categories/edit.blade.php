@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Edit Category</h4>
        </div>
        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Category Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $category->name) }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category Image --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @if($category->image)
                        <img src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}" class="mt-2 rounded" width="100">
                    @endif
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                        ← Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Update Category
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
