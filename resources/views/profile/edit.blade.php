@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="row g-0">
                    {{-- Left Sidebar --}}
                    <div class="col-md-4 bg-primary text-white p-4 text-center rounded-start">
                        <div class="mb-3">
                            @if($user->profile_image)
                                <img src="{{ asset('images/users/'.$user->profile_image) }}" alt="Profile Picture" class="rounded-circle img-fluid" style="width:150px; height:150px; object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-light text-primary d-flex align-items-center justify-content-center" style="width:150px; height:150px; font-size:3rem;">
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                </div>
                            @endif
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p>{{ $user->email }}</p>
                    </div>

                    {{-- Right Content --}}
                    <div class="col-md-8 p-4">
                        <h3 class="mb-4">Edit Profile</h3>

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

                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                             @method('PATCH')

                                                         <div class="mb-3">
                                <label class="form-label fw-bold">Profile Image</label>
                                <input type="file" name="profile_image" class="form-control">
                                @if($user->profile_image)
                                    <img src="{{ asset('images/users/'.$user->profile_image) }}" class="mt-2 rounded-circle" width="80" height="80">
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>



                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                        </form>
                    </div>
                </div> {{-- row --}}
            </div> {{-- card --}}
        </div>
    </div>
</div>
@endsection
