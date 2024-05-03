<form id="form_edit" onsubmit="return false;">
  @csrf
  <input type="hidden" value="{{ $vehiculo->id }}" name="vehiculo_id">
  <div class="row">
    <div class="col-md-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="placa_edit" name="placa" value="{{ $vehiculo->placa }}"
          placeholder="placa completo">
        <label for="placa_edit">Placa</label>
      </div>
      {{-- {{ var_dump($vehiculo) }} --}}
    </div>
    <div class="col-md-6">
      <div class="form-floating">
        <input type="text" class="form-control" name="color" value="{{ $vehiculo->color }}" placeholder="Color">
        <label for="color">Color</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-3">
        <select class="form-select" name="tipo">
          <option value="">-- Seleccione --</option>
          <option {{ $vehiculo->tipo == 'Automóvil' ? 'selected' : '' }} value="Automóvil">Automóvil</option>
          <option {{ $vehiculo->tipo == 'Autobus' ? 'selected' : '' }} value="Autobus">Autobus</option>
          <option {{ $vehiculo->tipo == 'Camión' ? 'selected' : '' }} value="Camión">Camión</option>
          <option {{ $vehiculo->tipo == 'Camioneta' ? 'selected' : '' }} value="Camioneta">Camioneta</option>
          <option {{ $vehiculo->tipo == 'Furgoneta' ? 'selected' : '' }} value="Furgoneta">Furgoneta</option>
          <option {{ $vehiculo->tipo == 'Motocicleta' ? 'selected' : '' }} value="Motocicleta">Motocicleta</option>
          <option {{ $vehiculo->tipo == 'Vagoneta' ? 'selected' : '' }} value="Vagoneta">Vagoneta</option>
          <option {{ $vehiculo->tipo == 'Otro' ? 'selected' : '' }} value="Otro">Otro</option>
        </select>
        <label for="tipo">Tipo</label>
      </div>
    </div>
    <div class="col-md-6">
      <p class="fw-bold mb-0">Propietario</p>
      <span>{{ $vehiculo->persona->nombre }}</span>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" name="detalle" value="{{ $vehiculo->detalle ?? '' }}"
          placeholder="detalle">
        <label for="detalle">Detalle (opcional)</label>
      </div>
    </div>
  </div>
</form>
