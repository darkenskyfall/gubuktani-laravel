@extends('adm.app')

@section('title', 'Kategori')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Kategori</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('category') }}">Kategori</a></li>
        <li class="breadcrumb-item active">Edit Kategori</li>
    </ol>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Kategori
        </div>
        <div class="card-body">
            @if(session('success'))
            <p class="alert alert-success mt-3">{{ session('success') }}</p>
            @endif
            <form class="mt-3" action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kategori</label>
                    <input type="text" name="cateogory" class="form-control @error('cateogory') is-invalid @enderror " value="{{ old('cateogory', $category->cateogory) }}" >
                    @error('cateogory')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection