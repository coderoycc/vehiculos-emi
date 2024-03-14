<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Usuarios</title>
  @include('partials.header_imports')
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
    integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body>
  @include('partials.nav')

  <div class="container mt-4">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="lista-user-tab" data-bs-toggle="pill" data-bs-target="#lista-user"
          type="button" role="tab" aria-controls="lista-user" aria-selected="true"><i
            class="fa fa-sold fa-table"></i> Lista</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="user-new-tab" data-bs-toggle="pill" data-bs-target="#user-new" type="button"
          role="tab" aria-controls="user-new" aria-selected="false"><i class="fa fa-solid fa-user-plus"></i> Agregar
          nuevo</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="lista-user" role="tabpanel" aria-labelledby="lista-user-tab"
        tabindex="0">
        <table style="width:100%" class="table table-hover" id="table_users">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">NOMBRE</th>
              <th class="text-center">USUARIO</th>
              <th class="text-center">ROL</th>
              <th class="text-center">CI</th>
              <th class="text-center">OPCIONES</th>
          </thead>
          <tbody id="t_body_users"></tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="user-new" role="tabpanel" aria-labelledby="user-new-tab" tabindex="0">
        <form id="form_create">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="Nombre" name="nombre" placeholder="Nombre completo"
                  required>
                <label for="Nombre">Nombre</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" required>
                <label for="Usuario">Usuario</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-2">
                <select class="form-select" name="rol" required>
                  <option value="">-- Seleccione --</option>
                  <option value="ADMIN">ADMIN</option>
                  <option value="GUARDIA">GUARDIA</option>
                </select>
                <label for="tipo">Rol</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="ci" name="ci" placeholder="ci">
                <label for="detalle">CI</label>
              </div>
            </div>
          </div>
          <button class="btn btn-success float-end mt-2" type="submit"><i class="fa fa-solid fa-floppy-disk"></i>
            Guardar</button>
        </form>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        ...</div>
    </div>
  </div>
  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/users.js') }}"></script>
</body>

</html>
