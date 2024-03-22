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

    <section>
        <div class="container">
            <h1 class="text-center mb-5">Popular Destinations</h1>

            <main>
                <div class="slider-container">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div>
                                    <img src="https://images.unsplash.com/photo-1529733905113-027ed85d7e33"
                                        alt="..." />
                                    <p class="overlay">
                                        Hiking
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div>
                                    <img src="https://images.unsplash.com/photo-1554710869-95f3df6a3197" alt="..." />
                                    <p class="overlay">
                                        Hiking
                                    </p>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div>
                                    <img src="https://images.unsplash.com/photo-1554710869-95f3df6a3197" alt="..." />

                                    <p class="overlay">
                                        Hiking
                                    </p>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div>
                                    <img src="https://images.unsplash.com/photo-1602102488252-c4c3daadf1c2"
                                        alt="..." />

                                    <p class="overlay">
                                        Hiking
                                    </p>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div>
                                    <img src="https://images.unsplash.com/photo-1623492701360-fb4a1205c789"
                                        alt="..." />
                                    <p class="overlay">
                                        Hiking
                                    </p>
                                </div>
                            </div>
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


    <div class="container py-5">
        <h1 class="text-center mb-5">Popular Guides</h1>
        <div class="row">
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-ld-3 mb-5 guide">
                <div class="card mb-4">
                    <img class="card-img-top"
                        src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/img/elements/5.jpg"
                        alt="Card image cap">
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="guide-name">Mukesh Mahato</h5>
                            <h6 class="guide-rate">$999</h6>
                        </div>
                        <div class="guide-star ms-5">
                            <i class='bx bx-star'></i><i class='bx bx-star'></i><i class='bx bx-star'></i><i
                                class='bx bx-star'></i><i class='bx bx-star'></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="" class="btn btn-success text-black">View All</a>
            </div>
        </div>
    </div>

    <section>
        <h1 class="text-center mb-5">What our user say</h1>

        <div class="reviews p-5 m-5 pb-0">
            <div class="row justify-content-center">

                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="card">
                        <p class="text-black quote m-0"><i class='bx bxs-quote-alt-left'></i></p>
                        <span class="post-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae ea facere unde
                            cum dicta. Animi impedit illo voluptates cumque quasi reprehenderit rem tempora provident quia,
                            eos aspernatur repellat ducimus autem.</span>
                    </div>
                    <div class="arrow-down"></div>
                    <div class="profile">
                        <img class="profile-pic fit-image" src="{{ asset('assets/img/profile.png') }}" alt="...">
                        <span class="profile-name">Mukesh Mahato</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="card">
                        <p class="text-black quote m-0"><i class='bx bxs-quote-alt-left'></i></p>
                        <span class="post-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae ea facere unde
                            cum dicta. Animi impedit illo voluptates cumque quasi reprehenderit rem tempora provident quia,
                            eos aspernatur repellat ducimus autem.</span>
                    </div>
                    <div class="arrow-down"></div>
                    <div class="profile">
                        <img class="profile-pic fit-image" src="{{ asset('assets/img/profile.png') }}" alt="...">
                        <span class="profile-name">Mukesh Mahato</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="card">
                        <p class="text-black quote m-0"><i class='bx bxs-quote-alt-left'></i></p>
                        <span class="post-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae ea facere unde
                            cum dicta. Animi impedit illo voluptates cumque quasi reprehenderit rem tempora provident quia,
                            eos aspernatur repellat ducimus autem.</span>
                    </div>
                    <div class="arrow-down"></div>
                    <div class="profile">
                        <img class="profile-pic fit-image" src="{{ asset('assets/img/profile.png') }}" alt="...">
                        <span class="profile-name">Mukesh Mahato</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <a href="" class="btn btn-success text-black">View All</a>
        </div>
    </section>
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
                    slidesPerView: 4,
                },
            },

            navigation: {
                nextEl: ".button-next",
                prevEl: ".button-prev",
            },
        });
    </script>
@endpush
