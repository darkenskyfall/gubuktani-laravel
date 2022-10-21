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
    <form action="{{ route('forget.password.post') }}" method="POST">
        @csrf
        <div class="form-group mt-5">
            <input type="text" id="email_address" class="form-control" name="email" placeholder="Alamat Email" required autofocus>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary d-block mt-3">
            Kirim Link Reset Kata Sandi
        </button>
    </form>
</div>
@endsection