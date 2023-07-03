@extends('adm.app')

@section('title', 'Iklan')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Iklan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ads.admin') }}">Iklan</a></li>
        <li class="breadcrumb-item active">Detail Iklan</li>
    </ol>
    <div class="card mb-4 mt-4">
        <div class="card-body">
     
        </div>
    </div>
    @if(session('success'))
    <p class="alert alert-success mt-4">{{ session('success') }}</p>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <h3><b>Sekilas Iklan</b></h3>
            <div class="mt-3">
                <b>Judul</b>
                <p>{{ $ad->title }}</p>
            </div>
            <div>
                <b>Kategori</b>
                <p>{{ $ad->categories->cateogory }}</p>
            </div>
            <div class="mt-3">
                <b>Deskripsi</b>
                <p>{{ $ad->desc }}</p>
            </div>
            <hr>
            <h3 class="mt-3"><b>Detail Iklan</b></h3>
            <div class="row mt-3">
                <div class="col-md-3">
                    <b>Luas dalam Hektar</b>
                    <p>{{ $ad->large }}</p>
                </div>
                <div class="col-md-3">
                    <b>Sertifikasi</b>
                    <p>{{ $ad->certification }}</p>
                </div>
                <div class="col-md-3">
                    <b>Harga</b>
                    <p>{{ $ad->price }}</p>
                </div>
                <div class="col-md-3">
                    <b>Kurun Sewa</b>
                    <p>{{ $ad->period }}</p>
                </div>
                <div class="col-md-3">
                    <b>Kurun Sewa</b>
                    <p>{{ $ad->period }}</p>
                </div>
                <div class="col-md-3">
                    <b>Status</b>
                    <div>
                        <button class="btn btn-sm {{ ($ad->status == 0) ? 'btn-danger' : 'btn-success' }}">{{ ($ad->status == 0) ? "Belum terverifikasi" : "Terverifikasi" }}</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <b>Kondisi</b>
                    <div>
                        <button class="btn btn-sm {{ ($ad->condition == 1) ? 'btn-danger' : 'btn-primary' }}">{{ ($ad->condition == 1) ? "Tersewa" : "Tersedia" }}</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Terbit</b>
                    <p>{{ Carbon::parse($ad->created_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Diperbarui</b>
                    <p>{{ Carbon::parse($ad->updated_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
            </div>
            <div class="bd-example bd-example-images">
                <b>Gambar</b>
                <div class="mt-3">
                    <img src="{{ URL::asset('ads/' . $ad->picture_one) }}" alt="{{ $ad->title }}" class="img-thumbnail fit-image me-2"">
                    <img src="{{ URL::asset('ads/' . $ad->picture_two) }}" alt="{{ $ad->title }}" class="img-thumbnail fit-image me-2"">
                    <img src="{{ URL::asset('ads/' . $ad->picture_three) }}" alt="{{ $ad->title }}" class="img-thumbnail fit-image me-2"">
                    <img src="{{ URL::asset('ads/' . $ad->picture_four) }}" alt="{{ $ad->title }}" class="img-thumbnail fit-image me-2"">
                </div>
            </div>
            <hr>
            <h3 class="mt-3"><b>Fasilitas & Tambahan</b></h3>
            <div class="row mt-3">
                <div class="col-md-3">
                    <b>Irigasi</b>
                    <p>{{ ($ad->is_irigation == 1) ? ($ad->irigation ?? "Penjelas tidak ada") : "Tidak ada irigasi"}}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanah</b>
                    <p>{{ $facility->land ?? "Data tidak ada" }}</p>
                </div>
                <div class="col-md-3">
                    <b>Akses Jalan</b>
                    <p>{{ $facility->road ?? "Data tidak ada" }}</p>
                </div>
                <div class="col-md-3">
                    <b>Pemandangan</b>
                    <p>{{ $facility->view ?? "Data tidak ada" }}</p>
                </div>
                <div class="col-md-3">
                    <b>Jarak Sumber Air Dalam Meter</b>
                    <p>{{ $facility->range ?? "Data tidak ada" }}</p>
                </div>
                <div class="col-md-3">
                    <b>Suhu dalam Celcius</b>
                    <p>{{ $facility->temperature ?? "Data tidak ada" }}</p>
                </div>
                <div class="col-md-3">
                    <b>Ketinggian dalam Mdpl</b>
                    <p>{{ $facility->height ?? "Data tidak ada" }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <b>Larangan</b>
                <p>{{ $ad->notice }}</p>
            </div>
            <hr>
            <h3 class="mt-3"><b>Data Pemilik</b></h3>
            <div class="row mt-3">
                <div class="col-md-3">
                    <b>Nama Lengkap</b>
                    <p>{{ $ad->user->fname . " " . $ad->user->lname}}</p>
                </div>
                <div class="col-md-3">
                    <b>Email</b>
                    <p>{{ $ad->user->email }}</p>
                </div>
                <div class="col-md-3">
                    <b>Alamat</b>
                    <p>{{ $ad->user->address }}</p>
                </div>
                <div class="col-md-3">
                    <b>Telepon</b>
                    <p>{{$ad->user->phone}}</p>
                </div>
                <div class="col-md-3">
                    <b>Profesi</b>
                    <p>{{ $ad->user->work }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Daftar</b>
                    <p>{{ Carbon::parse($ad->user->created_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Diperbarui</b>
                    <p>{{ Carbon::parse($ad->user->updated_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
            </div>
            <div class="bd-example bd-example-images">
                <b>Foto Profil</b>
                <div class="mt-3">
                    <img src="{{ URL::asset('profiles/' . $ad->user->profile_picture) }}" alt="{{ $ad->user->fname }}" class="img-thumbnail fit-image me-2"">
                </div>
            </div>
            <hr>
            <form action="{{ route('ads.admin.update', $ad->id) }}" method="post">
                @csrf
                <input type="hidden" name="status" value="{{ ($ad->status == 0) ? '1' : '0' }}"">
                <button class="btn {{ ($ad->status == 0) ? 'btn-primary' : 'btn-danger' }}">{{ ($ad->status == 0) ? 'Verifikasi' : 'Batalkan Verifikasi' }}</button>
            </form> 
        </div>
    </div>
</div>
@endsection