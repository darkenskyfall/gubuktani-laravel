@extends('ui.app')

@section('title', 'Register')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Upload Bukti Bayar</h1>
    @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger mt-3">{{ $err }}</p>
        @endforeach
    @endif
    <div class="card mt-5 mb-5">
        <h5 class="card-header">Rincian Cicilan</h5>
        <div class="card-body">
            <h5 class="card-title">{{ $instalment->month }}</h5>
          
            <h4>Jumlah Bayar Rp {{ number_format($instalment->amount, 0) }}</h4>
        </div>
    </div>
    <form class="mt-5" action="{{ route('rent.upload.update', $instalment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Unggah Bukti Bayar</label>
            <input type="file" name="proof_of_payment" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Unggah</button>
    </form>
</div>
@endsection