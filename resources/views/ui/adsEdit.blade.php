@extends('ui.app')

@section('title', 'Edit Iklan')

@section('content')
<div class="container mb-5">
    <h1 style="margin-top:100px;">Edit Iklan</h1>
    <!-- @if($errors->any())
    @foreach($errors->all() as $err)
    <p class="alert alert-danger mt-3">{{ $err }}</p>
    @endforeach
    @endif -->
    <form class="mt-3" action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-5">Data Awal Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori</label>
            <select class="form-select" name="id_category" aria-label="Default select example" required>
                <option value="{{ $ad->categories->id }}">{{ $ad->categories->cateogory }}</option>
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cateogory }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title', $ad->title)}}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
            <textarea name="address" name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10">{{ old('address', $ad->address) }}</textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <h4 class="mt-5">Spesifikasi Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Luas</label>
            <input type="text" name="large" class="form-control @error('large') is-invalid @enderror" value="{{old('large', $ad->large)}}">
            @error('large')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Sertifikasi Tanah</label>
            <select class="form-select" name="certification" aria-label="Default select example" required>
                <option value="{{ $ad->certification }}">{{ $ad->certification }}</option>
                <option value="SHM - Sertifikat Hak Milik">SHM - Sertifikat Hak Milik</option>
                <option value="HGB - Hak Guna Bangunan">HGB - Hak Guna Bangunan</option>
                <option value="Petok D">Petok D</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
            <textarea name="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10">{{ old('desc', $ad->desc) }}</textarea>
            @error('desc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Larangan</label>
            <textarea name="notice" class="form-control @error('notice') is-invalid @enderror" cols="30" rows="10">{{ old('notice', $ad->notice) }}</textarea>
            @error('notice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga</label>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $ad->price) }}">
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
                <option value="{{ $facility->land }}">{{ $facility->land }}</option>
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
                <input class="form-check-input" type="radio" name="is_irigation" id="exampleRadios1" value="0" onclick="myFunction()" {{ ($ad->is_irigation==0)? "checked" : "" }}>
                <label class="form-check-label" for="exampleRadios1">
                    Tidak ada irigasi
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="is_irigation" id="exampleRadios2" value="1" onclick="myFunction()" {{ ($ad->is_irigation==1)? "checked" : "" }}>
                <label class="form-check-label" for="exampleRadios2">
                    Ada irigasi
                </label>
            </div>
            <input type="text" name="irigation" class="form-control mt-3" id="idOfTextField" placeholder="Penjelas Irigasi" value="{{old('irigation', $ad->irigation)}}">
        </div>


        <h4 class="mt-5">Fasilitas Tambahan</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Akses Jalan (Opsional)</label>
            <input type="text" name="road" class="form-control" value="{{ old('road', $facility->road) }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pemandangan (Opsional)</label>
            <input type="text" name="view" class="form-control" value="{{ old('view', $facility->view) }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jarak Sumber Air (Opsional)</label>
            <input type="text" name="range" class="form-control" value="{{ old('range', $facility->range) }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Suhu (Opsional)</label>
            <input type="text" name="temperature" class="form-control" value="{{ old('temperature', $facility->temperature) }}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ketinggian (Opsional)</label>
            <input type="text" name="height" class="form-control" value="{{ old('height', $facility->height) }}">
        </div>

        <h4 class="mt-5">Gambar Pendukung</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 1</label>
            <input type="file" name="picture_one" class="form-control">
            <small>Lewati jika tidak mengganti gambar lahan 1</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 2</label>
            <input type="file" name="picture_two" class="form-control">
            <small>Lewati jika tidak mengganti gambar lahan 2</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 3</label>
            <input type="file" name="picture_three" class="form-control">
            <small>Lewati jika tidak mengganti gambar lahan 3</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 4</label>
            <input type="file" name="picture_four" class="form-control">
            <small>Lewati jika tidak mengganti gambar lahan 4</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Perbarui Iklan</button>
        <!-- @csrf
        <h4 class="mt-5">Data Awal Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori</label>
            <select class="form-select" name="id_category" aria-label="Default select example" required>
                <option value="{{ $ad->categories->id }}">{{ $ad->categories->cateogory }}</option>
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cateogory }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul</label>
            <input type="text" value="{{ $ad->title }}" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
            <textarea name="address" name="address" class="form-control" required cols="30" rows="10">{{ $ad->address }}</textarea>
        </div>
        <h4 class="mt-5">Spesifikasi Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Luas</label>
            <input type="text" value="{{ $ad->large }}" name="large" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Sertifikasi Tanah</label>
            <select class="form-select" name="certification" aria-label="Default select example" required>
                <option value="{{ $ad->certification }}">{{ $ad->certification }}</option>
                <option value="SHM - Sertifikat Hak Milik">SHM - Sertifikat Hak Milik</option>
                <option value="HGB - Hak Guna Bangunan">HGB - Hak Guna Bangunan</option>
                <option value="Petok D">Petok D</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Deskripsi</label>
            <textarea name="desc" class="form-control" required cols="30" rows="10">{{ $ad->desc }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga</label>
            <input type="number" value="{{ $ad->price }}" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kurun Sewa</label>
            <select class="form-select" name="period" aria-label="Default select example" required>
                <option value="{{ $ad->period }}">{{ $ad->period }}</option>
                <option value="Tahun">Tahun</option>
            </select>
        </div>
        <h4 class="mt-5">Fasilitas</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Irigasi</label>
            <input type="text" value="{{ $ad->irigation }}" name="irigation" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Tanah</label>
            <input type="text" value="{{ $ad->land }}" name="land" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Akses Jalan</label>
            <input type="text" value="{{ $ad->road }}" name="road" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pemandangan</label>
            <input type="text" value="{{ $ad->view }}" name="view" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jarak Sumber Air</label>
            <input type="text" value="{{ $ad->range }}" name="range" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Suhu</label>
            <input type="text" value="{{ $ad->temperature }}" name="temperature" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ketinggian</label>
            <input type="text" value="{{ $ad->height }}" name="height" class="form-control" >
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Larangan</label>
            <textarea name="notice" class="form-control"  cols="30" rows="10">{{ $ad->notice }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 1</label>
            <input type="file" name="picture_one" class="form-control" >
            <small>Lewati jika tidak mengganti gambar lahan 1</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 2</label>
            <input type="file" name="picture_two" class="form-control" >
            <small>Lewati jika tidak mengganti gambar lahan 2</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 3</label>
            <input type="file" name="picture_three" class="form-control" >
            <small>Lewati jika tidak mengganti gambar lahan 3</small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 4</label>
            <input type="file" name="picture_four" class="form-control" >
            <small>Lewati jika tidak mengganti gambar lahan 4</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Perbarui Iklan</button> -->
    </form>
</div>
<script>
    window.onload = function() {
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