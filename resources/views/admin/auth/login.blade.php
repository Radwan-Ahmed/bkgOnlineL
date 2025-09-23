@extends('admin.layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h3 class="mb-3">Admin Login</h3>
    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

</div>
@endsection
