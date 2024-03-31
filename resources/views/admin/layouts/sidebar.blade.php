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
            <a href="{{ url('/admin/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Guide">Guide</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('/admin/guide/create') }}" class="menu-link">
                        <div data-i18n="Add Guide">Add Guide</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/admin/guide') }}" class="menu-link">
                        <div data-i18n="View Guide">View Guide</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ url('/admin/guides/pending') }}" class="menu-link">
                        <div data-i18n="Verify Guide">Verify Guide</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-universal-access"></i>
                <div data-i18n="Trouist">Trouist</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('/admin/tourist') }}" class="menu-link">
                        <div data-i18n="View Guide">View Tourist</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="{{ url('/admin/reviews') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-star"></i>
                <div data-i18n="Reviews">Reviews</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-location-plus"></i>
                <div data-i18n="Destinations">Destinations</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('/admin/destinations/create') }}" class="menu-link">
                        <div data-i18n="Add Destination">Add Destination</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/admin/destinations') }}" class="menu-link">
                        <div data-i18n="View Destination">View Destination</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-text"></i>
                <div data-i18n="Language">Language</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('/admin/language/create') }}" class="menu-link">
                        <div data-i18n="Add Language">Add Language</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/admin/language') }}" class="menu-link">
                        <div data-i18n="View Language">View Language</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="{{ url('/admin/bookings') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Booking">Booking</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <li class="menu-item">
            <a href="{{ url('/' . Auth::user()->role . '/update-password') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lock"></i>
                <div data-i18n="Basic">Update Password</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ url('/logout') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Basic">Logout</div>
            </a>
        </li>
    </ul>
</aside>
