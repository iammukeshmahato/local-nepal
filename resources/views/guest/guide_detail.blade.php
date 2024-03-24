@extends('guest.layouts.main')
@push('title')
    <title>Home | LocalNepal</title>
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

        .notice_action {
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

        .notice_action_btns {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1rem;
        }

        .card-body:hover .notice_action {
            visibility: visible;
        }
    </style>
@endpush
@section('main-content')
    <div class="container py-5 px-5">
        <h1 class="text-center mb-5">Guide's Profile</h1>
        <div class="row justify-content-center px-5">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img" src="{{ asset('storage/profiles/' . $guide->user->avatar) }}" alt="Card image cap">
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <div class="detail-box">
                    <h5 class="mb-3">Name: {{ $guide->user->name }}</h5>
                    <h5 class="mb-3">Phone: {{ $guide->phone }}</h5>
                    <h5 class="mb-3">Email: {{ $guide->user->email }}</h5>
                    <h5 class="mb-3">Location: {{ $guide->location }} </h5>

                    <a href="{{ url('/guides/' . base64_encode($guide->id)) }}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>

        <hr class="mt-5">

        <div class="row">
            <div class="col-md-8">
                <div class="about mt-5">
                    <h2 class="mb-3">About</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia cum minus suscipit, minima
                        veritatis officiis quisquam facere atque officia eos possimus deserunt error illo maxime, saepe est
                        quae in non.</p>
                </div>

                <div class="about mt-5">
                    <h2 class="mb-3">Spoken Language</h2>
                    @php
                        $languages = explode(',', $guide->languages);
                    @endphp
                    <ul>
                        @foreach ($languages as $language)
                            <li>{{ $language }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4 border-5">
                <h3 class="text-center mt-3">Rate Us</h3>
                <form action="{% url 'customer:rating' %}" method="post" id="rating-from">
                    @csrf
                    <div class="stars text-center mb-5">
                        <span onclick="gfg(1)" class="star">★</span>
                        <span onclick="gfg(2)" class="star">★</span>
                        <span onclick="gfg(3)" class="star">★</span>
                        <span onclick="gfg(4)" class="star">★</span>
                        <span onclick="gfg(5)" class="star">★</span>
                        <h3 id="output">Rating is: 0/5</h3>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                            name="review" required></textarea>
                        <label for="floatingTextarea2">How did you like our service?</label>
                    </div>

                    <input type="hidden" name="rating" id="rating" />
                    <input type="hidden" name="employee" value="{{ 'employee . pk' }}" />
                    <div class="d-flex justify-content-center my-4">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-12">
            <h1>Reviews & Ratings</h1>
            <div class="card h-100">
                <div class="card-body row widget-separator">
                    <div class="col-sm-5 border-shift border-end">
                        <h2 class="text-primary">4.89<i class="bx bxs-star mb-2 ms-1"></i></h2>
                        <p class="fw-medium mb-1">Total 187 reviews</p>
                        <p class="text-muted">All reviews are from genuine customers</p>
                        <hr class="d-sm-none">
                    </div>

                    <div class="col-sm-7 gy-1 text-nowrap d-flex flex-column justify-content-between ps-4 gap-2 pe-3">
                        <div class="d-flex align-items-center gap-3">
                            <small>5 Star</small>
                            <div class="progress w-100" style="height:10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"
                                    aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="w-px-20 text-end">124</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <small>4 Star</small>
                            <div class="progress w-100" style="height:10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 30%"
                                    aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="w-px-20 text-end">40</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <small>3 Star</small>
                            <div class="progress w-100" style="height:10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 15%"
                                    aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="w-px-20 text-end">12</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <small>2 Star</small>
                            <div class="progress w-100" style="height:10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                    aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="w-px-20 text-end">7</small>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <small>1 Star</small>
                            <div class="progress w-100" style="height:10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 5%"
                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="w-px-20 text-end">2</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <div class="col mt-5">
            <div class="card border-bottom" style="border: 0">
                <div class="card-body p-0">
                    <div class="row py-2">
                        <div class="col-lg-2 d-flex justify-content-center align-items-top mb-4 mb-lg-0">
                            <img src="{{ asset('assets/img/profile.png') }}" class="rounded-circle shadow-1"
                                alt="woman avatar" width="100" height="100" style="object-fit: cover;" />
                        </div>
                        <div class="col-lg-10 pe-5">
                            <p class="fw-bold lead mb-2">
                                <strong>{{ 'Mukesh mahato' }}</strong>
                            </p>
                            <ul class="list-unstyled d-flex" style="font-size: 1.5rem;">
                                {{-- {% for i in review.rate %} --}}
                                <li class="me-2">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-primary' style="opacity: 0.5"></i>
                                </li>
                                {{-- {% endfor %} --}}
                            </ul>
                            <p class="text-muted fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Consectetur unde, aliquam laboriosam nostrum voluptates obcaecati id esse cum labore atque
                                animi dolores odit, enim autem optio sunt at ipsum voluptatem.</p>

                            <p class="text-muted fw-light text-end mb-0">
                                Posted on: <i>{{ '2022 jan 1' }}</i>
                            </p>

                            {{-- {% if review.customer == request.user %}
                            <div class="notice_action">
                                <div class="notice_action_btns">
                                    <a class="btn btn-danger w-100" href="/customer/rating/{{ review . pk }}/delete"
                                        onclick="return confirm('Are you sure want to delete ?')">Delete</a>
                                </div>
                            </div>
                            {% endif %} --}}
                        </div>
                    </div>
                    <hr>
                    <div class="row py-2">
                        <div class="col-lg-2 d-flex justify-content-center align-items-top mb-4 mb-lg-0">
                            <img src="{{ asset('assets/img/profile.png') }}" class="rounded-circle shadow-1"
                                alt="woman avatar" width="100" height="100" style="object-fit: cover;" />
                        </div>
                        <div class="col-lg-10 pe-5">
                            <p class="fw-bold lead mb-2">
                                <strong>{{ 'Mukesh mahato' }}</strong>
                            </p>
                            <ul class="list-unstyled d-flex" style="font-size: 1.5rem;">
                                {{-- {% for i in review.rate %} --}}
                                <li class="me-2">
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-warning'></i>
                                    <i class='bx bxs-star text-primary' style="opacity: 0.5"></i>
                                </li>
                                {{-- {% endfor %} --}}
                            </ul>
                            <p class="text-muted fw-light">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Consectetur unde, aliquam laboriosam nostrum voluptates obcaecati id esse cum labore atque
                                animi dolores odit, enim autem optio sunt at ipsum voluptatem.</p>

                            <p class="text-muted fw-light text-end mb-0">
                                Posted on: <i>{{ '2022 jan 1' }}</i>
                            </p>

                            {{-- {% if review.customer == request.user %}
                            <div class="notice_action">
                                <div class="notice_action_btns">
                                    <a class="btn btn-danger w-100" href="/customer/rating/{{ review . pk }}/delete"
                                        onclick="return confirm('Are you sure want to delete ?')">Delete</a>
                                </div>
                            </div>
                            {% endif %} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="row">
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
        </div> --}}
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
@endpush
