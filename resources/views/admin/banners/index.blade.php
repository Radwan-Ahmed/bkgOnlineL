@extends('admin.layouts.app')

@section('title', 'Banners')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">🏞️ Banners</h1>
        <a href="{{ route('banners.create') }}" class="btn btn-success">
            ➕ Add Banner
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->link ?? '-' }}</td>
                        <td>
                            @if($banner->image)
                                <img src="{{ asset('images/banners/'.$banner->image) }}" width="80" alt="{{ $banner->title }}">
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-primary me-1">Edit</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">No banners found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
