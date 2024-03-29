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
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="{{ url('/') }}">Home</a>
                <a class="nav-item nav-link" href="{{ url('/destinations') }}">Destination</a>
                <a class="nav-item nav-link" href="{{ url('/guides') }}">Guide</a>
                <a class="nav-item nav-link" href="{{ url('/') }}">About</a>
                <a class="nav-item nav-link" href="{{ url('/') }}">Contact</a>&nbsp;&nbsp;&nbsp;
                @if (auth()->check())
                    <a class="nav-item nav-link" href="{{ url('/') }}">{{ auth()->user()->role }}</a>
                    <a href="{{ url('/logout') }}"><button class="btn btn-outline-primary"
                            type="button">Logout</button></a>
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
