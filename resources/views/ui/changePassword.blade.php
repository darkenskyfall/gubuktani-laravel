@extends('ui.app')

@section('title', 'Ganti Password')

@section('content')
<div class="container mb-5 w-50 mx-auto">
    <h1 style="margin-top:100px;">Ganti Password</h1>
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger mt-3">{{ $err }}</p>
        @endforeach
    @endif
    <form class="mt-3" action="{{ route('profile.change.password.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password Lama</label>
            <input type="password" name="old_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password Baru</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ganti Password</button>
    </form>
</div>
@endsection