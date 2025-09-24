@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container my-5" style="max-width: 450px;">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">Create Account</h4>
        </div>
        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                    <div class="mb-3">
        <label for="profile_image" class="form-label">Profile Picture</label>
        <input id="profile_image" type="file" class="form-control" name="profile_image" accept="image/*">
    </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input id="name" type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="form-control" required>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>

                <div class="text-center">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </div>

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            </form>

        </div>
    </div>
</div>

@endsection
