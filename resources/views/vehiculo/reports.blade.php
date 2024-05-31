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
</head>

<body>
  @include('partials.nav')
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <a href="/panel/reports/day" class="btn btn-lg btn-outline-primary " target="_blank">Lista de vehiculos HOY</a>
      </div>
      <div class="col-md-6">
        <a href="/panel/reports/all" class="btn btn-lg btn-outline-primary " target="_blank">Lista de vehiculos
          ANUAL</a>
      </div>

    </div>
  </div>


  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/charjs/Chart.min.js') }}"></script>
  {{-- <script src="{{ asset('js/vehiculo.js') }}"></script> --}}
</body>

</html>
