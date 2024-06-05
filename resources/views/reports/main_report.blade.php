<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Reporte</title>
  <style>
    .text-center {
      text-align: center;
    }

    .text-end {
      text-align: right;
    }

    .text-start {
      text-align: left;
    }

    .m-0 {
      margin: 0px;
    }

    .mt-0 {
      margin-top: 0px;
    }

    .mb-0 {
      margin-bottom: 0px;
    }

    .fw-bold {
      font-weight: bold;
    }

    .text-muted {
      color: #6c757d;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
      color: #212529;
      vertical-align: top;
      border-left: 1px solid #d0d0d0;
      border-right: 1px solid #d0d0d0;
    }

    .table .header {
      background-color: #ddd;
    }

    .table tr>th {
      padding: 10px;
    }

    .table td {
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
    }

    .table tr>td {
      padding: 8px 8px;
    }

    .w-80x {
      width: 80px;
    }

    .h-30x {
      height: 30px;
    }

    .h-80x {
      height: 80px;
    }
  </style>

</head>

<body class="m-0">
  <h2 class="text-center fw-bold mb-0">REPORTE INGRESOS Y SALIDAS DE VEHICULOS</h2>
  <h4 class="text-center text-muted mt-0">Desde {{ date('d/m/Y', strtotime($start)) }} hasta
    {{ date('d/m/Y', strtotime($end)) }}</h4>
  {{-- <pre>
    {{ $vehiculosIn }}
  </pre> --}}
  <table class="table">
    <tr>
      <td colspan="5" class="text-center header">INGRESO DE VEHÍCULOS</td>
      <td class="text-end header">Cantidad: <b>{{ count($vehiculosIn) }}</b></td>
    </tr>
    <tr class="text-center">
      <th>VEHÍCULO</th>
      <th class="w-80x">PLACA</th>
      <th>COLOR</th>
      <th>PROPIETARIO</th>
      <th>C.I.</th>
      <th>FECHA HORA INGRESO</th>
    </tr>
    @if (count($vehiculosIn) == 0)
      <tr>
        <td colspan="6" class="text-center">Sin ingreso de vehículos para el rango de fechas</td>
      </tr>
    @endif
    @foreach ($vehiculosIn as $vin)
      <tr>
        <td> {{ $vin->vehiculo->tipo }} </td>
        <td class="w-80x">{{ $vin->vehiculo->placa }}</td>
        <td>{{ $vin->vehiculo->color }}</td>
        <td>{{ $vin->propietario->nombre }}</td>
        <td>{{ $vin->propietario->ci }}</td>
        <td class="text-end">{{ date('d/m/Y H:i', strtotime($vin->fechaRegistro)) }}</td>
      </tr>
    @endforeach
  </table>
  <div class="h-30x"></div>
  <table class="table">
    <tr>
      <td colspan="5" class="text-center header">SALIDA DE VEHÍCULOS</td>
      <td class="text-end header">Cantidad: <b>{{ count($vehiculosOut) }}</b></td>
    </tr>
    <tr class="text-center">
      <th>VEHÍCULO</th>
      <th class="w-80x">PLACA</th>
      <th>COLOR</th>
      <th>PROPIETARIO</th>
      <th>C.I.</th>
      <th>FECHA HORA SALIDA</th>
    </tr>
    @if (count($vehiculosOut) == 0)
      <tr>
        <td colspan="6" class="text-center">Sin salida de vehículos para el rango de fechas</td>
      </tr>
    @endif
    @foreach ($vehiculosOut as $vou)
      <tr>
        <td> {{ $vou->vehiculo->tipo }} </td>
        <td class="w-80x">{{ $vou->vehiculo->placa }}</td>
        <td>{{ $vou->vehiculo->color }}</td>
        <td>{{ $vou->propietario->nombre }}</td>
        <td>{{ $vou->propietario->ci }}</td>
        <td class="text-end">{{ date('d/m/Y H:i', strtotime($vou->fechaRegistro)) }}</td>
      </tr>
    @endforeach
  </table>
</body>

</html>
