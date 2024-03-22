{{-- Modal generar QR --}}
<div class="modal fade" id="modal_generar_qr" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog rounded-pill">
    <form id="form_genqr">
      @csrf
      <input type="hidden" id="id_vehiculo" name="idVehiculo">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Generar QR</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning d-flex align-items-center fs-5" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-3" style="transform:scale(1.6)"></i>
            <div>
              ¿Generar código para el vehículo con placa <b id="placa_modal"></b>? Tiene validez de 30 minutos.
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <fieldset>
              <legend>Seleccione un tipo para generar QR</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="inlineRadio1" value="INGRESO" checked>
                <label class="form-check-label" for="inlineRadio1">INGRESO</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo" id="inlineRadio2" value="SALIDA">
                <label class="form-check-label" for="inlineRadio2">SALIDA</label>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary rounded-pill" data-bs-dismiss="modal">Generar</button>
        </div>
      </div>
    </form>
  </div>
</div>



{{-- Modal ver QR --}}
<div class="modal fade" id="modal_ver_qr" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5">VER QR</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center" id="qr_ver"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary rounded-pill" data-bs-dismiss="modal" onclick="descargarQr()"><i
            class="fa fa-solid fa-download"></i> Descargar</button>
      </div>
    </div>
  </div>
</div>
