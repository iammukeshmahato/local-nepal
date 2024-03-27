@extends('admin.layouts.main')
@push('title')
    <title>{{ $item->title }} - Admin | LocalNepal</title>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header text-center" style="font-size: 2rem;">{{ $item->title }}</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/destinations/' . $item->cover_image) }}" class="rounded w-100"
                        style="height: 400px !important; object-fit:cover;" alt="">
                </div>
                <div class="col-md-6 mt-3">
                    <div class="col-md-6 mt-3">
                        <h5 class="card-title">Location</h5>
                        {!! $item->location !!}
                    </div>
                    <div class="col-md-6 mt-3">
                        <h5 class="card-title">type</h5>
                        {!! $item->type !!}
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <h5 class="card-title">About</h5>
                    {!! $item->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
