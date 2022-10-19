@extends('ui.app')

@section('title', 'Register')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Daftar</h1>
    @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger mt-3">{{ $err }}</p>
        @endforeach
    @endif
    <form class="mt-3" action="{{ route('register.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
            <input type="text" name="fname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
            <input type="text" name="lname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat</label>
            <textarea name="address" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Telepon</label>
            <input type="number" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pekerjaan</label>
            <select class="form-select" name="work" aria-label="Default select example" required>
                <option>Pilih Pekerjaan</option>
                <option value="TNI">TNI</option>
                <option value="POLRI">POLRI</option>
                <option value="PNS">PNS</option>
                <option value="ASN">ASN</option>
                <option value="Swasta">Swasta</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirm" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto Profil</label>
            <input type="file" name="profile_picture" class="form-control" required>
        </div>
        <p>Sudah Punya Akun? <a href="{{ url('/login') }}">Login Sekarang!</a></p>
        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection