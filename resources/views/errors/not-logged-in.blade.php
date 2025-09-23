@extends('admin.layouts.app')


@section('title', 'Login Required')

@section('content')
<div class="container text-center" style="margin-top: 100px;">
    <h1 class="display-4 text-danger">⚠️ Access Denied</h1>
    <p class="lead">You must be logged in to access this page.</p>
    <a href="{{ route('admin.login') }}" class="btn btn-primary mt-3">Go to Login</a>
</div>
@endsection
