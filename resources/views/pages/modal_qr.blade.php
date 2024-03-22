{{-- Modal ver QR --}}
<div class="modal fade" id="modal_ver_qr" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5">VER QR</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center" id="qr_ver">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary rounded-pill" data-bs-dismiss="modal" onclick="descargarQr()"><i
            class="fa fa-solid fa-download"></i> Descargar</button>
      </div>
    </div>
  </div>
</div>
