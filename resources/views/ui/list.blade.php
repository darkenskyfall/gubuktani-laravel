@extends('ui.app')

@section('title', 'Cari Lahan')

@section('content')
<div class="container">
    @if($category != null)
    <h4 class="mt-5">Kategori {{ $category->cateogory }}</h4>
    @elseif($search != "")
    <h4 class="mt-5">Hasil Pencarian dari "{{ $search }}"</h4>
    @endif
    @if(session('success'))
    <p class="alert alert-success mt-3">{{ session('success') }}</p>
    @endif
    <div class="row mt-5">
        <div class="col-md-3">
            <!-- Filter Section -->
            <div class="card mb-3">
                <div class="card-header">
                    Filter
                </div>
                <div class="card-body">
                    <!-- Add your filter options here -->
                    <!-- For example, you can use form controls, checkboxes, radio buttons, etc. -->
                    <form action="{{ route('ads.filter') }}" method="get">
                        <div class="form-group">
                            <label for="category">Filter Berdasarkan Tanah:</label>
                            <select class="form-control mt-3" id="category" name="filter">
                                @if($filter != NULL)
                                    <option value="{{ $filter }}">{{ $filter }}</option>
                                @endif
                                <option value="">Semua</option>
                                <option value="Regosol">Regosol</option>
                                <option value="Latosol">Latosol</option>
                                <option value="Organosol">Organosol</option>
                                <option value="Podsolik Merah Kuning (PMK)">Podsolik Merah Kuning (PMK)</option>
                                <option value="Laterit">Laterit</option>
                                <option value="Litosol">Litosol</option>
                                <option value="Rendzina">Rendzina</option>
                                <option value="Mediteran">Mediteran</option>
                                <option value="Grumusol">Grumusol</option>
                                <option value="Aluvial">Aluvial</option>
                            </select>
                        </div>
                        <!-- Add more filter options here -->
                        <!-- For example, add checkboxes for tags, radio buttons for sorting options, etc. -->
                        <div class="form-group">
                            <!-- Add more form controls here -->
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit Filter</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Main Content Section -->
            <!-- Add your main content here -->
            <h1>Cari Lahan</h1>
            <p>Hasil data lahan yang tertera.</p>
            <!-- Display the filtered results here -->
            <!-- You can use a loop to show the filtered data, e.g., list of products, articles, etc. -->
            <div class="row row-cols-1 mt-3 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($ads as $ad) 
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{ URL::asset('ads/' . $ad->picture_one) }}" class="card-img-top" alt="{{ $ad->title }}">
                        <div class="card-body">
                            <h4><b>{{ $ad->title }}</b></h4>
                            <ul class="mt-3">
                            <li><b>{{ $ad->categories->cateogory }}</b></li>
                                <li>Luas {{ $ad->large }} <b>Are</b></li>
                                <li>Rp. {{ number_format($ad->price) }} / {{ $ad->period }}</li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="btn-group">
                                    <a href="{{ url('/ads/detail/' . $ad->id) }}" class="btn btn-sm btn-outline-secondary">Lihat Selengkapnya</a>
                                    <a href="#" class="btn btn-sm {{ ($ad->condition == 0) ? 'btn-primary' : 'btn-danger' }} }}">{{ ($ad->condition == 0) ? "Tersedia" : "Tersewa" }}</a>
                                </div>
                                <small class="text-muted text-right">Di unggah<br>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $ads->links() }}
        </div>
    </div>
</div>

@endsection