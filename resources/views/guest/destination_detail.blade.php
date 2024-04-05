@extends('guest.layouts.main')
@push('title')
    <title>{{ $destination->title }} | LocalNepal</title>
@endpush

@section('main-content')
    @include('vendor.sweetalert.alert')
    <div class="container py-5">
        <div class="card mx-4">
            <h1 class="card-header text-center" style="font-size: 2rem;">{{ $destination->title }}</h1>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/destinations/' . $destination->cover_image) }}" class="rounded w-100"
                            style="height: 400px !important; object-fit:cover;" alt="">
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="col-md-6 mt-3">
                            <strong class="d-inline">Location:</strong>
                            {!! $destination->location !!}
                        </div>
                        <div class="col-md-6 mt-3">
                            <strong class="d-inline">Type:</strong>
                            {!! $destination->type !!}
                        </div>
                        <div class="col mt-3">
                            @if (count($destination->reviews) != 0)
                                @php
                                    $item = $destination;
                                    $ratings_count = array_fill(0, 5, 0);

                                    $sum = 0;
                                    $ratings_count = array_fill(0, 5, 0);
                                    foreach ($item->reviews as $review) {
                                        $sum += $review->rating;
                                        if ($review->rating == 1) {
                                            $ratings_count[0]++;
                                        } elseif ($review->rating == 2) {
                                            $ratings_count[1]++;
                                        } elseif ($review->rating == 3) {
                                            $ratings_count[2]++;
                                        } elseif ($review->rating == 4) {
                                            $ratings_count[3]++;
                                        } elseif ($review->rating == 5) {
                                            $ratings_count[4]++;
                                        }
                                    }
                                    $average = $sum / count($item->reviews);
                                @endphp
                                @include('guest.layouts.rating_bars')
                            @endif
                        </div>

                    </div>
                    <div class="col-md-12 mt-3">
                        <h2>About</h2>
                        {!! $destination->description !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="col mt-5 mx-4">
            <div class="card border-bottom" style="border: 0">
                <h2 class="card-header text-center" style="font-size: 2rem;">Rating & Reviews</h2>

                <div class="d-flex justify-content-end me-4">
                    <a href="{{ url('/destinations/' . $destination->slug) . '/review' }}" class="btn btn-primary">Write
                        Your Opinion</a>
                </div>

                <div class="card-body p-0">
                    @if (count($destination->reviews) == 0)
                        <h4 class="text-center mt-3">No reviews</h4>
                    @else
                        @foreach ($destination->reviews as $review)
                            <div class="row py-2 review">
                                <div class="col-lg-2 d-flex justify-content-center align-items-top mb-4 mb-lg-0">
                                    <img src="{{ asset('storage/profiles/' . $review->user->avatar) }}"
                                        class="rounded-circle shadow-1" alt="{{ $review->user->name }}" width="100"
                                        height="100" style="object-fit: cover;" />
                                </div>
                                <div class="col-lg-10 pe-5">
                                    <p class="fw-bold lead mb-2">
                                        <strong>{{ $review->user->name }}</strong>
                                    </p>
                                    <ul class="list-unstyled d-flex" style="font-size: 1.5rem;">
                                        <li class="me-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class='bx bxs-star text-warning'></i>
                                                @else
                                                    <i class='bx bxs-star text-primary' style="opacity: 0.5"></i>
                                                @endif
                                            @endfor
                                        </li>
                                    </ul>
                                    <p class="text-muted fw-light">{{ $review->review }}</p>

                                    <p class="text-muted fw-light text-end mb-0">
                                        Posted on: <i>{{ date('d-m-Y', strtotime($review->created_at)) }}</i>
                                    </p>

                                    @if (auth()->check() && auth()->user()->id == $review->user->id)
                                        <div class="delete_action">
                                            <div class="delete_action_btns">
                                                <a class="btn btn-danger w-100"
                                                    href="/guides/review/{{ base64_encode($review->id) }}/delete"
                                                    onclick="return confirm('Are you sure want to delete ?')">Delete</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-4" style="border-color: #ccc" />
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    @if (count($destination->reviews) != 0)
        <script>
            function assign_width() {
                // To update the progress bar
                let progress_bar_5 = document.getElementById('progress-bar-5')
                progress_bar_5.style.width = calculate_width({{ $ratings_count[4] }}, {{ count($destination->reviews) }})

                let progress_bar_4 = document.getElementById('progress-bar-4')
                progress_bar_4.style.width = calculate_width({{ $ratings_count[3] }}, {{ count($destination->reviews) }})

                let progress_bar_3 = document.getElementById('progress-bar-3')
                progress_bar_3.style.width = calculate_width({{ $ratings_count[2] }}, {{ count($destination->reviews) }})

                let progress_bar_2 = document.getElementById('progress-bar-2')
                progress_bar_2.style.width = calculate_width({{ $ratings_count[1] }}, {{ count($destination->reviews) }})

                let progress_bar_1 = document.getElementById('progress-bar-1')
                progress_bar_1.style.width = calculate_width({{ $ratings_count[0] }}, {{ count($destination->reviews) }})

            }

            assign_width()


            // To calculate the width of the progress bar
            function calculate_width(a, b) {
                if (b == 0) return '0%'
                return (a / b) * 100 + '%'
            }
        </script>
    @endif

    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endpush
