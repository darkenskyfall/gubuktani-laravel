@extends('adm.app')

@section('title', 'Admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category') }}">Admin</a></li>
        <li class="breadcrumb-item active">Edit Admin</li>
    </ol>
    <div class="card mb-4 mt-4">
        <div class="card-body">
        
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Admin
        </div>
        <div class="card-body">
            @if(session('success'))
            <p class="alert alert-success mt-3">{{ session('success') }}</p>
            @endif
            <form class="mt-3" action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    <small>Lewati jika tidak mengganti password</small>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" class="form-control" value="{{ old('password') }}">
                    <small>Lewati jika tidak mengganti password</small>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection