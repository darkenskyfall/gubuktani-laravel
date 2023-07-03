@extends('adm.app')

@section('title', 'Dashboard')

@php
use Carbon\Carbon;
@endphp


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard Admin</li>
    </ol>
    <div class="mt-3">
    <h2>Selamat Datang {{ Auth::guard('admin')->user()->name }}</h2>
    <h4>Hari Tanggal: {{ Carbon::now()->format('D Y/m/d H:i:s'); }}</h4>
    </div>
    <hr>
    <div class="row mt-3">
        <div class="col-xl-4 col-md-4">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    Belum Terverifikasi
                    <h3>{{ $unverif }} Iklan</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('ads.admin') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    Pengguna
                    <h3>{{ $cust }} Pengguna</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('customer') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    Umpan Balik
                    <h3>{{ $feed }} Umpan Balik</h3>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('feedback') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection