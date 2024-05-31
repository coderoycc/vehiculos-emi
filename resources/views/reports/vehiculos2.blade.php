<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte</title>
  @include('partials.header_imports')
  {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <script src="{{ asset('js/custom.js') }}"></script> --}}
</head>

<body>
  <h1 class="text-center">Reporte Ingreso de vehículos</h1>
  <div class="container w-100" id="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Vehículo</th>
          <th>Placa</th>
          <th>Color</th>
          <th>Propietario</th>
          <th>C.I.</th>
          <th>Fecha hora ingreso</th>
        </tr>
      </thead>
      <tbody>
        @if (count($vehiculosIn) == 0)
          <tr>
            <td colspan="6" class="text-center">Sin vehículos</td>
          </tr>
        @endif
        @foreach ($vehiculosIn as $vin)
          <tr>
            <td> {{ $vin->vehiculo->tipo }} </td>
            <td>{{ $vin->vehiculo->placa }}</td>
            <td>{{ $vin->vehiculo->color }}</td>
            <td>{{ $vin->propietario->nombre }}</td>
            <td>{{ $vin->propietario->ci }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($vin->fechaRegistro)) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <br><br>
  <h1 class="text-center">Reporte Salida de vehículos</h1>
  <div class="container w-100" id="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Vehículo</th>
          <th>Placa</th>
          <th>Color</th>
          <th>Propietario</th>
          <th>C.I.</th>
          <th>Fecha hora ingreso</th>
        </tr>
      </thead>
      <tbody>
        @if (count($vehiculosOut) == 0)
          <tr>
            <td colspan="6" class="text-center">Sin vehículos</td>
          </tr>
        @endif
        @foreach ($vehiculosOut as $vout)
          <tr>
            <td> {{ $vout->vehiculo->tipo }} </td>
            <td>{{ $vout->vehiculo->placa }}</td>
            <td>{{ $vout->vehiculo->color }}</td>
            <td>{{ $vout->propietario->nombre }}</td>
            <td>{{ $vout->propietario->ci }}</td>
            <td>{{ date('d/m/Y H:i', strtotime($vout->fechaRegistro)) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>

</html>
