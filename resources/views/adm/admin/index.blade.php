@extends('adm.app')

@section('title', 'Admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <a class="btn btn-sm btn-success" href="{{ route('admin.create') }}"><i class="fas fa-plus"></i></a>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
            <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
            .
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Admin</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($admins as $admin)
                    <tr>
                        <td style="width:5%;">{{ $no++ }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td style="width:10%;">
                            <form action="{{ route('admin.delete', $admin->id) }}" method="post">
                                @csrf
                                @if($admin->id != 1)
                                    @if(Auth::guard('admin')->user()->id == 1)
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.edit', $admin->id) }}"><i class="fas fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    @endif
                                    @if($admin->id != 1 && Auth::guard('admin')->user()->id == $admin->id)
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.edit', $admin->id) }}"><i class="fas fa-pencil"></i></a>
                                    @endif
                                @endif
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