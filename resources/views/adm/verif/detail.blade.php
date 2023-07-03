@extends('adm.app')

@section('title', 'Verifikasi Pengguna')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Iklan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ads.admin') }}">Verifikasi Pengguna</a></li>
        <li class="breadcrumb-item active">Detail Verifikasi Pengguna</li>
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
            <h3 class="mt-3"><b>Data Verifikasi Pengguna</b></h3>
            <div class="row mt-3">
                <div class="col-md-3">
                    <b>Nama Lengkap</b>
                    <p>{{ $customer->fname . " " . $customer->lname}}</p>
                </div>
                <div class="col-md-3">
                    <b>Email</b>
                    <p>{{ $customer->email }}</p>
                </div>
                <div class="col-md-3">
                    <b>Alamat</b>
                    <p>{{ $customer->address }}</p>
                </div>
                <div class="col-md-3">
                    <b>Telepon</b>
                    <p>{{$customer->phone}}</p>
                </div>
                <div class="col-md-3">
                    <b>Profesi</b>
                    <p>{{ $customer->work }}</p>
                </div>
                <div class="col-md-3">
                    <b>KTP</b>
                    <p>{{ $customer->ktp }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Daftar</b>
                    <p>{{ Carbon::parse($customer->created_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Diperbarui</b>
                    <p>{{ Carbon::parse($customer->updated_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
            </div>
            <div class="bd-example bd-example-images">
                <div class="row">
                    <div class="col-md-3">
                        <b>Foto Profil</b>
                        <div class="mt-3">
                            <img src="{{ URL::asset('profiles/' . $customer->profile_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                    <div class=" col-md-3">
                            <b>Foto KTP</b>
                            <div class="mt-3">
                                <img src="{{ URL::asset('ktps/' . $customer->ktp_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                    <div class=" col-md-3">
                                <b>Status Verifikasi Email</b>
                                <button class="btn btn-sm {{ ($customer->email_verified_at == NULL) ? 'btn-danger' : 'btn-success' }}">{{ ($customer->email_verified_at == NULL) ? "Belum terverifikasi" : "Terverifikasi" }}</button>
                            </div>
                            <div class="col-md-3">
                                <b>Status Verifikasi KTP</b>
                                <button class="btn btn-sm {{ ($customer->ktp_verified_at == NULL) ? 'btn-danger' : 'btn-success' }}">{{ ($customer->ktp_verified_at == NULL) ? "Belum terverifikasi" : "Terverifikasi" }}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @if($customer->email_verified_at != NULL)
            <form action="{{ route('customer.new.update', $customer->id) }}" method="post">
                @csrf
                <input type="hidden" name="status" value="{{ ($customer->ktp_verified_at == NULL) ? '1' : '0' }}"">
                        <button class=" btn {{ ($customer->ktp_verified_at == NULL) ? 'btn-primary' : 'btn-danger' }}">{{ ($customer->ktp_verified_at == NULL) ? 'Verifikasi' : 'Batalkan Verifikasi' }}</button>
            </form> 
            @endif
        </div>
        @endsection