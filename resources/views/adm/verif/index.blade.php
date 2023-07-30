@extends('adm.app')

@section('title', 'Verifikasi Pengguna')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Verifikasi Pengguna</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Verifikasi Pengguna</li>
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
            Lampiran Data
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Status Email</th>
                        <th>Status KTP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Profesi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach($customers as $customer)
                    <tr>
                        <td style="width:5%;">{{ $no++ }}</td>
                        <td>{{ $customer->fname . " " . $customer->lname }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td><button class="btn btn-sm {{ ($customer->email_verified_at == NULL) ? 'btn-danger' : 'btn-success' }}">{{ ($customer->email_verified_at == NULL) ? "Belum terverifikasi" : "Terverifikasi" }}</button></td>
                        <td><button class="btn btn-sm {{ ($customer->ktp_verified_at == NULL) ? 'btn-danger' : 'btn-success' }}">{{ ($customer->ktp_verified_at == NULL) ? "Belum terverifikasi" : "Terverifikasi" }}</button></td>
                        <td style="width:10%;">
                            <form action="{{ route('customer.new.delete', $customer->id) }}" method="post">
                                @csrf
                                <a class="btn btn-sm btn-warning" href="{{ route('customer.new.show', $customer->id) }}"><i class="fas fa-eye"></i></a>
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