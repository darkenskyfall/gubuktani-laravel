@extends('ui.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mb-5 w-50 mx-auto">
    <h1 style="margin-top:100px;">Edit Profil</h1>
    @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger mt-3">{{ $err }}</p>
        @endforeach
    @endif
    <form class="mt-3" action="{{ route('profile.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
            <input type="text" value="{{ $customer->fname }}" name="fname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
            <input type="text" value="{{ $customer->lname }}" name="lname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" value="{{ $customer->email }}" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat</label>
            <textarea name="address" class="form-control" cols="30" rows="10">{{ $customer->address }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Telepon</label>
            <input type="number" value="{{ $customer->phone }}" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pekerjaan</label>
            <select class="form-select" name="work" aria-label="Default select example" required>
                <option value="{{ $customer->work }}">{{ $customer->work }}</option>
                <option value="TNI">TNI</option>
                <option value="POLRI">POLRI</option>
                <option value="PNS">PNS</option>
                <option value="ASN">ASN</option>
                <option value="Swasta">Swasta</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto Profil</label>
            <input type="file" name="profile_picture" class="form-control">
            <small>Lewati jika tidak mengganti foto profil</small>
        </div>
        <button type="submit" class="btn btn-primary">Ganti Profil</button>
    </form>
</div>
@endsection