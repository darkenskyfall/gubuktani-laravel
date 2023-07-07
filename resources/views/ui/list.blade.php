@extends('ui.app')

@section('title', 'Cari Lahan')

@section('content')
<div class="container">
    <h1 class="mt-5">Cari Lahan</h1>

    @if($category != null)
    <h4>Kategori {{ $category->cateogory }}</h4>
    @elseif($search != "")
    <h4>Hasil Pencarian dari "{{ $search }}"</h4>
    @endif
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    <div class="row row-cols-1 mt-3 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($ads as $ad) <div class="col">
            <div class="card shadow-sm">
                <img src="{{ URL::asset('ads/' . $ad->picture_one) }}" class="card-img-top" alt="{{ $ad->title }}">
                <div class="card-body">
                    <h4><b>{{ $ad->title }}</b></h4>
                    <ul class="mt-3">
                    <li><b>{{ $ad->categories->cateogory }}</b></li>
                        <li>Luas {{ $ad->large }} <b>Ha</b></li>
                        <li>Rp. {{ number_format($ad->price) }} / {{ $ad->period }}</li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="btn-group">
                            <a href="{{ url('/ads/detail/' . $ad->id) }}" class="btn btn-sm btn-outline-secondary">Lihat Selengkapnya</a>
                            <a href="#" class="btn btn-sm {{ ($ad->condition == 0) ? 'btn-primary' : 'btn-danger' }} }}">{{ ($ad->condition == 0) ? "Tersedia" : "Tersewa" }}</a>
                        </div>
                        <small class="text-muted text-right">Di unggah<br>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
</div>
@endsection