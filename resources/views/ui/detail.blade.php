@extends('ui.app')

@section('title', 'Detail')

@section('content')
<div class="container mt-5 mb-5">

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="{{ URL::asset('ads/' . $ad->picture_one) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Pertama</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{ URL::asset('ads/' . $ad->picture_two) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Kedua</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ URL::asset('ads/' . $ad->picture_three) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-white">
                    <h5>Gambar Ketiga</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ URL::asset('ads/' . $ad->picture_four) }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
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

        <div class="mb-5">
            <button class="btn {{ ($ad->condition == 0) ? 'btn-primary' : 'btn-danger' }} }}">{{ ($ad->condition == 0) ? "Tersedia" : "Tersewa" }}</button>
            <button class="btn btn-dark }}">{{ $ad->categories->cateogory }}</button>
            @if($ad->status == 0)
            <button class="btn btn-danger">Belum Diverifikasi</button>
            @endif
        </div>

        @if($ad->status == 0)
        <div class="mb-5">
            <h3 class="text-danger"><b>Iklan ini belum diverifikasi oleh admin, pengguna tidak bisa melakukan transaksi dengan iklan ini untuk sementara waktu</b></h3>
        </div>
        @endif

        <h1><b>{{ $ad->title }}</b></h1>
        <p>{{ $ad->desc }}</p>

        <h5>Alamat</h5>
        <p>{{ $ad->address }}</p>

        <h5>Luas  & Sertifikasi</h5>
        <p>{{ $ad->large }} <b>Ha</b> & {{ $ad->certification }}</p>

        <div class="row">

            <div class="col-md-6">
                <h5>Fasilitas</h5>
                <ul class="list-group mt-3 mb-3">
                    <li class="list-group-item"><b>Irigasi</b> {{ ($ad->is_irigation == 1) ? ($ad->irigation ?? "Penjelas belum ada") : "Tidak ada irigasi" }}</li>
                    <li class="list-group-item"><b>Jenis Tanah</b> {{ $facility->land ?? "Tidak ada data" }}</li>
                    <li class="list-group-item"><b>Akses Jalan</b> {{ $facility->road ?? "Tidak ada data" }}</li>
                    <li class="list-group-item"><b>Pemandangan</b> {{ $facility->view ?? "Tidak ada data" }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Tambahan</h5>
                <ul class="list-group mt-3 mb-3">
                    <li class="list-group-item"><b>Jarak Sumber Air </b> {{ $facility->range ?? "Tidak ada data" }}<b> Meter</b></li>
                    <li class="list-group-item"><b>Suhu </b> {{ $facility->temperature ?? "Tidak ada data" }} <b> Celcius</b></li>
                    <li class="list-group-item"><b>Ketinggian </b> {{ $facility->height ?? "Tidak ada data" }} <b>Mdpl</b></li>
                </ul>
            </div>
            <div class="col-md-4"></div>
        </div>

        <h5>Larangan</h5>
        <p>{{ $ad->notice }}</p>

        <h5>Harga Sewa</h5>
        <p>Rp. {{ number_format($ad->price) }}/{{ $ad->period }}</p>

        <div class="paragraphs mt-5">
            <div class="row">
                <div class="span4">
                    <div class="clearfix content-heading">
                        <img style="float:left" src="{{ URL::asset('profiles/' . $user->profile_picture) }}" alt="{{ $user->fname }}" class="img-thumbnail fit-image rounded-circle me-2">
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
                        <button class="btn {{ ($wishlist == null) ? 'btn-light' : 'btn-danger' }} mb-3" onclick="{{ ($wishlist == null) ? '' : 'return confirm("Apakah anda yakin untuk menghapus wishlist?")' }}">{{ ($wishlist == null) ? 'Tambahkan Wishlist' : 'Hapus dari Wishlist' }}</button>
                    </form>

                </div>
                @if($ad->condition == 0)
                <div class="col-md-2">
                    <form action="{{ route('ads.update.booking', $ad->id) }}" method="post">
                        @csrf
                        @if($booking == null)
                        <a href="{{ route('ads.show.booking', $ad->id) }}" class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</a>
                        @else
                        <button class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3" onclick="{{ ($booking == null) ? '' : 'return confirm("Apakah anda yakin untuk menghapus booking?")' }}">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</button>
                        @endif
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('rent', $ad->id) }}" class="btn btn-primary">Sewa Lahan</a>
                </div>
                @endif
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
                @if($ad->condition == 0)
                <div class="col-md-2">
                    <form action="{{ route('ads.update.booking', $ad->id) }}" method="post">
                        @csrf
                        @if($booking == null)
                        <a href="{{ route('ads.show.booking', $ad->id) }}" class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</a>
                        @else
                        <button class="btn {{ ($booking == null) ? 'btn-light' : 'btn-danger' }} mb-3">{{ ($booking == null) ? 'Tambahkan Booking' : 'Hapus dari Booking' }}</button>
                        @endif
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('rent', $ad->id) }}" class="btn btn-primary">Sewa Lahan</a>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection