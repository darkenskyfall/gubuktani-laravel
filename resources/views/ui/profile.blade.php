@extends('ui.app')

@section('title', 'Profil')

@php
use Carbon\Carbon;
@endphp

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Profil</h1>
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif
    <div class="card mb-4 mt-3">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <h3 class="mt-3"><b>Profil Pemilik</b></h3>
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
                    <div class=" col-md-3">
                            <b>Foto KTP</b>
                            <div class="mt-3">
                                <img src="{{ asset('profiles/' . $customer->ktp_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mt-3">
                                <a href="{{ route('profile.edit', $customer->id) }}" class="btn btn-sm btn-primary">Edit Profil</a>
                                <a href="{{ route('profile.change.password', $customer->id) }}" class="btn btn-sm btn-primary">Ganti Password</a>
                            </div>
                            <hr>
                            <h3 class=" mt-3"><b>Iklan</b></h3>
                            <table id="datatablesSimple" class="mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
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
                                        <th>Kategori</th>
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
                                        <td><button class="btn btn-sm {{ ($ad->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($ad->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                                        <!-- <td>
                                            @php
                                            $books = App\Models\Booking::where('id_lahan', $ad->id)->get();
                                            @endphp
                                            <ul>
                                                @foreach($books as $book)
                                                <li>{{ $book->user->fname . ' ' . $book->user->lname }} [{{ $book->user->phone }}]</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            @php
                                            $books = App\Models\Rents::where('id_lahan', $ad->id)->get();
                                            @endphp
                                            <ul>
                                                @foreach($books as $book)
                                                <li>{{ $book->user->fname . ' ' . $book->user->lname }} [{{ $book->user->phone }}]</li>
                                                @endforeach
                                            </ul>
                                        </td> -->
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
                            <hr>
                            <h3 class=" mt-3"><b>Lahan yang Saya Sewa</b></h3>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach($rents as $rent)
                                    <tr>
                                        <td style="width:5%;">{{ $no++ }}</td>
                                        <td>{{ $rent->first()->title }}</td>
                                        <td>{{ $rent->first()->address }}</td>
                                        <td>{{ $rent->first()->categories->cateogory }}</td>
                                        <td style="width:15%;">
                                            <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $rent->first()->id) }}"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('rent.show', $rent->first()->id) }}"><i class="fas fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <h3 class=" mt-3"><b>Wishlist Saya</b></h3>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach($wishlists as $wishlist)
                                    <tr>
                                        <td style="width:5%;">{{ $no++ }}</td>
                                        <td>{{ $wishlist->first()->title }}</td>
                                        <td>{{ $wishlist->first()->address }}</td>
                                        <td>{{ $wishlist->first()->categories->cateogory }}</td>
                                        <td><button class="btn btn-sm {{ ($wishlist->first()->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($wishlist->first()->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                                        <td style="width:15%;">
                                            <form action="{{ route('profile.update.wishlist', $wishlist->id) }}" method="post">
                                                @csrf
                                                <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $wishlist->first()->id) }}"><i class="fas fa-eye"></i></a>
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr>
                            <h3 class=" mt-3"><b>Booking Saya</b></h3>
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Alamat</th>
                                        <th>Kategori</th>
                                        <th>Kondisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php $no = 1 @endphp
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td style="width:5%;">{{ $no++ }}</td>
                                        <td>{{ $booking->first()->title }}</td>
                                        <td>{{ $booking->first()->address }}</td>
                                        <td>{{ $booking->first()->categories->cateogory }}</td>
                                        <td><button class="btn btn-sm {{ ($booking->first()->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($booking->first()->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                                        <td style="width:15%;">
                                            <form action="{{ route('profile.update.booking', $booking->id) }}" method="post">
                                                @csrf
                                                <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $booking->first()->id) }}"><i class="fas fa-eye"></i></a>
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