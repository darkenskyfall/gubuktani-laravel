@extends('adm.app')

@section('title', 'Kategori')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Kategori</li>
    </ol>
    <a class="btn btn-sm btn-success" href="{{ route('category.create') }}"><i class="fas fa-plus"></i></a>
    <div class="card mb-4 mt-4">
        <div class="card-body">
          
        </div>
    </div>
    @if(session('success'))
    <p class="alert alert-success mt-4">{{ session('success') }}</p>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($categories as $category)
                    <tr>
                        <td style="width:5%;">{{ $no++ }}</td>
                        <td>{{ $category->cateogory }}</td>
                        <td style="width:10%;">
                            <form action="{{ route('category.delete', $category->id) }}" method="post">
                                @csrf
                                <a class="btn btn-sm btn-primary" href="{{ route('category.edit', $category->id) }}"><i class="fas fa-pencil"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apa anda yakin ingin menghapusnya ?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection