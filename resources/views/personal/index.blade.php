<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Personal</title>
  @include('partials.header_imports')
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/jquery/jqueryToast.min.css') }}">
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
      {{-- <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
          type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
      </li> --}}
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="lista-user" role="tabpanel" aria-labelledby="lista-user-tab"
        tabindex="0">
        <table style="width:100%" class="table table-hover" id="table_personal">
          <thead>
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">NOMBRE</th>
              <th class="text-center">C.I.</th>
              <th class="text-center">CELULAR</th>
              <th class="text-center">VER VEHÍCULOS</th>
              <th class="text-center">OPCIONES</th>
          </thead>
          <tbody>
            @foreach ($personas as $persona)
              <tr>
                <td class="text-center">{{ $persona->id }}</td>
                <td class="text-center">{{ $persona->nombre }}</td>
                <td class="text-center">{{ $persona->ci }}</td>
                <td class="text-center">{{ $persona->celular }}</td>
                <td class="text-center">
                  <a href="/panel/personal/vehiculo?id={{ $persona->id }}" class="btn btn-info"><i
                      class="fa-lg fa-solid fa-car-side"></i></a>
                </td>
                <td class="text-center">
                  <div class="btn-group" role="group" aria-label="Basic example">
                    {{-- <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal_cars_user"
                      data-iduser="{{ $persona->id }}"><i class="fa fa-solid fa-car"></i></button> --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#modal_edit_user" data-iduser="{{ $persona->id }}"><i
                        class="fa fa-solid fa-pencil"></i></button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                      data-bs-target="#modal_delete_user" data-iduser="{{ $persona->id }}"><i
                        class="fa fa-soli fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="user-new" role="tabpanel" aria-labelledby="user-new-tab" tabindex="0">
        <form id="form_create">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo">
                <label for="nombre">Nombre completo</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="ci" name="ci"
                  placeholder="Carnet de identidad">
                <label for="ci">Carnet de identidad</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="celular" name="celular" placeholder="Celular">
                <label for="celular">Celular (opcional)</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="cargo" name="cargo" placeholder="cargo">
                <label for="cargo">Cargo</label>
              </div>
            </div>
          </div>
          <button class="btn btn-success float-end" type="submit"><i class="fa fa-solid fa-floppy-disk"></i>
            Guardar</button>
        </form>
      </div>
    </div>
  </div>

  {{-- Modal  vehiculos del usuario --}}
  <div class="modal fade" id="modal_cars_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Vehículos del usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_cars_user_content"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal  editar usuario --}}
  <div class="modal fade" id="modal_edit_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h1 class="modal-title fs-5">Editar usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_edit_user_content"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
            onclick="saveEdit()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal delete user --}}
  <div class="modal fade" id="modal_delete_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h1 class="modal-title fs-5">¿Eliminar al usuario?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger">
            También <b>se eliminaran los vehículos</b> asociados a este usuario
          </div>
          <form id="delete_user_form" onsubmit="return false;">
            @csrf
            <input type="hidden" name="user_id" id="user_id_delete" value="">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="deleteUser()">Sí,
            eliminar</button>
        </div>
      </div>
    </div>
  </div>
  @if (session('success_create'))
    <script>
      $.toast({
        heading: 'Proceso exitoso',
        icon: 'success',
        text: 'Vehículo guardado con exito',
        showHideTransition: 'slide',
        position: 'top-right',
        hideAfter: 2300
      })
    </script>
  @endif
  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script src="{{ asset('js/personal.js') }}"></script>
</body>

</html>
