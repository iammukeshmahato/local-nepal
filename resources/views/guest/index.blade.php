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
    <section class="p-0">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active border-0"
                    aria-label="Slide 1" aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"
                    class="border-0"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"
                    class="border-0"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 3"
                    class="border-0"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="./assets/img/ai/1.png" alt="First slide">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption d-md-block" style="top: 20%;">
                        <h1 style="font-size: 45px;">Visit Nepal &nbsp;<img src="./assets/img/np.gif"
                                style="height: 45px;margin-bottom: 10px;" alt="flag"></h1>
                        <h2>With locals</h2>
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Connecting Cultures</h3>
                        <p>Experience the warmth of local guidance and explore Nepal through the eyes of its people.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./assets/img/ai/2.png" alt="Second slide">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h3>Adventures in the Himalayas</h3>
                        <p>Embark on an unforgettable journey amidst the breathtaking landscapes of the Himalayas.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./assets/img/ai/3.png" alt="Third slide">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h3>Heart of Nepal</h3>
                        <p>Discover the vibrant culture and traditional lifestyle in Nepal's picturesque villages.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="./assets/img/ai/4.png" alt="Third slide">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <h3>Spirit of Adventure in Nepal</h3>
                        <p>Embark on a journey through Nepal's majestic landscapes and adventures.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>

    @if (!$destinations->isEmpty() && count($destinations) >= 3)
        <section>
            <div class="container">
                <h1 class="text-center mb-5">Popular Destinations</h1>

                <main>
                    <div class="slider-container">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($destinations as $item)
                                    <div class="swiper-slide">
                                        <div>
                                            <img src="{{ asset('storage/destinations/' . $item->cover_image) }}"
                                                alt="..." />
                                            <p class="overlay">
                                                {{ $item->title }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="button-prev">
                            <img src="https://img.icons8.com/ios/50/000000/chevron-left.png" alt="" />
                            <p>Back</p>
                        </div>
                        <div class="button-next">
                            <img src="https://img.icons8.com/ios/50/000000/chevron-right.png" alt="" />
                            <p>Next</p>
                        </div>
                    </div>
                </main>

            </div>
        </section>
    @endif


    @if (!$guides->isEmpty())
        <div class="container py-5">
            <h1 class="text-center mb-5">Popular Guides</h1>
            <div class="row d-flex justify-content-center">
                @foreach ($guides as $item)
                    <div class="col-md-4 col-ld-3 mb-5 guide">
                        <div class="card mb-4">
                            <img class="card-img-top"
                                src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                                alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h5 class="guide-name">{{ $item->user->name }}</h5>
                                    <h6 class="guide-rate">${{ $item->rate }}/hr</h6>
                                </div>
                                <div class="guide-star ms-5">
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i <= round($item->reviews_avg_rating))
                                            <i class='bx bxs-star'></i>
                                        @endif
                                    @endfor
                                    <h6 class="mt-1">{{ count($item->reviews) }} Reviews</h6>
                                </div>
                                <div class="ms-4">
                                    <h5>{{ $item->location }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (count($reviews) >= 6)
                    <div class="d-flex justify-content-center">
                        <a href="" class="btn btn-success text-black">View All</a>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if (!$reviews->isEmpty())
        <section>
            <h1 class="text-center mb-5">What our user say</h1>

            <div class="reviews p-5 m-5 pb-0">
                <div class="row justify-content-center">

                    @foreach ($reviews as $item)
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="card">
                                <p class="text-black quote m-0"><i class='bx bxs-quote-alt-left'></i></p>
                                <span class="post-txt">{{ $item->review }}</span>
                            </div>
                            <div class="arrow-down"></div>
                            <div class="profile">
                                <img class="profile-pic fit-image" src="{{ asset('storage/profiies' . $item->avatar) }}"
                                    alt="...">
                                <span class="profile-name">{{ $item->user->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (count($reviews) >= 6)
                <div class="d-flex justify-content-center">
                    <a href="" class="btn btn-success text-black">View All</a>
                </div>
            @endif
        </section>
    @endif
@endsection

@push('script')
    <script>
        const swiper = new Swiper(".swiper", {
            direction: "horizontal",
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,

            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                530: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 1,
                    slidesPerView: {{ count($destinations) >= 4 ? 4 : count($destinations) }},
                },
            },

            navigation: {
                nextEl: ".button-next",
                prevEl: ".button-prev",
            },
        });
    </script>
@endpush
