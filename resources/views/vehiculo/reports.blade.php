<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reportes</title>
  @include('partials.header_imports')
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/jquery/jqueryToast.min.css') }}">
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
    integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  <link rel="stylesheet" href="{{ asset('assets/charjs/Chart.min.css') }}" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script>
  <style>
    .small-box {
      border-radius: .25rem;
      box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
      display: block;
      margin-bottom: 40px;
      position: relative;
      padding-bottom: 10px;
    }

    .small-box>.inner {
      padding: 10px;
    }

    .small-box .icon {
      color: rgba(0, 0, 0, .15);
    }

    /* .small-box:hover .icon>svg,
    .small-box:hover .icon>svg.svg-inline--fa {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    } */

    .small-box .icon.left>svg {
      transform: rotateY(180deg);
    }

    .small-box .icon>svg {
      font-size: 90px;
      position: absolute;
      right: 15px;
      top: 15px;
    }
  </style>
</head>

<body>
  @include('partials.nav')
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="fs-4 text-secondary mb-3">Vehículos ingresos salidas HOY</div>
            <div class="row">
              <div class="col-md-6">
                <div class="small-box bg-success">
                  <div class="inner" style="color:var(--bs-success-bg-subtle)">
                    <h2>{{ $cantidades['ingreso'] }}</h2>
                    <p class="fw-semibold">INGRESOS</p>
                  </div>
                  <div class="icon">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="small-box bg-warning">
                  <div class="inner" style="color:var(--bs-warning-bg-subtle)">
                    <h2>{{ $cantidades['salida'] }}</h2>
                    <p class="fw-semibold">SALIDAS</p>
                  </div>
                  <div class="icon left">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="fs-3 fw-semibold"><i class="fa-regular fa-chart-bar"></i> Filtros para generar reporte</div>
        <form id="form_filters" action="/panel/reports/main" method="GET" target="_blank">
          <div class="row">
            <div class="col-md-5">
              <div class="form-floating">
                <input type="date" class="form-control" name="start" id="date_inicio" placeholder="Inicio"
                  value="{{ date('Y-m-d') }}">
                <label for="date_inicio">Fecha Inicio</label>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-floating">
                <input type="date" class="form-control" name="end" id="end_date" placeholder="Final"
                  value="{{ date('Y-m-d') }}">
                <label for="end_date">Fecha Final</label>
              </div>
            </div>
            <div class="col-md-2 d-flex align-items-center">
              <div class="">
                <button class="btn btn-outline-success" type="submit"><i
                    class="fa-lg fa-solid fa-magnifying-glass-chart"></i> Generar</button>
              </div>
            </div>
          </div>
        </form>
        {{-- <a href="/panel/reports/day" class="btn btn-lg btn-outline-primary " target="_blank">Lista de vehiculos HOY</a> --}}
      </div>
      {{-- <div class="col-md-6">
        <a href="/panel/reports/all" class="btn btn-lg btn-outline-primary " target="_blank">Lista de vehiculos
          ANUAL</a>
      </div> --}}
    </div>
  </div>


  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/charjs/Chart.min.js') }}"></script>
  {{-- <script src="{{ asset('js/vehiculo.js') }}"></script> --}}
</body>

</html>
