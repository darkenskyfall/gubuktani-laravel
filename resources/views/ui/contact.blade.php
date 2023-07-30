@extends('ui.app')

@section('title', 'Kontak')

@section('content')
<div class="container mb-5 w-50 mx-auto">
    <h1 style="margin-top:100px;">Kontak</h1>
    <p>Jika anda merasa terbantu dengan website ini diharapkan sedianya mengirimkan kritik saran kepada kami selaku penyedia website Gubuktani.online segala sesuatu yang berkaitan dengan website ini atau kesepakatan bisnis dengan kami anda bisa menghubungi kontak dibawah ini</p>

    <ul class="list-group mt-3">
        <li class="list-group-item disabled">support@Gubuktani.online</li>
        <li class="list-group-item disabled">Jl . Manukan Rejo III 1C / 8 , Manukan Kulon , Tandes , Surabaya Jawa Timur 60185</li>
        <li class="list-group-item disabled">+6285 - 881 - 824 - 590</li>
    </ul>

    <h3 class="mt-5">Peta Lokasi</h3>
    <div class="mt-3" style="width:100%;height:400px;background:#27ee71;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8198715524045!2d112.66399439980671!3d-7.26133068031436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fe7d36500087%3A0x7433e0f8546d3751!2sgubuktani+office!5e0!3m2!1sid!2sid!4v1517741241190" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

    <h3 class="mt-5">Umpan Balik</h3>
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif
    <form class="mt-3" action="{{ route('contact.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Isi</label>
            <textarea name="desc" class="form-control" id="" cols="30" rows="10"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim Umpan Balik</button>
    </form>


</div>
@endsection