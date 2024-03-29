<script>
    document.querySelectorAll(".menu-link").forEach((link) => {
        if (link.href === window.location.href) {
            link.parentNode.classList.add("active", "open");
            if (link.parentNode.parentNode.classList.contains("menu-sub")) {
                link.parentNode.parentNode.parentNode.classList.add("active", "open");
            }
            link.setAttribute("aria-current", "page");
        }
    });
</script>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
{{-- <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script> --}}
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- page js --}}
{{-- <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/chat.js') }}"></script> --}}
@stack('script')
