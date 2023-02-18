@extends('ui.app')

@section('title', 'Pasang Iklan')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Pasang Iklan</h1>
    <!-- @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif -->
    <form class="mt-3" action="{{ route('ads.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-5">Data Awal Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori</label>
            <select class="form-select" name="id_category" aria-label="Default select example">
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cateogory }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
            <textarea name="address" name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10">{{ old('address') }}</textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <h4 class="mt-5">Spesifikasi Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Luas</label>
            <input type="text" name="large" class="form-control @error('large') is-invalid @enderror" value="{{old('large')}}">
            @error('large')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Sertifikasi Tanah</label>
            <select class="form-select" name="certification" aria-label="Default select example">
                <option value="SHM - Sertifikat Hak Milik">SHM - Sertifikat Hak Milik</option>
                <option value="HGB - Hak Guna Bangunan">HGB - Hak Guna Bangunan</option>
                <option value="Petok D">Petok D</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
            <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10">{{ old('desc') }}</textarea>
            @error('desc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Larangan</label>
            <textarea name="notice" class="form-control @error('notice') is-invalid @enderror" cols="30" rows="10">{{ old('notice') }}</textarea>
            @error('notice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kurun Sewa</label>
            <input type="text" name="period" class="form-control" value="Tahun" readonly>
        </div>


        <h4 class="mt-5">Fasilitas</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Tanah</label>
            <select class="form-select" name="land" aria-label="Default select example">
                <option value="Regosol">Regosol</option>
                <option value="Latosol">Latosol</option>
                <option value="Organosol">Organosol</option>
                <option value="Podsolik Merah Kuning (PMK)">Podsolik Merah Kuning (PMK)</option>
                <option value="Laterit">Laterit</option>
                <option value="Litosol">Litosol</option>
                <option value="Rendzina">Rendzina</option>
                <option value="Mediteran">Mediteran</option>
                <option value="Grumusol">Grumusol</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Irigasi</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_irigation" id="exampleRadios1" value="0" checked onclick="myFunction()">
                <label class="form-check-label" for="exampleRadios1">
                    Tidak ada irigasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_irigation" id="exampleRadios2" value="1" onclick="myFunction()">
                <label class="form-check-label" for="exampleRadios2">
                    Ada irigasi
                </label>
            </div>
            <input type="text" name="irigation" class="form-control mt-3" id="idOfTextField" placeholder="Penjelas Irigasi">
        </div>


        <h4 class="mt-5">Fasilitas Tambahan</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Akses Jalan (Opsional)</label>
            <input type="text" name="road" class="form-control" value="{{ old('road') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pemandangan (Opsional)</label>
            <input type="text" name="view" class="form-control" value="{{ old('view') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jarak Sumber Air (Opsional)</label>
            <input type="text" name="range" class="form-control" value="{{ old('range') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Suhu (Opsional)</label>
            <input type="text" name="temperature" class="form-control" value="{{ old('temperature') }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ketinggian (Opsional)</label>
            <input type="text" name="height" class="form-control" value="{{ old('height') }}">
        </div>

        <h4 class="mt-5">Gambar Pendukung</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 1</label>
            <input type="file" name="picture_one" class="form-control @error('picture_one') is-invalid @enderror">
            @error('picture_one')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 2</label>
            <input type="file" name="picture_two" class="form-control @error('picture_two') is-invalid @enderror">
            @error('picture_two')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 3</label>
            <input type="file" name="picture_three" class="form-control @error('picture_three') is-invalid @enderror">
            @error('picture_three')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 4</label>
            <input type="file" name="picture_four" class="form-control @error('picture_four') is-invalid @enderror">
            @error('picture_four')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Buat Iklan</button>
    </form>
</div>
<script>
    window.onload = function () {
        myFunction();
    }
    function myFunction() {
        if (document.getElementById('exampleRadios1').checked) {
            document.getElementById("idOfTextField").style.visibility = "hidden";
        }

        if (document.getElementById('exampleRadios2').checked) {
            document.getElementById("idOfTextField").style.visibility = "visible";
        }
    }
</script>
@endsection