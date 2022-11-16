@extends('ui.app')

@section('title', 'Detail Sewa Lahan')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Detil Sewa Lahan</h1>
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
    <form class="mt-3" action="{{ route('rent.update', $rent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_lahan" value="{{ $ad->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga Kesepakatan</label>
            <input type="text" name="done_price" class="form-control" value="Rp {{ number_format($rent->done_price, 0) }}" disabled>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Lama Sewa</label>
                    <input type="number" name="period" class="form-control" value="{{ $rent->period }}" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kurun Sewa</label>
                    <select class="form-select" name="period_type" aria-label="Default select example" disabled>
                        <option>{{ $rent->period_type }}</option>
                        <option value="Tahun">Tahun</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
            <select class="form-select" name="method" aria-label="Default select example" disabled>
                <option>{{ $rent->method == 0 ? "Cicil" : "Lunas"}}</option>
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
            <label for="exampleInputEmail1" class="form-label">Status</label>
            <input type="text" value="{{ $rent->status == 0 ? 'Belum Disetujui' : 'Disetujui' }}" class="form-control" disabled>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Foto Perjanjian</label>
            <div>
            <img src="{{ asset('agreement/' . $rent->agreement_photo) }}"  class="img-thumbnail fit-image-profile me-2"">
            </div>
        </div>
        @if(Auth::guard('web')->user()->id == $ad->id_user)
        @if($rent->status == 0)
        <button type="submit" class="btn btn-primary mt-5">Setujui Penyewaan</button>
        @endif
        @endif
    </form>
    @if($rent->method == 0)
    <hr>
    <h1>Cicilan</h1>
    <div class="card mt-5 mb-5">
        <h5 class="card-header">Rincian Cicilan</h5>
        <div class="card-body">
            <h5 class="card-title">Rp {{ number_format($rent->done_price, 0) }} / {{ 12 * $rent->period }} Bulan = Rp. {{ number_format($rent->done_price / (12 * $rent->period), 0) }}</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis unde iure debitis officiis similique in deserunt. Ex nobis doloremque est cupiditate itaque ab, neque voluptatum natus odio. Consequatur, ut perferendis!</p>
            @php
                $total = $instalments->where('status', '=', 1)->sum('amount');
                $current = ($rent->done_price - $total);
            @endphp
            <h4>Total Rincian Saat Ini Rp {{ number_format($total) }}</h4>
            <h5>Sisa Cicilan Rp {{ number_format($current) }}</h5>
            @if($rent->status_instalment == 0)
            <button class="btn btn-sm btn-danger mt-3">Belum Lunas</button>
            @else
            <button class="btn btn-sm btn-success mt-3">Lunas</button>
            @endif
        </div>
    </div>
    <div class="mt-5">
        @if(session('success'))
        <p class="alert alert-success mt-3">{{ session('success') }}</p>
        @endif
        @if(session('error'))
        <p class="alert alert-danger mt-3">{{ session('error') }}</p>
        @endif
        @if($instalments != null)
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Bukti Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width: 20%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($instalments as $instalment)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $instalment->month }}</td>
                    <td>Rp {{ number_format($instalment->amount, 0) }}</td>
                    <td>
                        @if($instalment->proof_of_payment == null)
                        Belum ada bukti bayar
                        @else
                        <div class="bd-example bd-example-images">
                            <img src="{{ asset('ProofOfPayments/' . $instalment->proof_of_payment) }}" alt="{{ $instalment->proof_of_payment }}" class="img-thumbnail fit-image-profile me-2"">
                        </div>
                        @endif
                    </td>
                    <td>{{ $instalment->status == 0 ? "Belum Disetujui" : "Disetujui" }}</td>
                    <td>
                        @if(Auth::guard('web')->user()->id != $ad->id_user)
                        @if($instalment->proof_of_payment == null)
                        <a href="{{ route('rent.upload', $instalment->id) }}" class="btn btn-sm btn-primary">Unggah Bukti Bayar</a>
                        @endif
                        @else
                        @if($instalment->proof_of_payment != null && $instalment->status == 0)
                        <form action="{{ route('rent.approvement', $instalment->id) }}" method="post">
                            @csrf
                            <button class="btn btn-sm btn-success" type="submit">Setujui</button>
                        </form>
                        @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif
</div>
@endsection