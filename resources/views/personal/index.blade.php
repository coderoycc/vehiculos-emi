<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Personal</title>
  @include('partials.header_imports')
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body>
  @include('partials.nav')
  <div class="container mt-4">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
          type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i
            class="fa fa-sold fa-table"></i> Lista</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="user-new-tab" data-bs-toggle="pill" data-bs-target="#user-new" type="button"
          role="tab" aria-controls="user-new" aria-selected="false"><i class="fa fa-solid fa-user-plus"></i> Agregar
          nuevo</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
          type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <table class="table table-striped" id="table_personal">

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
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        ...</div>
    </div>
  </div>

  <script src="{{ asset('js/personal.js') }}"></script>
</body>

</html>
