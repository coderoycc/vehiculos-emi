<div class="row">
  @foreach ($vehiculos as $vehiculo)
    <div class="col-md-6 mb-2">
      <div class="animate__animated animate bounce card">
        <div class="container mt-3 d-flex justify-content-center">
          <img src="{{ asset('images/auto.png') }}" class="card-img-top " alt="vehiculo" style="width:80px" height="80">
        </div>
        <div class="card-body">
          <h5 class="card-title ms-1 text-center">{{ $vehiculo->placa }}</h5>
          <p class="card-text ms-1"><b>Tipo:</b> {{ $vehiculo->tipo }}</p>
          <p class="card-text ms-1"><b>Color:</b> {{ $vehiculo->color }}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>
