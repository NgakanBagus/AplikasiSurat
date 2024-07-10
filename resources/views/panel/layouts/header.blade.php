<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('panel/dashboard') }}" class="logo d-flex align-items-center">
        <img src="{{ url('') }}/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Sistem Desa</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block ps-2" style="padding-right: 10px">{{ Auth::user()->name }}</span>
            <img src="{{ url('') }}/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </a>
            </li>
          </ul>
          
        </li>

      </ul>
    </nav>

  </header>