<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vehículos</title>
  @include('partials.header_imports')
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/jquery/jqueryToast.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
    integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body>
  @include('partials.nav')

  <div class="container mt-4">
    <div class="fs-4 text-secondary"><i class="fa-solid fa-car-side"></i> Nuevo Vehículo</div>
    <form id="form_create" action="/panel/vehiculo/create" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="placa" name="placa" placeholder="placa completo">
            <label for="placa">Placa</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="color" name="color" placeholder="Color">
            <label for="color">Color</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
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
          <div class="form-floating mb-3">
            <input type="hidden" name="idPersona" value="{{$persona->id}}">
            <input type="text" class="form-control" value="{{strtoupper($persona->nombre)}}" readonly disabled>
            <label for="idPersona">Propietario (Persona)</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="detalle" name="detalle" placeholder="detalle">
            <label for="detalle">Detalle (opcional)</label>
          </div>
        </div>
      </div>
      <div class="fs-4">Documentos</div>
      <div class="row">
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">Documentación</label>
            <input class="form-control" name="doc" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">C.I.</label>
            <input class="form-control" name="ci" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">Licencia</label>
            <input class="form-control" name="lice" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">RUAT</label>
            <input class="form-control" name="ruat" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">SOAT</label>
            <input class="form-control" name="soat" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">Inspección vehicular</label>
            <input class="form-control" name="insp" type="file" accept="application/pdf" required>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
            <label for="formFile" class="form-label">Imagen del vehículo</label>
            <input class="form-control" name="img" type="file" accept="image/jpeg, image/png" required>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-secondary mt-2 float-start" onclick="history.back()"><i class="fa-lg fa-solid fa-arrow-left"></i> Volver</button>
      <button class="btn btn-success float-end mt-2" type="submit"><i class="fa fa-solid fa-floppy-disk"></i>
        Guardar</button>
    </form>
  </div>
  @if (session('error_create'))
    <script>
      $.toast({
        heading: 'Error',
        icon: 'error',
        text: 'Ocurrió un error al guardar',
        showHideTransition: 'slide',
        position: 'top-right',
        hideAfter: 3000
      })
    </script>
  @endif
  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/add_vehiculo.js') }}"></script>
</body>

</html>
