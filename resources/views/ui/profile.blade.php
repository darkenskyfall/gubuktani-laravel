@extends('ui.app')

@section('title', 'Profil')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Profil</h1>
    <div class="card mb-4 mt-5">
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
                    <b>Tanggal Daftar</b>
                    <p>{{ Carbon::parse($customer->created_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
                <div class="col-md-3">
                    <b>Tanggal Diperbarui</b>
                    <p>{{ Carbon::parse($customer->updated_at)->format('Y/m/d H:i:s'); }}</p>
                </div>
            </div>
            <div class="bd-example bd-example-images">
                <b>Foto Profil</b>
                <div class="mt-3">
                    <img src="{{ asset('profiles/' . $customer->profile_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                </div>
            </div>
            <div class=" mt-3">
                    <button class="btn btn-sm btn-primary">Edit Profil</button>
                    <button class="btn btn-sm btn-primary">Ganti Foto Profil</button>
                    <button class="btn btn-sm btn-primary">Ganti Password</button>
                </div>
                <hr>
                <h3 class=" mt-3"><b>Data Iklan</b></h3>
                @if(session('success'))
                <p class="alert alert-success mt-3">{{ session('success') }}</p>
                @endif
                @if($errors->any())
                @foreach($errors->all() as $err)
                <p class="alert alert-danger mt-3">{{ $err }}</p>
                @endforeach
                @endif
                <table id="datatablesSimple" class="mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Alamat</th>
                            <th>Kateogori</th>
                            <th>Status</th>
                            <th>Kondisi</th>
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
                            <th>Kondisi</th>
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
                            <td><button class="btn btn-sm {{ ($ad->status == 0) ? 'btn-danger' : 'btn-success' }} disabled">{{ ($ad->status == 0) ? "Belum terverifikasi" : "Terverifikasi" }}</button></td>
                            <td><button class="btn btn-sm {{ ($ad->status == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($ad->status == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                            <td style="width:15%;">
                                <form action="{{ route('ads.delete', $ad->id) }}" method="post">
                                    @csrf
                                    <a class="btn btn-sm btn-primary" href="{{ route('ads.edit', $ad->id) }}"><i class="fas fa-pencil"></i></a>
                                    <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $ad->id) }}"><i class="fas fa-eye"></i></a>
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
</div>
@endsection