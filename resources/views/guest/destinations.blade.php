@extends('guest.layouts.main')
@push('title')
    <title>Destinations | LocalNepal</title>
@endpush
@push('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush
@section('main-content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Destinations</h1>
        <div class="row">
            @foreach ($destinations as $destination)
                <div class="col-md-4 col-ld-3 mb-5 guide position-relative">
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('storage/destinations/' . $destination->cover_image) }}"
                            alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h5 class="guide-name">{{ $destination->title }}</h5>
                                <h6 class="text-muted">{{ $destination->type }}</h6>
                            </div>
                            <div class="guide-star ms-5">
                                <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                    class='bx bx-star'></i><i class='bx bx-star'></i>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/destinations/' . $destination->slug) }}" class="stretched-link"></a>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">{{ $destinations->links() }} </div>
    </div>
@endsection
