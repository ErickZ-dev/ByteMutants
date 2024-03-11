  <!-- ================================================= Inicio del Sidebar ================================================= -->
  <?php
      $controlSidebar = array('collapsed', 'collapsed', 'collapsed', 'collapsed');
      $controlSidebar[$p] = '';
   ?>
  <aside id="sidebar" class="bg-trc-oscuro sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <!-- inicio -->
      <li class="nav-item">
        <a class="nav-link bg-dark {{ $controlSidebar[0] }}" href="{{ route('inicio') }}">
          <i class="bi bi-house-door"></i>
          <span>Parcela</span>
        </a>
      </li>

      <!-- arena -->
      <li class="nav-item">
        <a class="nav-link bg-dark {{ $controlSidebar[1] }}" href="{{ route('arena') }}">
          <i class="bi bi-tree"></i><span>Arena</span>
        </a>
      </li>

      <!-- prueba -->
      <li class="nav-item">
        <a class="nav-link bg-dark {{ $controlSidebar[2] }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Tienda</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('tiendaM') }}">
              <i class="bi bi-circle"></i><span>Mutantes</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Parcelas</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>accesorios</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">usuario</li>

      <!-- Configuraciones -->
      <li class="nav-item">
        <a class="nav-link bg-dark {{ $controlSidebar[3] }}" href="{{ route('configuraciones') }}">
          <i class="bi bi-gear"></i>
          <span>Configuraciones</span>
        </a>
      </li>

      <!-- Salir -->
      <li class="nav-item">
        <a class="nav-link bg-dark collapsed" href="{{ route('salir') }}">
          <i class="bi bi-box-arrow-left"></i>
          <span>Salir</span>
        </a>
      </li>
    </ul>

  </aside><!-- End Sidebar-->
