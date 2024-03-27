@extends('guest.layouts.main')
@push('title')
    <title>{{ $destination->title }} | LocalNepal</title>
@endpush

@push('links')
    <style>
        .star {
            font-size: 5vh;
            cursor: pointer;
        }

        .one {
            color: rgb(255, 0, 0);
        }

        .two {
            color: rgb(255, 106, 0);
        }

        .three {
            color: rgb(251, 255, 120);
        }

        .four {
            color: rgb(255, 255, 0);
        }

        .five {
            color: rgb(24, 159, 14);
        }

        .delete_action {
            visibility: hidden;
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            margin: 0 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .delete_action_btns {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
        }

        .review:hover .delete_action {
            visibility: visible;
        }
    </style>
@endpush
@section('main-content')
    <div class="container py-5">
        <div class="card mx-4">
            <h5 class="card-header text-center" style="font-size: 2rem;">{{ $destination->title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/destinations/' . $destination->cover_image) }}" class="rounded w-100"
                            style="height: 400px !important; object-fit:cover;" alt="">
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="col-md-6 mt-3">
                            <h5 class="d-inline">Location:</h5>
                            {!! $destination->location !!}
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5 class="d-inline">type:</h5>
                            {!! $destination->type !!}
                        </div>
                        <div class="col mt-3">
                            @if (count($destination->reviews) != 0)
                                <div class="card h-100">
                                    <div class="card-body row widget-separator">
                                        <div class="col-sm-5 border-shift border-end">
                                            <h2 class="text-primary">
                                                @php
                                                    $sum = 0;
                                                    $ratings_count = array_fill(0, 5, 0);
                                                    foreach ($destination->reviews as $review) {
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
                                                    $average = $sum / count($destination->reviews);
                                                @endphp
                                                {{ number_format($average, 1) }}
                                                <i class="bx bxs-star mb-2 ms-1"></i>
                                            </h2>
                                            <p class="fw-medium mb-1">Total {{ count($destination->reviews) }} reviews</p>
                                            <p class="text-muted">All reviews are from genuine customers</p>
                                            <hr class="d-sm-none">
                                        </div>

                                        <div
                                            class="col-sm-7 gy-1 text-nowrap d-flex flex-column justify-content-between ps-4 gap-2 pe-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <small>5 Star</small>
                                                <div class="progress w-100" style="height:10px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style=""
                                                        id="progress-bar-5" aria-valuenow="61.50" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                    </div>
                                                </div>
                                                <small class="w-px-20 text-end">{{ $ratings_count[4] }}</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <small>4 Star</small>
                                                <div class="progress w-100" style="height:10px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style=""
                                                        id="progress-bar-4" aria-valuenow="{{ $ratings_count[3] }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small class="w-px-20 text-end">{{ $ratings_count[3] }}</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <small>3 Star</small>
                                                <div class="progress w-100" style="height:10px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style=""
                                                        id="progress-bar-3" aria-valuenow="{{ $ratings_count[2] }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small class="w-px-20 text-end">{{ $ratings_count[2] }}</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <small>2 Star</small>
                                                <div class="progress w-100" style="height:10px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style=""
                                                        id="progress-bar-2" aria-valuenow="{{ $ratings_count[1] }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small class="w-px-20 text-end">{{ $ratings_count[1] }}</small>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <small>1 Star</small>
                                                <div class="progress w-100" style="height:10px;">
                                                    <div class="progress-bar bg-primary" role="progressbar" style=""
                                                        id="progress-bar-1" aria-valuenow="{{ $ratings_count[0] }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <small class="w-px-20 text-end">{{ $ratings_count[0] }}</small>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-12 mt-3">
                        <h5>About</h5>
                        {!! $destination->description !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="col mt-5 mx-4">
            <div class="card border-bottom" style="border: 0">
                <h5 class="card-header text-center" style="font-size: 2rem;">Rating & Reviews</h5>
                <div class="card-body p-0">
                    @if (count($destination->reviews) == 0)
                        <h4 class="text-center mt-3">No reviews</h4>
                    @else
                        {{-- @if ($reviews->hasPages()) --}}
                        @foreach ($destination->reviews as $review)
                            <div class="row py-2 review">
                                <div class="col-lg-2 d-flex justify-content-center align-items-top mb-4 mb-lg-0">
                                    <img src="{{ asset('storage/profiles/' . $review->user->avatar) }}"
                                        class="rounded-circle shadow-1" alt="woman avatar" width="100" height="100"
                                        style="object-fit: cover;" />
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
                                        </li>
                                        {{-- {% endfor %} --}}
                                        </li>
                                        {{-- {% endfor %} --}}
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
                        {{-- <div class="d-flex justify-content-center mt-5">{{ $reviews->links() }} </div> --}}
                        {{-- @endif --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // To access the stars
        let stars = document.getElementsByClassName('star')
        let output = document.getElementById('output')

        // Funtion to update rating
        function gfg(n) {
            remove()
            for (let i = 0; i < n; i++) {
                if (n == 1) cls = 'one'
                else if (n == 2) cls = 'two'
                else if (n == 3) cls = 'three'
                else if (n == 4) cls = 'four'
                else if (n == 5) cls = 'five'
                stars[i].className = 'star ' + cls
            }
            output.innerText = 'Rating is: ' + n + '/5'

            document.getElementById('rating').value = n
        }

        // To remove the pre-applied styling
        function remove() {
            let i = 0
            while (i < 5) {
                stars[i].className = 'star'
                i++
            }
        }
    </script>
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
@endpush
