@extends('ui.app')

@section('title', 'Sewa Lahan')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Sewa Lahan</h1>
    <div class="card mt-5 mb-5">
        <h5 class="card-header">Lahan Disewa</h5>
        <div class="card-body">
            <h5 class="card-title">{{ $ad->title }} - Rp{{ $ad->price }}/{{ $ad->period }} - {{ $ad->user->fname . ' ' .  $ad->user->lname}}</h5>
            <p class="card-text">{{ $ad->desc }}.</p>
            <a href="{{ route('ads.show', $ad->id) }}" class="btn btn-primary mt-3">Kembali ke Iklan</a>
        </div>
    </div>
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif
    <form class="mt-3" action="{{ route('rent.store', $ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_lahan" value="{{ $ad->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga Kesepakatan</label>
            <input type="number" name="done_price" class="form-control" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Lama Sewa</label>
                    <input type="number" name="period" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kurun Sewa</label>
                    <select class="form-select" name="period_type" aria-label="Default select example" required>
                        <option>Pilih Kurun Sewa</option>
                        <option value="Tahun">Tahun</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
            <select class="form-select" name="method" aria-label="Default select example" required>
                <option>Metode Pembayaran</option>
                <option value="1">Lunas</option>
                <option value="0">Cicil</option>
            </select>
        </div>
        <!-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Inputan Cicilan</label>
            <input type="number" name="phone" class="form-control" required>
            <small>*Kosongi bila anda membayar lunas</small>
        </div> -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto Perjanjian</label>
            <input type="file" name="agreement_photo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Kirim</button>
    </form>
</div>
@endsection