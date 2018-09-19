<!-- Navbar-->
<header class="app-header">
  <a class="app-header__logo" href="{{ route('admin.dashboard') }}"><i>RMT</i></a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <li class="nav-link">
    <a href="{{ route('index') }}" class="text-view" target="_blank"><i class="fa fa-fw fa-eye"></i> View Site</a>
  </li>

  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    <!-- User Menu-->
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        {{-- <li><a class="dropdown-item" href="{{ route('admin.changePassword') }}"><i class="fa fa-cog fa-lg"></i> Change Password</a></li> --}}
        <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </li>
  </ul>
</header>
