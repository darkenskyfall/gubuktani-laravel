<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gubuktani - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .carousel-inner>.carousel-item {
        height: 500px;

    }

    .carousel-inner>.carousel-item>img {
        border-radius: 8px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        max-height: 500px;
        width: auto;
    }

    .carousel-control.left,
    .carousel-control.right {
        background-image: none;
    }

    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }

    .fit-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
    }

    .fit-image-profile {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
    
</style>

<body>

    <nav class="navbar navbar-expand-lg p-3" style="background: #2ecc71;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ url('/') }}"><i class="fas fa-seedling"></i> Gubuktani.online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/ads/list') }}">Cari Lahan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ url('/ads/create') }}"">Pasang Iklan</a>
                    </li>
                    <li class=" nav-item">
                            @if(Auth::guard('web')->check())
                            <a class="nav-link text-white" href="{{ route('profile') }}">Halo {{ Auth::guard('web')->user()->fname  }}</a>
                            @else
                            <a class="nav-link text-white" href="{{ url('/login') }}">Login</a>
                            @endif
                    </li>
                </ul>
                <form class="d-flex" role="search" action="{{ route('ads.search') }}" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
                    <button class="btn btn-primary me-2" type="submit">Search</button>
                    @if(Auth::guard('web')->check())
                    <a class="btn btn-danger" href="{{ route('login.logout') }}">Logout</a>
                    @endif
                </form>
            </div>
        </div>
    </nav>
    @yield('category')
    <main>

        @yield('content')

    </main>

    <!-- <div class="pb-3 bg-dark text-white" style="margin-top: 100px;">
        <div class="container py-5">
            <h1 class="display-5 fw-bold mb-5">Gubuktani.online<br>Website Sewa Lahan Terbaik Di Indonesia</h1>
            <p>Gubuktani menyajikan informasi sewa lahan, lengkap dengan fasilitas lahan, harga lahan, dan deskripsi lahan beserta foto lahan sawah yang disesuaikan dengan kondisi sebenarnya. info lahan kami akurat dan bermanfaat untuk penyewa lahan sawah. Saat ini kami memiliki lebih dari beberapa info lahan sawah dan masih terus bertambah di Indonesia. Data lahan sawah yang kami miliki telah mencakup beberapa provinsi besar seperti jawa timur, jawa tengah, jawa barat, hingga kalimantan dan Sumatra. Pengembangan data lahan sawah masih terus kami usahakan. Namun demikian, kamu dapat request penambahan info lahan sawah di seputar area yang kamu inginkan dengan mengisi data di Umpan Balik Kami. Kamu juga dapat menambahkan masukan, saran dan kritikan untuk Gubuktani di form tersebut. Dukungan kamu, akan mempercepat pengembangan data lahan yang kami miliki.</p>
            <p>Jika kamu ingin mendapatkan inspirasi lahan yang sangat ciamik atau bisa cek lahan eksklusif yang ada di Gubuktani. Dengan luas lahan yang relatif, kebanyakan lahan eksklusif hanya diberikan lahan strategis atau keuntungan yang lebih menarik, ditambah pemandangan beserta kesejukan lahan tersebut sebagai tempat wisata yang menghasilkan, dengan tambahan . Di Gubuktani kini juga telah ditambahkan berbagai info lahan dengan harga murah ataupun beberapa tipe lahan lain sesuai masukan dari pengguna Gubuktani.</p>
        </div>
    </div> -->


    <footer class="d-flex flex-wrap justify-content-between align-items-center p-3 text-white" style="background: #2ecc71; margin-top:100px;">
        <p class="col-md-4 mb-0">&copy; 2022 Gubuktani.online</p>

        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
        </a>

        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="{{ route('policy') }}" class="nav-link px-2 text-white">Kebijakan Privasi</a></li>
            <li class="nav-item"><a href="{{ route('help') }}" class="nav-link px-2 text-white">Bantuan</a></li>
            <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link px-2 text-white">Kontak</a></li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link px-2 text-white">Tentang Kami</a></li>
        </ul>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ URL::asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/datatables-simple-demo.js') }}"></script>
    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this item?");
            console.log(result);
            if (result === true) {
                document.getElementById("delete-form").submit();
            }
        }
    </script>
</body>

</html>