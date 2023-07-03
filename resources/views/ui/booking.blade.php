@extends('ui.app')

@section('title', 'Booking')

@section('content')
<div class="container mb-5 w-50 mx-auto">
    <h1 style="margin-top:100px;">Booking</h1>
    <div class="card mt-5 mb-5">
        <h5 class="card-header">Data Lahan</h5>
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
    <form class="mt-3" action="{{ route('ads.update.booking', $ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_lahan" value="{{ $ad->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tanggal Survey</label>
            <input type="date" name="survey_date" class="form-control">
            <small>Kosongi bila tidak melakukan survey</small>
        </div>
        <button type="submit" class="btn btn-success mt-3">Booking</button>
    </form>
</div>
<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("survey_date")[0].setAttribute('min', today);
</script>
@endsection