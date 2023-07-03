@extends('ui.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Lupa Password</h1>
    Anda bisa mereset kata sandi dengan klik link dibawah:
    <br>
    <a href="{{ route('reset.password.get', $token) }}" class="btn btn-primary">Reset Password</a>
</div>
@endsection