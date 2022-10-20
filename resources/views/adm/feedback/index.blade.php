@extends('adm.app')

@section('title', 'Umpan Balik')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Umpan Balik</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Umpan Balik</li>
    </ol>
    <a class="btn btn-sm btn-success" href="{{ route('category.create') }}"><i class="fas fa-plus"></i></a>
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
                        <th>Umpan Balik</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Umpan Balik</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($feedbacks as $feedback)
                    <tr>
                        <td style="width:5%;">{{ $no++ }}</td>
                        <td>{{ $feedback->name }}</td>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->desc }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection