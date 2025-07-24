<style>
  .sidebar-logo {
    display: block;
    text-align: center;
    padding: 20px 10px;
    font-size: 22px;
    font-weight: bold;
    color: #ffffff;
    background-color: #2c3e50;
    border-bottom: 2px solid #1abc9c;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
  }

  .sidebar-logo:hover {
    color: #1abc9c;
  }
</style>

<aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
    <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>

  {{-- Logo --}}
  <div>
    <a href="" class="sidebar-logo">
      Admin Panel
    </a>
  </div>

  {{-- Menu --}}
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">

      {{-- Dashboard --}}
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
          <span>Dashboard</span>
        </a>
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

      {{-- Profile Section --}}
      <li class="sidebar-menu-group-title">Profile</li>
<li>
  <a href="{{ route('admin.profile.edit') }}">
    <iconify-icon icon="solar:user-bold" class="menu-icon"></iconify-icon>
    <span>My Profile</span>
  </a>
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
