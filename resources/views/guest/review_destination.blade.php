@extends('guest.layouts.main')
@push('title')
    <title>Write Your Opinion | LocalNepal</title>
@endpush

@push('links')
    <link rel="stylesheet" href="{{ asset('assets/css/stars.css') }}">
@endpush
@section('main-content')
    @include('vendor.sweetalert.alert')
    <div class="container py-5">
        <div class="card mx-4 ">
            <h5 class="card-header text-center" style="font-size: 2rem;">{{ $destination->title }}</h5>
            <div class="row d-flex justify-content-center">

                <div class="col-md-4 border-5">
                    <h3 class="text-center mt-3">Write your opinion</h3>
                    <form action="{{ url('/destinations/' . $destination->slug) . '/review' }}" method="post"
                        id="rating-from">
                        @csrf
                        <div class="stars text-center mb-5">
                            <span onclick="gfg(1)" class="star">★</span>
                            <span onclick="gfg(2)" class="star">★</span>
                            <span onclick="gfg(3)" class="star">★</span>
                            <span onclick="gfg(4)" class="star">★</span>
                            <span onclick="gfg(5)" class="star">★</span>
                            <h3 id="output">Rating is: 0/5</h3>
                        </div>
                        @error('rating')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                name="review" required></textarea>
                            <label for="floatingTextarea2">How did you like {{ $destination->title }}?</label>
                        </div>

                        <input type="hidden" name="rating" id="rating" />
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}" />
                        <div class="d-flex justify-content-center my-4">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/js/stars.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endpush
