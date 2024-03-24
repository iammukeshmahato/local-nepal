@include('tourist.layouts.header')

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('tourist.layouts.sidebar')
            <div class="layout-page">
                @include('tourist.layouts.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">

                        @yield('main-content')

                    </div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

    </div>
    @include('tourist.layouts.footer')
</body>

</html>
