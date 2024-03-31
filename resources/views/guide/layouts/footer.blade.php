<script>
    document.querySelectorAll(".menu-link").forEach((link) => {
        if (link.href === window.location.href) {
            link.parentNode.classList.add("active", "open");

            link.setAttribute("aria-current", "page");
        }
    });
</script>

<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@stack('script')
