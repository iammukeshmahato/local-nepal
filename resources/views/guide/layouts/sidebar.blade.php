<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mt-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2" target="_blank"> <img
                src="{{ asset('assets/img/logo.png') }}" class="w-100" alt="Local Nepal"> </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-4">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ url('/' . Auth::user()->role . '/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboard</div>
            </a>
        </li>
        @php
            $guide = DB::table('guides')
                ->where('user_id', Auth::user()->id)
                ->first();
        @endphp

        @if (isset($guide) && $guide->status == 'active')
            <li class="menu-item">
                <a href="{{ url('/guide/messages') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bx-chat'></i>
                    <div data-i18n="Messages">Messages</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ url('/guide/reviews') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-star"></i>
                    <div data-i18n="Reviews">Reviews</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ url('/guide/bookings') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Booking">Booking</div>
                </a>
            </li>
        @endif
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        @if (isset($guide) || isset($tourist))
            <li class="menu-item">
                <a href="{{ url('/' . Auth::user()->role . '/profile') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Basic">Profile</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/' . Auth::user()->role . '/update-password') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock"></i>
                    <div data-i18n="Basic">Update Password</div>
                </a>
            </li>
        @endif

        <li class="menu-item">
            <a href="{{ url('/logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Basic">Logout</div>
            </a>
        </li>
    </ul>
</aside>
