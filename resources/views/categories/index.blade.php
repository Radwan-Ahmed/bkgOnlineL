@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h1>All Categories</h1>
<ul>
    @foreach($categories as $category)
        <li>
            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
@endsection
