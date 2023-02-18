@extends('ui.app')

@section('title', 'Sewa Lahan Pertanian Kini Mudah dan Cepat')

@section('content')
<div class="album py-5">
    <div class="container">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ URL::asset('assets/img/sawah-satu.jpeg') }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-white">
                        <h5>Aman Dan Terpercaya</h5>
                        <p>Gubuktani.co.id menghargai dan menjamin privasi data pribadi anda dalam memilih lahan serta memberikan rekomendasi yang terpercaya untuk anda.</p>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ URL::asset('assets/img/sawah-dua.jpeg') }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-white">
                        <h5>Mudah Dan Cepat</h5>
                        <p>Memberikan kemudahan pada anda dalam memilih lahan sewa dengan kriteria yang anda inginkan dan juga cepat dalam mengolah data yang ingin anda tampilkan.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ URL::asset('assets/img/sawah-tiga.jpeg') }}" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-white">
                        <h5>Bersahabat</h5>
                        <p>Posting di Gubuktani.co.id 100% Gratis dan memberikan layanan prima bagi anda dalam mengiklankan lahan anda agar dikenal secara luas oleh masyarakat.</p>
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


        <div class="row row-cols-1 mt-5 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($ads as $ad) <div class="col">
            <div class="card shadow-sm">
                <img src="{{ asset('ads/' . $ad->picture_one) }}" class="card-img-top" alt="{{ $ad->title }}">
                <div class="card-body">
                    <h4><b>{{ $ad->title }}</b></h4>
                    <ul class="mt-3">
                        <li><b>{{ $ad->categories->cateogory }}</b></li>
                        <li>Luas {{ $ad->large }}</li>
                        <li>Rp. {{ number_format($ad->price) }} / {{ $ad->period }}</li>
                    </ul>
                    @if($ad->status == 0)
                        <a href="#" class="btn btn-sm btn-danger">Belum Diverifikasi</a>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="btn-group">
                            <a href="{{ url('/ads/detail/' . $ad->id) }}" class="btn btn-sm btn-outline-secondary">Lihat Selengkapnya</a>
                            <a href="#" class="btn btn-sm {{ ($ad->condition == 0) ? 'btn-primary' : 'btn-danger' }} }}">{{ ($ad->condition == 0) ? "Tersedia" : "Tersewa" }}</a>
                        </div>
                        <small class="text-muted">{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
    </div>
</div>
<div class="pb-3 text-white" style="margin-top: 100px;background: url('{{ URL::asset('assets/img/sawah-empat.jpeg') }}') no-repeat; background-size:cover;">
        <div class="container py-5 text-center">
            <h1 class="display-5 fw-bold mb-3">Kategori</h1>
            @foreach($cats as $cat)
            <a href="{{ route('ads.search', 'search=' . $cat->cateogory) }}" class="btn btn-outline-light">{{$cat->cateogory}}</a>
            @endforeach
        </div>
    </div>
</div>
<div class="text-center container">
    <!-- Three columns of text below the carousel -->
    <div class="row">
      <div class="col-lg-4">
      <img src="{{ URL::asset('assets/img/sawah-satu.jpeg') }}" class="rounded-circle" width="140" height="140" alt="...">
        <h2 class="fw-normal mt-3">Aman Dan Terpercaya</h2>
        <p>SGubuktani.co.id menghargai dan menjamin privasi data pribadi anda dalam memilih lahan serta memberikan rekomendasi yang terpercaya untuk anda..</p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
      <img src="{{ URL::asset('assets/img/sawah-dua.jpeg') }}" class="rounded-circle" width="140" height="140" alt="...">

        <h2 class="fw-normal mt-3">Mudah Dan Cepat</h2>
        <p>Memberikan kemudahan pada anda dalam memilih lahan sewa dengan kriteria yang anda inginkan dan juga cepat dalam mengolah data yang ingin anda tampilkan..</p>
      </div><!-- /.col-lg-4 -->
      <div class="col-lg-4">
      <img src="{{ URL::asset('assets/img/sawah-tiga.jpeg') }}" class="rounded-circle" width="140" height="140" alt="...">

        <h2 class="fw-normal mt-3">Bersahabat</h2>
        <p>Posting di Gubuktani.co.id 100% Gratis dan memberikan layanan prima bagi anda dalam mengiklankan lahan anda agar dikenal secara luas oleh masyarakat..</p>
      </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

</div>
@endsection