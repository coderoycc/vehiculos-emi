<form id="form_update">
  <input type="hidden" name="user_id" value="{{ $persona->id }}">
  @csrf
  <div class="row">
    <div class="col-xl-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" value="{{ $persona->nombre }}" name="nombre"
          placeholder="Nombre completo">
        <label for="nombre">Nombre completo</label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="ci" value="{{ $persona->ci }}"
          placeholder="Carnet de identidad">
        <label for="ci">Carnet de identidad</label>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="celular" value="{{ $persona->celular }}" placeholder="Celular">
        <label for="celular">Celular (opcional)</label>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" value="{{ $persona->cargo }}" name="cargo" placeholder="cargo">
        <label for="cargo">Cargo</label>
      </div>
    </div>
  </div>
</form>
