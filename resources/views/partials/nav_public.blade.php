<style>
  .nav-link.text-white.active {
    text-decoration: underline;
  }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color:#174287;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('images/logo_emi0.png') }}" width="55">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" data-page="misvehiculos" aria-current="page"
            href="{{ route('listavehiculos') }}">Mis
            vehículos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" data-page="generarqr" href="{{ route('generarqr') }}">Generar QR</a>
        </li>
      </ul>
      <div>
        <form method="POST" action="{{ route('logout_public') }}">
          @csrf
          <button class="btn btn-danger" type="submit"><i class="fa fa-sign-out"></i></button>
        </form>
      </div>
    </div>
  </div>
</nav>
<script>
  $(document).ready(() => {
    var path = window.location.pathname.split("/").pop();
    if (path == "") {
      path = "misvehiculos";
    }
    console.log(path)
    var target = $(`a[data-page="${path}"]`);
    target.addClass("active");
  });
</script>
