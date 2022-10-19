@extends('ui.app')

@section('title', 'Login')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Login</h1>
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif
    <form class="mt-3">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" required>
        </div>
        <p>Belum Punya Akun? <a href="{{ url('/register') }}">Daftar Sekarang!</a></p>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
