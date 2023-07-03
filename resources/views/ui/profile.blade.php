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
                            <img src="{{ URL::asset('profiles/' . $customer->profile_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                    <div class=" col-md-3">
                            <b>Foto KTP</b>
                            <div class="mt-3">
                                <img src="{{ URL::asset('ktps/' . $customer->ktp_picture) }}" alt="{{ $customer->fname }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mt-3">
                                <div>
                                    <a href="{{ route('profile.edit', $customer->id) }}" class="btn btn-sm btn-primary">Edit Profil</a>
                                    <a href="{{ route('profile.change.password', $customer->id) }}" class="btn btn-sm btn-primary">Ganti Password</a>
                                </div>
                            </div>
                            <hr>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Wishlist</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Booking</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="sewa-tab" data-bs-toggle="tab" data-bs-target="#sewa-tab-pane" type="button" role="tab" aria-controls="sewa-tab-pane" aria-selected="false">Sewa</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Iklan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="booking-tab" data-bs-toggle="tab" data-bs-target="#booking-tab-pane" type="button" role="tab" aria-controls="booking-tab-pane" aria-selected="false">Pembooking</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="penyewa-tab" data-bs-toggle="tab" data-bs-target="#penyewa-tab-pane" type="button" role="tab" aria-controls="penyewa-tab-pane" aria-selected="false">Penyewa</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
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

                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach($wishlists as $wishlist)
                                            <tr>
                                                <td style="width:5%;">{{ $no++ }}</td>
                                                <td>{{ $wishlist->title }}</td>
                                                <td>{{ $wishlist->address }}</td>
                                                <td>{{ $wishlist->categories->cateogory }}</td>
                                                <td><button class="btn btn-sm {{ ($wishlist->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($wishlist->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                                                <td style="width:15%;">
                                                    <form action="{{ route('profile.update.wishlist', $wishlist->id) }}" method="post">
                                                        @csrf
                                                        <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $wishlist->id) }}"><i class="fas fa-eye"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apa anda yakin ingin menghapusnya ?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Alamat</th>
                                                <th>Kategori</th>
                                                <th>Kondisi</th>
                                                <th>Tanggal Survey</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach($bookings as $booking)
                                            <tr>
                                                <td style="width:5%;">{{ $no++ }}</td>
                                                <td>{{ $booking->title }}</td>
                                                <td>{{ $booking->address }}</td>
                                                <td>{{ $booking->categories->cateogory }}</td>
                                                <td><button class="btn btn-sm {{ ($booking->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($booking->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                                                <td>{{ App\Models\Booking::where(['id_lahan' => $booking->id, 'id_user' => Auth::guard('web')->user()->id])->first()->survey_date ?? "Tidak ada survey" }}</td>
                                                <td style="width:15%;">
                                                    <form action="{{ route('profile.update.booking', $booking->id) }}" method="post">
                                                        @csrf
                                                        <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $booking->id) }}"><i class="fas fa-eye"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apa anda yakin ingin menghapusnya ?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="sewa-tab-pane" role="tabpanel" aria-labelledby="sewa-tab" tabindex="0">
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
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach($rents as $rent)
                                            <tr>
                                                <td style="width:5%;">{{ $no++ }}</td>
                                                <td>{{ $rent->title }}</td>
                                                <td>{{ $rent->address }}</td>
                                                <td>{{ $rent->categories->cateogory }}</td>
                                                <td style="width:15%;">
                                                    <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $rent->id) }}"><i class="fas fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rent.show', $rent->id) }}"><i class="fas fa-list"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                    <table class="table mt-3">
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
                                                <td style="width:15%;">
                                                    <form action="{{ route('ads.delete', $ad->id) }}" method="post">
                                                        @csrf
                                                        <a class="btn btn-sm btn-primary" href="{{ route('ads.edit', $ad->id) }}"><i class="fas fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $ad->id) }}"><i class="fas fa-eye"></i></a>
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apa anda yakin ingin menghapusnya ?')"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="booking-tab-pane" role="tabpanel" aria-labelledby="booking-tab" tabindex="0">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Iklan</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Tanggal Survey</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach($books as $book)
                                            <tr>
                                                <td style="width:5%;">{{ $no++ }}</td>
                                                <td><b>{{ $book->ads->title }}</b></td>
                                                <td>{{ $book->user->fname . ' ' . $book->user->lname }}</td>
                                                <td>{{ $book->user->address }}</td>
                                                <td>{{ $book->user->email }}</td>
                                                <td>{{ $book->user->phone }}</td>
                                                <td>{{ App\Models\Booking::where(['id_lahan' => $ad->id, 'id_user' => $book->user->id])->first()->survey_date ?? "Tidak ada survey" }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="penyewa-tab-pane" role="tabpanel" aria-labelledby="penyewa-tab" tabindex="0">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Iklan</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1 @endphp
                                            @foreach($ownRents as $book)
                                            <tr>
                                                <td style="width:5%;">{{ $no++ }}</td>
                                                <td><b>{{ $book->ads->title }}</b></td>
                                                <td>{{ $book->user->fname . ' ' . $book->user->lname }}</td>
                                                <td>{{ $book->user->address }}</td>
                                                <td>{{ $book->user->email }}</td>
                                                <td>{{ $book->user->phone }}</td>
                                                <td>{{ $book->status == 0 ? "Belum Disetujui" : "Disetujui" }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('rent.show.fromAds', $book->id) }}"><i class="fas fa-list"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <hr>
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
                <hr> -->
                            <!-- <h3 class=" mt-3"><b>Lahan yang Saya Sewa</b></h3>
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
                            <td>{{ $rent->title }}</td>
                            <td>{{ $rent->address }}</td>
                            <td>{{ $rent->categories->cateogory }}</td>
                            <td style="width:15%;">
                                <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $rent->id) }}"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="{{ route('rent.show', $rent->id) }}"><i class="fas fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr> -->
                            <!-- <h3 class=" mt-3"><b>Wishlist Saya</b></h3>
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
                            <td>{{ $wishlist->title }}</td>
                            <td>{{ $wishlist->address }}</td>
                            <td>{{ $wishlist->categories->cateogory }}</td>
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
                <hr> -->
                            <!-- <h3 class=" mt-3"><b>Booking Saya</b></h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Alamat</th>
                            <th>Kategori</th>
                            <th>Kondisi</th>
                            <th>Tanggal Survey</th>
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
                            <th>Tanggal Survey</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach($bookings as $booking)
                        <tr>
                            <td style="width:5%;">{{ $no++ }}</td>
                            <td>{{ $booking->title }}</td>
                            <td>{{ $booking->address }}</td>
                            <td>{{ $booking->categories->cateogory }}</td>
                            <td><button class="btn btn-sm {{ ($booking->condition == 1) ? 'btn-danger' : 'btn-primary' }} disabled">{{ ($booking->condition == 1) ? "Tersewa" : "Tersedia" }}</button></td>
                            <td>{{ App\Models\Booking::where(['id_lahan' => $booking->id, 'id_user' => Auth::guard('web')->user()->id])->first()->survey_date ?? "Tidak ada survey" }}</td>
                            <td style="width:15%;">
                                <form action="{{ route('profile.update.booking', $booking->id) }}" method="post">
                                    @csrf
                                    <a class="btn btn-sm btn-warning" href="{{ route('ads.show', $booking->id) }}"><i class="fas fa-eye"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> -->
                        </div>
                    </div>
                </div>
            </div>
            @endsection