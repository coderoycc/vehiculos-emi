<nav class="navbar navbar-expand-custom navbar-mainbg">
  <a class="navbar-brand navbar-logo" href="/panel/users/my_profile">
    {{-- <i class="fa-lg fa-brands fa-fort-awesome" title="Mi perfil"></i> --}}
    <img src="{{ asset('images/icon_emi.png') }}" alt="Logo" width="45" />
    CONTROL ACCESO</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">
      <div class="hori-selector d-none">
        <div class="left"></div>
        <div class="right"></div>
      </div>
      @can('isAdmin')
        <li class="nav-item" data-page="administrador">
          <a class="nav-link" href="/panel/users"><i class="fa fa-solid fa-user-shield"></i> Administradores</a>
        </li>
      @endcan
      <li class="nav-item" data-page="personal">
        <a class="nav-link" href="/panel/personal"><i class="fa fa-solid fa-user"></i> Personal</a>
      </li>
      <li class="nav-item" data-page="reports">
        <a class="nav-link" href="/panel/reports"><i class="fa-solid fa-chart-line"></i> Reportes</a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="nav-link" href="javascript:void(0);" id="logout_btn"><i
              class="fa fa-solid fa-right-from-bracket"></i>
            Salir</button>
        </form>
      </li>
    </ul>
  </div>
</nav>
