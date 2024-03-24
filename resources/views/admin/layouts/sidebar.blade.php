<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mt-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <img src="{{ asset('assets/img/logo.png') }}" class="w-100" alt="Local Nepal">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-4">
        <!-- Dashboards -->
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
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
                    <a href="{{url('/admin/guides/pending')}}" class="menu-link">
                        <div data-i18n="Verify Guide">Verify Guide</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Trouist">Trouist</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{url('/admin/tourist')}}" class="menu-link">
                        <div data-i18n="View Guide">View Tourist</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Messages">Messages</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Reviews">Reviews</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Destinations">Destinations</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Add Destination">Add Destination</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="View Destination">View Destination</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Booking">Booking</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Apps &amp; Pages</span>
        </li>
        <!-- Apps -->
        <!-- Pages -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-account-settings-account.html" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-notifications.html" class="menu-link">
                        <div data-i18n="Notifications">Notifications</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-account-settings-connections.html" class="menu-link">
                        <div data-i18n="Connections">Connections</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Profile</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="cards-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Logout</div>
            </a>
        </li>
    </ul>
</aside>
