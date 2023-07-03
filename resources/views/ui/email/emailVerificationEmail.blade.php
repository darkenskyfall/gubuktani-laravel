@extends('ui.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Verifikasi Email</h1>
    Please verify your email with bellow link: 
    <br>
    <a href="{{ route('user.verify', $token) }}" class="btn btn-primary">Verify Email</a>
</div>
@endsection