<nav class="navbar navbar-example navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}"><img style="height: 30px;margin-left: 20px;margin-right: 20px;"
                src="{{ asset('assets/img/logo.png') }}" alt="localnepal" aria-label="localnepal"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-3"
            aria-label="hamburger menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-ex-3">
            <div class="navbar-nav me-auto">
            </div>
            <div class="navbar-nav align-items-center">
                <a class="nav-item nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-item nav-link" href="{{ url('/destinations') }}">Destination</a>
                <a class="nav-item nav-link" href="{{ url('/guides') }}">Guide</a>
                {{-- <a class="nav-item nav-link" href="{{ url('/') }}">About</a>
                <a class="nav-item nav-link" href="{{ url('/') }}">Contact</a> --}}
                @if (auth()->check())
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <div class="avatar">
                                    <img src="{{ asset('storage/profiles/' . Auth::user()->avatar) }}" alt
                                    class="w-px-40 h-px-40 rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img src="{{ asset('storage/profiles/' . Auth::user()->avatar) }}" alt
                                                        class="w-px-40 h-px-40 rounded-circle" />
                                                    {{-- <img src="{{ asset('assets/img/profile.png') }}" alt
                                                        class="w-px-40 h-auto rounded-circle" /> --}}
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                                <small
                                                    class="text-muted text-capitalize">{{ Auth::user()->role }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/' . Auth::user()->role . '/dashboard') }}">
                                        <i class='bx bxs-dashboard me-2'></i>
                                        <span class="align-middle">Dashboard</span>
                                    </a>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ url('/logout') }}">
                                        <i class="menu-icon tf-icons bx bx-log-out"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                @else
                    <a href="{{ url('/login') }}"><button class="btn btn-outline-primary"
                            type="button">Login/Register</button></a>
                @endif
                <div class="gtranslate_wrapper"></div>
                <script>
                    window.gtranslateSettings = {
                        "default_language": "en",
                        "native_language_names": true,
                        "languages": ["en", "ne", "es", "fr", "zh-TW", "de", "ar", "hi"],
                        "wrapper_selector": ".gtranslate_wrapper",
                        "switcher_horizontal_position": "right",
                        "switcher_vertical_position": "bottom",
                        "flag_style": "3d"
                    }
                </script>
                <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

            </div>
        </div>
    </div>
</nav>
