@extends('guest.layouts.main')
@push('title')
    <title>Home | LocalNepal</title>
@endpush
@push('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
@endpush
@section('main-content')
    <div class="container py-5">
        <h1 class="text-center mb-5">{{ $guide->user->name }}</h1>
        <div class="row">
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top" src="{{ asset('storage/profiles/' . $guide->user->avatar) }}"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">{{ $guide->user->name }}</h5>
                            <h6 class="guide-rate">${{ $guide->rate }}</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                    <a href="{{ url('/guides/' . base64_encode($guide->id)) }}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
@endsection
