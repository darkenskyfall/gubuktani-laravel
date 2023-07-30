@extends('ui.app')

@section('title', 'Pasang Iklan')

@section('content')
<script>
    // Function to format the input value with thousand separators
    function formatNumberWithCommas() {
        var input = document.getElementById('myInput');
        var value = input.value;
        var sanitizedValue = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        var formattedValue = sanitizedValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        input.value = formattedValue;
    }
</script>
<div class="container mb-5 w-50 mx-auto">
    <h1 style="margin-top:100px;">Pasang Iklan</h1>
    <form class="mt-3" action="{{ route('ads.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h4 class="mt-5">Data Awal Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kategori*</label>
            <select class="form-select" name="id_category" aria-label="Default select example">
                @foreach($cats as $cat)
                <option value="{{ $cat->id }}">{{ $cat->cateogory }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Judul*</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Alamat Lengkap*</label>
            <textarea name="address" name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10">{{ old('address') }}</textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <h4 class="mt-5">Spesifikasi Lahan*</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Luas Dalam Are*</label>
            <input type="text" name="large" class="form-control @error('large') is-invalid @enderror" value="{{old('large')}}">
            @error('large')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small><i>Menampilkan luas tanah dengan satuan Are.</i></small>
            <small><i>1 Are = 100 Meter Persegi.</i></small>
            <small><i>1 Hektar = 100 Are.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Sertifikasi Tanah*</label>
            <select class="form-select" name="certification" aria-label="Default select example">
                <option value="SHM - Sertifikat Hak Milik">SHM - Sertifikat Hak Milik</option>
                <option value="HGU - Hak Guna Usaha">HGU - Hak Guna Usaha</option>
                <option value="SHP - Sertifikat Hak Pakai">SHP - Serfifikat Hak Pakai</option>
                <option value="HGB - Hak Guna Bangunan">HGB - Hak Guna Bangunan</option>
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
            <label for="exampleInputEmail1" class="form-label">Larangan*</label>
            <textarea name="notice" class="form-control @error('notice') is-invalid @enderror" cols="30" rows="10">{{ old('notice') }}</textarea>
            @error('notice')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small><i>Merujuk pada peraturan atau pembatasan tertentu yang berlaku di sekitar lokasi. Informasi ini mencakup larangan atau kebijakan khusus yang perlu diperhatikan, seperti larangan merokok, larangan penggunaan alat berat pada jam tertentu, atau larangan memasuki area tertentu tanpa izin. Larangan ini penting untuk dipatuhi demi menjaga keamanan dan kenyamanan di sekitar lokasi tersebut.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Harga</label>
            <input type="text" id="myInput" oninput="formatNumberWithCommas()" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <!-- <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kurun Sewa</label>
            <input type="text" name="period" class="form-control" value="Tahun" readonly>
        </div> -->
        <input type="hidden" name="period" class="form-control" value="Tahun" readonly>


        <h4 class="mt-5">Fasilitas</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Tanah*</label>
            <select class="form-select" name="land" aria-label="Default select example">
                <option value="Regosol">Regosol - Tanah vulkanik longgar, cocok pertanian, drainase baik, rendah bahan organik, nutrisi rendah.</option>
                <option value="Latosol">Latosol - Tanah lempung merah, kaya mineral, tinggi keasaman.</option>
                <option value="Organosol">Organosol - Tanah dengan tingkat dekomposisi tinggi, banyak bahan organik.</option>
                <option value="Podsolik Merah Kuning (PMK)">Podsolik Merah Kuning (PMK) - Tanah asam, terbentuk dari pelapukan material asam, kandungan zat besi dan aluminium tinggi.</option>
                <option value="Laterit">Laterit - Tanah merah bata, kaya oksida besi dan aluminium, terbentuk di daerah tropis.</option>
                <option value="Litosol">Litosol - Tanah tipis dengan lapisan batu di bawahnya.</option>
                <option value="Rendzina">Rendzina - Tanah kapur, kandungan nutrisi tinggi, cocok untuk pertanian.</option>
                <option value="Mediteran">Mediteran - Tanah di wilayah Mediterania, sering kering dan tandus.</option>
                <option value="Grumusol">Grumusol - Tanah liat berbutir halus, kaya bahan organik, baik untuk pertanian.</option>
                <option value="Aluvial">Aluvial - Tanah aluvial adalah jenis tanah yang terbentuk dari endapan sedimen atau material yang dibawa oleh aliran air sungai, atau air hujan.</option>
            </select>
            <small><i>Menjelaskan karakteristik atau tipe tanah yang dominan di sekitar lokasi. Informasi ini dapat mencakup jenis tanah seperti lempung, pasir, tanah liat, atau tanah berhumus. Karakteristik tanah ini dapat mempengaruhi pertanian, konstruksi, atau aktivitas lain yang melibatkan tanah di area tersebut.</i></small>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Irigasi*</label>
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
            <!-- <input type="text" name="irigation" class="form-control mt-3" id="idOfTextField" placeholder="Penjelas Irigasi"> -->
            <select class="form-select" id="idOfTextField" name="irigation" aria-label="Default select example">
                <option value="Irigasi Permukaan">Irigasi Permukaan</option>
                <option value="Irigasi Air Tanah">Irigasi Air Tanah</option>
                <option value="Irigasi Air Sistem Pantek">Irigasi Air Sistem Pantek</option>
                <option value="Irigasi Air Cara Tetesan">Irigasi Air Cara Tetesan</option>
            </select>
            <small><i>Sistem pengaliran air yang digunakan untuk menyediakan air kepada tanaman atau pertanian di sekitar lokasi. Informasi ini mencakup keberadaan, ketersediaan, atau kondisi irigasi yang dapat mempengaruhi pertanian atau kegiatan yang membutuhkan air di area tersebut.</i></small>
        </div>


        <h4 class="mt-5">Fasilitas Tambahan</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Akses Jalan*</label>
            <select class="form-select" name="road" aria-label="Default select example">
                <option value="Hanya Bisa Dilewati Pejalan Kaki">Hanya Bisa Dilewati Pejalan Kaki</option>
                <option value="Bisa Dilalui Motor">Bisa Dilalui Motor</option>
                <option value="Bisa Dilalui 1 Mobil">Bisa Dilalui 1 Mobil</option>
                <option value="Bisa Dilalui 2 Mobil">Bisa Dilalui 2 Mobil</option>
                <option value="Bisa Dilalui 3 Mobil">Bisa Dilalui 3 Mobil</option>
            </select>
            @error('road')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small><i>Dapat mencakup informasi tentang kondisi jalan, jenis jalan (aspal, tanah, atau berbatu), dan aksesibilitas umum.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pemandangan*</label>
            <select class="form-select" name="view" aria-label="Default select example">
                <option value="Pegunungan">Pegunungan</option>
                <option value="Persawahan">Persawahan</option>
                <option value="Jalan Raya">Jalan Raya</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <small><i>Menggambarkan panorama atau tampilan visual yang dapat dilihat dari lokasi tertentu. Dapat mencakup informasi tentang keindahan alam, bangunan, dan elemen lainnya yang mempengaruhi pengalaman visual.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jarak Sumber Air <b>Meter</b>*</label>
            <select class="form-select" name="range" aria-label="Default select example">
                <option value="Kurang dari 1 Meter">Kurang dari 1 Meter</option>
                <option value="2 Meter">2 Meter</option>
                <option value="3 Meter">3 Meter</option>
                <option value="4 Meter">4 Meter</option>
                <option value="Lebih dari 4 Meter">Lebih dari 4 Meter</option>
            </select>
            <small><i>Merupakan jarak dari lokasi yang diukur dalam satuan meter ke sumber air terdekat. Sumber air dapat berupa sungai, danau, sumur, atau sumber air lainnya yang dapat digunakan untuk keperluan air.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Suhu <b>Celcius</b>*</label>
            <input type="text" name="temperature" class="form-control" value="{{ old('temperature') }}">
            @error('temperature')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <small><i>Menyatakan suhu dalam satuan Celcius. Informasi ini memberikan gambaran tentang suhu udara atau suhu di lingkungan sekitar lokasi tertentu.</i></small>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ketinggian <b>Mdpl</b>*</label>
            <select class="form-select" name="height" aria-label="Default select example">
                <option value="Kurang dari 10 Mdpl">Kurang dari 10 Mdpl</option>
                <option value="10 - 30 Mdpl">10 - 30 Mdpl</option>
                <option value="30 - 40 Mdpl">30 - 40 Mdpl</option>
                <option value="Lebih dari 50 Mdpl">Lebih dari 50 Mdpl</option>
            </select>
            <small><i>Merupakan ketinggian suatu lokasi di atas permukaan laut (Mdpl) dalam satuan meter. Menyediakan informasi tentang elevasi atau ketinggian wilayah tertentu yang dapat mempengaruhi suhu, tekanan udara, dan iklim di lokasi tersebut.</i></small>
        </div>

        <h4 class="mt-5">Gambar Pendukung</h4>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 1*</label>
            <input type="file" name="picture_one" class="form-control @error('picture_one') is-invalid @enderror">
            @error('picture_one')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 2*</label>
            <input type="file" name="picture_two" class="form-control @error('picture_two') is-invalid @enderror">
            @error('picture_two')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 3*</label>
            <input type="file" name="picture_three" class="form-control @error('picture_three') is-invalid @enderror">
            @error('picture_three')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gambar Lahan 4*</label>
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