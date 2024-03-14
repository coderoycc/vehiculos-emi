<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vehículos</title>
  @include('partials.header_imports')
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
          role="tab" aria-controls="user-new" aria-selected="false"><i class="fa fa-solid fa-car"></i> Agregar
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
              <th class="text-center">TIPO</th>
              <th class="text-center">COLOR</th>
              <th class="text-center">PLACA</th>
              <th class="text-center">MODELO</th>
              <th class="text-center">PROPIETARIO</th>
              <th class="text-center">OPCIONES</th>
          </thead>
          <tbody id="t_body_personal"></tbody>
        </table>
      </div>
      <div class="tab-pane fade" id="user-new" role="tabpanel" aria-labelledby="user-new-tab" tabindex="0">
        <form id="form_create">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="placa" name="placa" placeholder="placa completo">
                <label for="placa">Placa</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="color" name="color"
                  placeholder="Color">
                <label for="color">Color</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <select class="form-select" name="tipo">
                  <option value="">-- Seleccione --</option>
                  <option value="Automóvil">Automóvil</option>
                  <option value="Autobus">Autobus</option>
                  <option value="Camión">Camión</option>
                  <option value="Camioneta">Camioneta</option>
                  <option value="Furgoneta">Furgoneta</option>
                  <option value="Motocicleta">Motocicleta</option>
                  <option value="Vagoneta">Vagoneta</option>
                  <option value="Otro">Otro</option>
                </select>
                <label for="tipo">Tipo</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <select class="form-select" name="idPersona">
                  <option selected>...Seleccionar Propietario...</option>
                </select>
                <label for="idPersona">Propietario (Persona)</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="detalle" name="detalle" placeholder="detalle">
                <label for="detalle">Detalle (opcional)</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="cargo" name="cargo" placeholder="cargo">
                <label for="cargo">Cargo</label>
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
  <script src="{{asset('assets/datatables/datatables.jquery.min.js')}}"></script>
  <script src="{{asset('assets/datatables/datatables.bootstrap5.min.js')}}"></script>
  <script src="{{ asset('js/vehiculo.js') }}"></script>
</body>

</html>
