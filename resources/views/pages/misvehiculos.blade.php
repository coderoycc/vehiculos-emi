<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Personal</title>
  @include('partials.header_imports')
  <style>
    .card {
      border-radius: 40px;
      overflow: hidden;
      border: 0;
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.06),
        0 2px 4px rgba(0, 0, 0, 0.07);
      transition: all 0.15s ease;
    }

    .card:hover {
      box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1),
        0 10px 8px rgba(0, 0, 0, 0.015);
    }

    .card-body .card-title {
      font-family: 'Lato', sans-serif;
      font-weight: 700;
      letter-spacing: 0.3px;
      font-size: 24px;
      color: #121212;
    }

    .card-text {
      font-family: 'Lato', sans-serif;
      font-weight: 400;
      font-size: 15px;
      letter-spacing: 0.3px;
      color: #4E4E4E;

    }

    .card .container {
      width: 88%;
      background: #F0EEF8;
      border-radius: 30px;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container:hover>img {
      transform: scale(1.2);
    }

    .container img {
      padding: 35px;
      margin-top: -40px;
      margin-bottom: -40px;
      transition: 0.4s ease;
      cursor: pointer;
    }

    .btn.btn-custom {
      background: #EEECF7;
      border: 0;
      color: #174287;
      width: 98%;
      font-weight: bold;
      border-radius: 20px;
      height: 40px;
      transition: all 0.2s ease;
    }

    .btn.btn-custom.btn-danger:hover {
      background: var(--bs-danger)
    }

    .btn.btn-custom:hover {
      background: #174287;
      color: #EEECF7;
    }

    .btn.btn-custom:focus {
      background: #174287;
      outline: 0;
    }

    fieldset {
      display: flex;
      justify-content: center;
      min-width: 0 !important;
      padding: 10px !important;
      margin: 0 !important;
      border: 1px solid #e0e0e0;
    }

    /* Estilos para legend */
    legend {
      display: block !important;
      float: none;
      width: auto !important;
      padding: 0 !important;
      margin-bottom: 0.5rem !important;
      font-size: inherit !important;
      line-height: inherit !important;
      color: inherit !important;
    }
  </style>
</head>

<body>
  @include('partials.nav_public')
  <div class="container mt-4">
    <div class="row">
      @foreach ($vehiculos as $vehiculo)
        <div class="col-md-3">
          <div class="animate__animated animate bounce card">
            <div class="container mt-3">
              <img src="{{ asset('images/auto.png') }}" class="card-img-top " alt="vehiculo">
            </div>
            <div class="card-body">
              <h5 class="card-title ms-1 text-center">{{ $vehiculo->placa }}</h5>
              <p class="card-text ms-1"><b>Tipo:</b> {{ $vehiculo->tipo }}</p>
              <p class="card-text mb-3 ms-1"><b>Color:</b> {{ $vehiculo->color }}</p>
              <button target="_blank" type="button" data-bs-toggle="modal" data-bs-target="#modal_generar_qr"
                data-id="{{ $vehiculo->id }}" data-placa="{{ $vehiculo->placa }}"
                class="btn btn-primary mb-1 mt-1 w-100 rounded-pill fw-bold"
                style="background:#174287;border:#174287;">Generar
                QR</button>
              {{-- <button type="button" target="_blank" class="btn btn-secondary btn-custom mb-1 mt-1 ">Listado</button> --}}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @include('pages.modals')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/save-svg-as-png/1.4.17/saveSvgAsPng.min.js" integrity="sha512-vLkvtzbaBvXHQpdTtDT8Gg+vNqXGQ0+vgzoAFzuR6rbQQg+ECaFcjXpTT4EBA46EKACh49lJsBoarn3yYg0S4Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('js/misvehiculos.js') }}"></script>
</body>

</html>
