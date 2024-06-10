<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vehiculos</title>
  @include('partials.header_imports')
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/jquery/jqueryToast.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
    integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</head>

<body>
  @include('partials.nav')
  <div class="container mt-4">
    <div class="row d-flex w-100 justify-content-center">
      <div class="my-3" style="width:130px;">
        <a href="/panel/personal" class="btn btn-secondary"><i class="fa-lg fa-solid fa-chevron-left"></i> Volver</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mt-2">
        <div class="card shadow">
          <div class="card-body">
            <div class="fs-3 text-secondary">Vehículos del usuario: </div>
            <hr>
            <div class="fs-5 text-secondary fw-semibold">{{ strtoupper($persona->nombre) }}</div>
            <div class="fs-5 text-secondary">{{ $persona->celular }}</div>
          </div>
          <div class="card-footer mx-auto">
            <a class="btn btn-primary" href="/panel/vehiculo?id={{$persona->id}}"><i class="fa-lg fa fa-solid fa-plus"></i> Agregar nuevo vehículo</a>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> --- </th>
                <th class="text-center">PLACA</th>
                <th class="text-center">COLOR</th>
                <th class="text-center">TIPO</th>
                <th class="text-center">DETALLE</th>
                <th class="text-center">OPCIONES</th>
              </tr>
            </thead>
            <tbody>
              @if (count($vehiculos) == 0)
                <tr>
                  <td colspan="5" class="text-center">Este usuario no tiene vehículos registrados</td>
                </tr>
              @endif
              @foreach ($vehiculos as $vehiculo)
                <?php
                $docs = $vehiculo->docs ?? '[]';
                $url = json_decode($docs, true);
                $url = !isset($url['img']) ? 'images/auto.png' : 'storage/vehiculos/' . $url['img'];
                ?>
                <tr>
                  <td>
                    <div>
                      <img src="{{ asset($url) }}" width="80" />
                    </div>
                  </td>
                  <td class="text-center">{{ $vehiculo->placa }}</td>
                  <td class="text-center">{{ $vehiculo->color }}</td>
                  <td class="text-center">{{ $vehiculo->tipo }}</td>
                  <td class="text-center">{{ $vehiculo->detalle }}</td>
                  <td class="text-center">
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary" title="EDITAR" data-bs-toggle="modal"
                        data-bs-target="#edit_vehiculo" data-id={{ $vehiculo->id }}><i
                          class="fa-lg fa-solid fa-pen-to-square"></i></button>
                      <button type="button" class="btn btn-info" title="DOCUMENTOS" data-bs-toggle="modal"
                        data-bs-target="#docs_vehiculo" data-id={{ $vehiculo->id }}><i
                          class="fa-lg fa-regular fa-folder-open"></i></button>
                      @if ($vehiculo->habilitado == 'SI')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_baja_alta"
                          data-si="{{ $vehiculo->habilitado }}" class="btn btn-danger" data-id="{{ $vehiculo->id }}">
                          DAR DE BAJA</button>
                      @else
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal_baja_alta"
                          class="btn btn-success" data-si="{{ $vehiculo->habilitado }}" data-id="{{ $vehiculo->id }}">
                          DAR DE ALTA</button>
                      @endif
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Editar Vehiculo --}}
  <div class="modal fade" id="edit_vehiculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Editar vehículo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal_edit_vehiculo_data"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="editSave()">Guardar
            cambios</button>
        </div>
      </div>
    </div>
  </div>


  {{-- MODAL Dar BAJA ALTA --}}
  <div class="modal fade" id="modal_baja_alta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="header_modal_baja_alta">
          <h1 class="modal-title fs-5 text-center"></h1>
          <input type="hidden" id="baja_alta_id" value="">
          <input type="hidden" id="baja_alta_val" value="">
          @csrf
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="baja_alta()">
            Sí, continuar</button>
        </div>
      </div>
    </div>
  </div>

  @if (session('success_create'))
    <script>
      $.toast({
        heading: 'Proceso exitoso',
        icon: 'success',
        text: 'Vehículo guardado con exito',
        showHideTransition: 'slide',
        position: 'top-right',
        hideAfter: 2300
      })
    </script>
  @endif
  {{-- MODAL VER DOCUMENTOS --}}
  <div class="modal fade" id="docs_vehiculo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center">Documentos del vehículo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row" id="docs_modal_content"></div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('assets/datatables/datatables.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/datatables/datatables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('assets/jquery/jqueryToast.min.js') }}"></script>
  <script src="{{ asset('js/vehiculo.js') }}"></script>
  <script src="{{asset('assets/sweetalert2/sweetalert2.min.js')}}"></script>
</body>

</html>
