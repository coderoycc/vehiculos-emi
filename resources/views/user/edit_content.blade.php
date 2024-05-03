<form id="form_update">
  <input type="hidden" name="user_id" value="{{ $user->id }}">
  @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="nombre" value="{{ $user->nombre }}" placeholder="Nombre completo"
          required>
        <label for="Nombre">Nombre</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="usuario" value="{{ $user->usuario }}" placeholder="usuario"
          required>
        <label for="Usuario">Usuario</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-2">
        <select class="form-select" name="rol" required>
          <option value="">-- Seleccione --</option>
          <option {{ $user->rol == 'ADMIN' ? 'selected' : '' }} value="ADMIN">ADMIN</option>
          <option {{ $user->rol == 'GUARDIA' ? 'selected' : '' }} value="GUARDIA">GUARDIA</option>
        </select>
        <label for="tipo">Rol</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-2">
        <input type="text" class="form-control" name="ci" value="{{ $user->ci }}" placeholder="ci">
        <label for="detalle">CI</label>
      </div>
    </div>
  </div>
</form>
