@include('guide.layouts.header')

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('guide.layouts.sidebar')
            <div class="layout-page">
                @include('guide.layouts.navbar')

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
    @include('guide.layouts.footer')
</body>

</html>
