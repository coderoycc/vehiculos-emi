@if (count($docs) == 0)
  <div class="alert alert-warning" role="alert">
    Este vehiculo no tiene documentos registrados
  </div>
@else
  <?php
  $c = 0;
  ?>
  @foreach ($docs as $key => $doc)
    <div class="col-md-6 text-center mb-3">
      <a href="{{ asset('storage/vehiculos/' . $doc) }}" class="btn" style="--bs-btn-bg: {{ $colors[$c] }}"
        target="_blank">
        {{ $nombres[$key] }}
      </a>
    </div>
    <?php $c++; ?>
  @endforeach
@endif
