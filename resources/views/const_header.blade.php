  <!-- ================================================= inicio del Header ======================================================== -->
  <header id="header" class="header fixed-top d-flex align-items-center navbar-dark bg-dark">

    <!-- cabecera Logo -->
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ route('inicio') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">Byte Mutants</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <!-- cromex -->
        <li class="nav-item pe-3">
          <a class="nav-link nav-profile d-flex align-items-center" href="#">
            <img src="{{ asset('img/cromex.png') }}" alt="Profile" class="">
            <span class="d-none d-md-block ps-2">{{ $usuario->cromens }}</span>
          </a>
        </li>

        <!-- esmopins -->
        <li class="nav-item pe-3">
          <a class="nav-link nav-profile d-flex align-items-center" href="#">
            <img src="{{ asset('img/smopin.png') }}" alt="Profile" class="">
            <span class="d-none d-md-block ps-2">{{ $usuario->esmopins }}</span>
          </a>
        </li>

        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (!$usuario->foto) <img src="{{ asset('img/usuarion.jpg') }}" alt="Profile" class="rounded-circle">
            @else <img src="{{ asset('img/usuarios/'.$usuario->foto) }}" alt="Profile" class="rounded-circle img-heder">
            @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ $usuario->nombre }}</span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-dark">
            <li class="dropdown-header">
              <h6>{{ $usuario->nombre }}</h6>
              <span>nivel {{ $usuario->nivel }}</span>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item active" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('salir') }}">salir</a></li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header>
