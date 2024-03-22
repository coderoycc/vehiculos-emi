<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seguimiento</title>
  @include('partials.header_imports')
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <style>
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
      background: var(--bs-danger);
      color: #EEECF7;
    }
  </style>
</head>

<body>
  @include('partials.nav_public')
  <div class="container mt-3">
    <div class="table-responsive">
      <table class="table table-striped w-100" id="t_seguimiento">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">PLACA</th>
            <th class="text-center">GENERADO</th>
            <th class="text-center">VIGENCIA</th>
            <th class="text-center">ESTADO</th>
            <th class="text-center">VER QR</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($registros as $registro)
            <tr>
              <td class="text-center">{{ $registro->id }}</td>
              <td class="text-center">{{ $registro->vehiculo->placa }}</td>
              <td>{{ date('d/m/Y H:i:s', strtotime($registro->fechaGenerado)) }}</td>
              <td class="text-center">
                {{ date('d/m/Y H:i:s', strtotime($registro->fechaVencimiento)) }}
                @if (strtotime(date('Y-m-d H:i:s')) > strtotime($registro->fechaVencimiento))
                  &nbsp;<span class="badge rounded-pill text-bg-secondary">Vencido</span>
                @endif
              </td>
              @if ($registro->usado)
                <td class="text-center"><span class="badge text-bg-success">Usado</span></td>
              @else
                <td class="text-center"><span class="badge text-bg-danger">Sin usar</span></td>
              @endif
              <td class="text-center">
                <button class="btn btn-primary" onclick="generarqr({{ $registro->id }})">
                  <i class="fa fa-solid fa-qrcode"></i>
                  Ver QR
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('pages.modals')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/save-svg-as-png/1.4.17/saveSvgAsPng.min.js"
    integrity="sha512-vLkvtzbaBvXHQpdTtDT8Gg+vNqXGQ0+vgzoAFzuR6rbQQg+ECaFcjXpTT4EBA46EKACh49lJsBoarn3yYg0S4Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/misvehiculos.js') }}"></script>
  <script>
    const lenguaje = {
      processing: "Procesando...",
      search: "Buscar en la tabla",
      lengthMenu: "Mostrar  _MENU_ filas ",
      paginate: {
        first: "Primero",
        previous: "Ant.",
        next: "Sig.",
        last: "Último",
      },
      emptyTable: "No hay registros...",
      infoEmpty: "No hay resultados",
      zeroRecords: "No hay registros...",
    };
    $("#t_seguimiento").DataTable({
      language: lenguaje,
      info: false,
      scrollX: true,
      columnDefs: [{
        orderable: false,
        // targets: [5, 7]
      }],
    })
  </script>
</body>

</html>
