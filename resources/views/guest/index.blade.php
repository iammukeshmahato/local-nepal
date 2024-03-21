@extends('guest.layouts.main')
@push('title')
    <title>Home | LocalNepal</title>
@endpush
@push('links')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        .carousel-inner img {
            height: calc(100vh - 56px);
            object-fit: cover
        }

        .carousel-caption h3 {
            font-size: 30px
        }

        .carousel-caption p {
            font-size: 20px
        }

        .carousel-caption p,
        h3,
        .carousel-caption h1 {
            text-shadow: 2px 2px 7px black;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            z-index: 1;
        }

        .carousel-caption {
            z-index: 2;
        }

        section {
            padding: 4rem 0;
            background: #fff;
        }

        .card {
            overflow: hidden;
        }

        .card img {
            height: 450px;
            object-fit: cover;
            opacity: 0.85;
            transition: all 0.3s;

            &:hover {
                opacity: 1;
                transform: scale(1.1);
                transition: all 0.3s;
            }
        }

        .card .card-title {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 0;
            width: 100%;
            padding: 1rem;
            color: white;
            background: rgba(0, 0, 0, 0.7);
            pointer-events: none;
        }
    </style>
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
                                style="height: 45px;margin-bottom: 10px;"></h1>
                        <h3>With locals</h3>
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

    <section>
        <div class="container">
            <h1 class="text-center mb-5">Popular Destinations</h1>
        </div>
    </section>
@endsection

@push('script')
    <script src="./assets/vendor/js/bootstrap.js"></script>
@endpush
