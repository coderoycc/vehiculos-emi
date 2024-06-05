<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Perfil</title>
  @include('partials.header_imports')
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
    integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="{{ asset('assets/jquery/jqueryToast.min.css') }}">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body>
  @include('partials.nav')


  <div class="container mt-4">
    <div class="row d-flex justify-content-center">
      <div class="col-md-5">
        <div class="card overflow-hidden">
          <div class="card-body p-0">
            <img src="{{ asset('images/emi.jpg') }}" alt="" style="width:100%;" height="200">
            <div class="row align-items-center">
              <div class="col-lg-12 mt-n3 order-lg-2 order-1">
                <div class="mt-n5">
                  <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                      style="width: 110px; height: 110px;" ;="">
                      <div
                        class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                        style="width: 100px; height: 100px;" ;="">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt=""
                          class="w-100 h-100">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h5 class="fs-5 mb-0 fw-semibold">{{ $user->nombre }}</h5>
                    <p class="mb-0 fs-4">{{ $user->rol }}</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 d-flex justify-content-center">
                <ul
                  class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-3">
                  <li><button class="btn btn-primary" type="button" data-bs-toggle="modal"
                      data-bs-target="#modal_change_my_pass">Cambiar contraseña</button></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- Modal  editar usuario --}}
  <div class="modal fade" id="modal_change_my_pass" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h1 class="modal-title fs-5">Cambiar mi contraseña</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-floating mb-3">
            <input type="password" id="pass" class="form-control" placeholder="Contraseña" />
            <label>Contraseña anterior</label>
          </div>
          <div class="form-floating">
            <input type="password" id="new" class="form-control" placeholder="Contraseña" />
            <label>Nueva contraseña</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
            onclick="change_pass()">Cambiar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script>
    async function change_pass() {
      const pass = $("#pass").val();
      const _new = $("#new").val()
      const _token = $("input[name='_token']").val()
      const res = await $.ajax({
        url: '/panel/users/change_pass',
        data: {
          pass,
          new: _new,
          _token
        },
        type: 'POST',
        dataType: 'json'
      });
      if (res.success) {
        toast('Cambio correcto', 'Contraseña cambiada', 'success', 2500);
      } else {
        toast('Ocurrio un error', res.message, 'error', 3000)
      }
    }
  </script>
</body>

</html>
