<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}"><b>
        RateMyTeachers</b>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        <li><a href="{{ route('teacher') }}"><b>Teachers</b></a></li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guard('student')->check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::guard('student')->user()->name }}
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('student.logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @else
          <li><a href="{{ route('student.login') }}"><b>Login</b></a></li>
          <li><a href="{{ route('student.register') }}"><b>Register</b></a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>
