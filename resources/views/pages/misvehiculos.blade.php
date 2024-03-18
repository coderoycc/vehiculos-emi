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

    .btn {
      background: #EEECF7;
      border: 0;
      color: #174287;
      width: 98%;
      font-weight: bold;
      border-radius: 20px;
      height: 40px;
      transition: all 0.2s ease;
    }

    .btn.btn-danger:hover {
      background: var(--bs-danger)
    }

    .btn:hover {
      background: #174287;
    }

    .btn:focus {
      background: #174287;
      outline: 0;
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
              <a href="" target="_blank" class="btn btn-primary mb-1 mt-1 ">Generar QR</a>
              <a href="" target="_blank" class="btn btn-primary mb-1 mt-1 ">Generar QR</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</body>

</html>
