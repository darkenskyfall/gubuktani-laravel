@extends('ui.app')

@section('title', 'Tentang')

@section('content')
<div class="pb-3" style="margin-top: 100px;">
    <div class="container">
        <h1 class="display-5 fw-bold mb-5">Gubuktani.online<br>Website Sewa Lahan Terbaik Di Indonesia</h1>
        <p>Gubuktani menyajikan informasi sewa lahan, lengkap dengan fasilitas lahan, harga lahan, dan deskripsi lahan beserta foto lahan sawah yang disesuaikan dengan kondisi sebenarnya. info lahan kami akurat dan bermanfaat untuk penyewa lahan sawah. Saat ini kami memiliki lebih dari beberapa info lahan sawah dan masih terus bertambah di Indonesia. Data lahan sawah yang kami miliki telah mencakup beberapa provinsi besar seperti jawa timur, jawa tengah, jawa barat, hingga kalimantan dan Sumatra. Pengembangan data lahan sawah masih terus kami usahakan. Namun demikian, kamu dapat request penambahan info lahan sawah di seputar area yang kamu inginkan dengan mengisi data di Umpan Balik Kami. Kamu juga dapat menambahkan masukan, saran dan kritikan untuk Gubuktani di form tersebut. Dukungan kamu, akan mempercepat pengembangan data lahan yang kami miliki.</p>
        <p>Jika kamu ingin mendapatkan inspirasi lahan yang sangat ciamik atau bisa cek lahan eksklusif yang ada di Gubuktani. Dengan luas lahan yang relatif, kebanyakan lahan eksklusif hanya diberikan lahan strategis atau keuntungan yang lebih menarik, ditambah pemandangan beserta kesejukan lahan tersebut sebagai tempat wisata yang menghasilkan, dengan tambahan . Di Gubuktani kini juga telah ditambahkan berbagai info lahan dengan harga murah ataupun beberapa tipe lahan lain sesuai masukan dari pengguna Gubuktani.</p>

        <hr>
        <p>Jika anda merasa terbantu dengan website ini diharapkan sedianya mengirimkan kritik saran kepada kami selaku penyedia website Gubuktani.online segala sesuatu yang berkaitan dengan website ini atau kesepakatan bisnis dengan kami anda bisa menghubungi kontak dibawah ini</p>

        <ul class="list-group mt-3">
            <li class="list-group-item disabled">support@gubuktani.online</li>
            <li class="list-group-item disabled">Jl . Manukan Rejo III 1C / 8 , Manukan Kulon , Tandes , Surabaya Jawa Timur 60185</li>
            <li class="list-group-item disabled">+6285 - 881 - 824 - 590</li>
        </ul>

        <h3 class="mt-5">Peta Lokasi</h3>
        <div class="mt-3" style="width:100%;height:400px;background:#27ee71;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8198715524045!2d112.66399439980671!3d-7.26133068031436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fe7d36500087%3A0x7433e0f8546d3751!2sgubuktani+office!5e0!3m2!1sid!2sid!4v1517741241190" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <h3 class="mt-5">Umpan Balik</h3>
        @if(session('success'))
        <p class="alert alert-success mt-3">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger mt-3">{{ $err }}</p>
        @endforeach
        @endif
        <form class="mt-3" action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Isi</label>
                <textarea name="desc" class="form-control" id="" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Umpan Balik</button>
        </form>
    </div>
</div>
@endsection