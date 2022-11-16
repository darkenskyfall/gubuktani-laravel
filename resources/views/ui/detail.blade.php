@extends('ui.app')

@section('title', 'Detail')

@section('content')
<div class="container mt-5 mb-5">

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ asset('ads/' . $ad->picture_one) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Pertama</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ asset('ads/' . $ad->picture_two) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Kedua</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('ads/' . $ad->picture_three) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Ketiga</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('ads/' . $ad->picture_four) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Keempat</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev carousel-control" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next carousel-control" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="mt-5">

        <button class="btn {{ ($ad->condition == 0) ? 'btn-primary' : 'btn-danger' }} }} mb-3">{{ ($ad->condition == 0) ? "Tersedia" : "Tersewa" }}</button>
        <button class="btn btn-dark }} mb-3">{{ $ad->categories->cateogory }}</button>

        <h1><b>{{ $ad->title }}</b></h1>
        <p>{{ $ad->desc }}</p>

        <h5>Alamat</h5>
        <p>{{ $ad->address }}</p>

        <h5>Luas & Sertifikasi</h5>
        <p>{{ $ad->large }} & {{ $ad->certification }}</p>

        <div class="row">

            <div class="col-md-6">
                <h5>Fasilitas</h5>
                <ul class="list-group mt-3 mb-3">
                    <li class="list-group-item"><b>Irigasi</b> {{ $ad->irigation }}</li>
                    <li class="list-group-item"><b>Jenis Tanah</b> {{ $ad->land }}</li>
                    <li class="list-group-item"><b>Akses Jalan</b> {{ $ad->road }}</li>
                    <li class="list-group-item"><b>Pemandangan</b> {{ $ad->view }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Tambahan</h5>
                <ul class="list-group mt-3 mb-3">
                    <li class="list-group-item"><b>Jarak Sumber Air</b> {{ $ad->irigation }}</li>
                    <li class="list-group-item"><b>Suhu</b> {{ $ad->land }}</li>
                    <li class="list-group-item"><b>Ketinggian</b> {{ $ad->height }}</li>
                </ul>
            </div>
            <div class="col-md-4"></div>
        </div>

        <h5>Larangan</h5>
        <p>{{ $ad->notice }}</p>

        <h5>Harga Sewa</h5>
        <p>Rp. 1.000.000/Tahun</p>

        <div class="paragraphs mt-5">
            <div class="row">
                <div class="span4">
                    <div class="clearfix content-heading">
                        <img style="float:left" src="{{ asset('profiles/' . $user->profile_picture) }}" alt="{{ $user->fname }}" class="img-thumbnail fit-image rounded-circle me-2">
                        <h3><b>{{ $user->fname . " " . $user->lname}}</b></h3>
                        <p style="font-size: 20px;"><b>{{ $user->address }}</b> • {{ $user->phone }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <p class="alert alert-success mt-3">{{ session('success') }}</p>
        @endif
        @if(session('error'))
        <p class="alert alert-danger mt-3">{{ session('error') }}</p>
        @endif
        @if(Auth::guard('web')->check())
        @if(Auth::guard('web')->user()->id != $ad->id_user)
        <div class="mt-5">
            <div class="row">
                <div class="col-md-2">
                    <form action="{{ route('ads.update.wishlist', $ad->id) }}" method="post">
                        @csrf
                        <button class="btn {{ ($wishlist == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($wishlist == null) ? 'Tambahkan Wishlist' : 'Hapus dari Wishlist' }}</button>
                    </form>

                </div>
                <div class="col-md-2">
                    <form action="{{ route('ads.update.booking', $ad->id) }}" method="post">
                        @csrf
                        <button class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('rent', $ad->id) }}" class="btn btn-primary">Sewa Lahan</a>
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="mt-5">
            <div class="row">
                <div class="col-md-2">
                    <form action="{{ route('ads.update.wishlist', $ad->id) }}" method="post">
                        @csrf
                        <button class="btn {{ ($wishlist == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($wishlist == null) ? 'Tambahkan Wishlist' : 'Hapus dari Wishlist' }}</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('ads.update.booking', $ad->id) }}" method="post">
                        @csrf
                        <button class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('rent', $ad->id) }}" class="btn btn-primary">Sewa Lahan</a>
                </div>
            </div>
        </div>
        @endif
        @if(Auth::guard('web')->check())
        @if(Auth::guard('web')->user()->id == $ad->id_user)
        <div class="mt-5">
            <div>
                @php
                $books = App\Models\Booking::where('id_lahan', $ad->id)->get();
                @endphp
                <h3>Daftar Pembooking</h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach($books as $book)
                        <tr>
                            <td style="width:5%;">{{ $no++ }}</td>
                            <td>{{ $book->user->fname . ' ' . $book->user->lname }}</td>
                            <td>{{ $book->user->address }}</td>
                            <td>{{ $book->user->email }}</td>
                            <td>{{ $book->user->phone }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                @php
                $books = App\Models\Rents::where('id_lahan', $ad->id)->get();
                @endphp
                <h3>Daftar Penyewa</h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach($books as $book)
                        <tr>
                            <td style="width:5%;">{{ $no++ }}</td>
                            <td>{{ $book->user->fname . ' ' . $book->user->lname }}</td>
                            <td>{{ $book->user->address }}</td>
                            <td>{{ $book->user->email }}</td>
                            <td>{{ $book->user->phone }}</td>
                            <td>{{ $book->status == 0 ? "Belum Disetujui" : "Disetujui" }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('rent.show.fromAds', $book->id) }}"><i class="fas fa-pencil"></i></a>
                                <!-- Riwayat Cicilan -->
                                <a class="btn btn-sm btn-warning" href="{{ route('rent.show.fromAds', $book->id) }}"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection