@extends('adm.app')

@section('title', 'Pemilik')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Iklan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ads.admin') }}">Pemilik</a></li>
        <li class="breadcrumb-item active">Detail Pemilik</li>
    </ol>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
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
            <h3 class="mt-3"><b>Data Pemilik</b></h3>
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
                            <img src="{{ asset('profiles/' . $customer->profile_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <b>Foto KTP</b>
                        <div class="mt-3">
                            <img src="{{ asset('profiles/' . $customer->ktp_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3 class="mt-3"><b>Data Iklan</b></h3>
            <table id="datatablesSimple" class="mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Alamat</th>
                        <th>Kateogori</th>
                        <th>Status</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Alamat</th>
                        <th>Kateogori</th>
                        <th>Status</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($ads as $ad)
                    <tr>
                        <td style="width:5%;">{{ $no++ }}</td>
                        <td>{{ $ad->title }}</td>
                        <td>{{ $ad->address }}</td>
                        <td>{{ $ad->categories->cateogory }}</td>
                        <td><button class="btn btn-sm {{ ($ad->status == 0) ? 'btn-danger' : 'btn-success' }}">{{ ($ad->status == 0) ? "Belum terverifikasi" : "Terverifikasi" }}</button></td>
                        <td>{{ $ad->user->fname . " " . $ad->user->lname }}</td>
                        <td style="width:10%;">
                            <form action="{{ route('ads.admin.delete', $ad->id) }}" method="post">
                                @csrf
                                <a class="btn btn-sm btn-warning" href="{{ route('ads.admin.detail', $ad->id) }}"><i class="fas fa-eye"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection