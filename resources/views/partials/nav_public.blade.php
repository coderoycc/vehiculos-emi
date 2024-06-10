<style>
  .nav-link.text-white.active {
    text-decoration: underline;
  }

  @media (max-width: 990px) {
    .btn.btn-danger.btn-custom::after {
      font-weight: bold;
      width:130px !important;
      content: " SALIR ";
    }
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
          <a class="nav-link text-white" data-page="seguimiento" href="{{ route('seguimiento') }}">Seguimiento</a>
        </li>
      </ul>
      <div class="d-flex gap-2">
        <button class="btn btn-secondary rounded-circle" title="CAMBIAR CONTRASEÑA" type="button" data-bs-toggle="modal" data-bs-target="#modal_change_pass"><i class="fa-lg fa-solid fa-lock"></i></button>
        <form id="form_logout" method="POST" action="{{ route('logout_public') }}">
          @csrf
          <button class="btn btn-danger btn-custom" type="submit" title="SALIR" id="form_logout_btn"><i
              class="fa fa-sign-out"></i></button>
        </form>
      </div>
    </div>
  </div>
</nav>

{{-- Modal change pass --}}
<div class="modal modal-sm fade" id="modal_change_pass" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5" >Cambiar tu contraseña</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @csrf
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="pass" placeholder="Password">
          <label for="pass">Contraseña actual</label>
        </div>

        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="new" placeholder="New Password">
          <label for="new">Nueva contraseña</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="change_pass()">Cambiar</button>
      </div>
    </div>
  </div>
</div>


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
  $(document).on('submit', '#form_logout', () => {
    $('#form_logout_btn').attr('disabled', true)
  })
  async function change_pass(){
    const pass = $("#pass").val();
    const new_ = $("#new").val();
    const _token = $("input[name='_token']").val()
    if(pass != "" && new_ != ""){
      const res = await $.ajax({
        url: '/personal/change_pass',
        type: 'POST',
        dataType: 'json',
        data: { pass, new: new_, _token }
      });
      if(res.success){
        toast('Operación exitosa', 'Contraseña cambiada', 'success', 2700);
        $("#modal_change_pass").modal('hide')
      }else{
        toast('Fallo en la operación', res.message, 'error', 3000);
      }
    }else{
      toast('Llene ambos campos', '', 'warning', 2700);
    }
  }
  function toast(title, text, icon, time = 2500){
    $.toast({
      heading: title,
      icon, text,
      showHideTransition: 'slide',
      position: 'top-right',
      hideAfter: time
    });
  }
</script>
