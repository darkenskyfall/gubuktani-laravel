@extends('ui.app')

@section('title', 'Lupa Password')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Lupa Password</h1>
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif
    <form action="{{ route('reset.password.post') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mt-5">
            <input type="text" id="email_address" class="form-control" name="email" placeholder="Email" required autofocus>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group mt-3">
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required autofocus>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group mt-3">
            <input type="password" id="password-confirm" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required autofocus>
            @if ($errors->has('password_confirmation'))
            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Reset Password
        </button>
    </form>
</div>
@endsection