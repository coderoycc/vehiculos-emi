<nav class="navbar navbar-expand-custom navbar-mainbg">
  <a class="navbar-brand navbar-logo" href="#">Control acceso</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">
      <div class="hori-selector">
        <div class="left"></div>
        <div class="right"></div>
      </div>
      <li class="nav-item" data-page="vehiculos">
        <a class="nav-link" href="/vehiculo"><i class="fa fa-solid fa-car"></i> Vehículos</a>
      </li>
      <li class="nav-item" data-page="administrador">
        <a class="nav-link" href="/users"><i class="fa fa-solid fa-user-shield"></i> Administradores</a>
      </li>
      <li class="nav-item" data-page="personal">
        <a class="nav-link" href="/personal"><i class="fa fa-solid fa-user"></i> Personal</a>
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
