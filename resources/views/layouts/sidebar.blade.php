<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>

    {{-- Logo --}}
    <div>
        <a href="index.html" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo-light.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>

    {{-- Menu --}}
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">

            {{-- Dashboard --}}
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="index.html"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a>
                    </li>
                </ul>
            </li>

            {{-- Users Section --}}
            <li class="sidebar-menu-group-title">Users</li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>User Management</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('admin.people.create') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Add People
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.people.index') }}">
                            <i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> People List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.change-password.form') }}">
                            <i class="ri-lock-password-line text-primary-600 w-auto"></i> Change Password
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Landing Page Section --}}
            <li class="sidebar-menu-group-title">Pages</li>

            <li>
                <a href="{{ url('/') }}">
                    <iconify-icon icon="solar:map-arrow-right-bold-duotone" class="menu-icon"></iconify-icon>
                    <span>Landing Page</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
