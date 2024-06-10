
@if (count($docs) == 0)
  <div class="alert alert-warning" role="alert">
    Este vehiculo no tiene documentos registrados
  </div>
@else
<style>
  .btn-document{
    background-color: #fdd000;
    color: #174287;
    width: 140px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: left;
  }
  .btn-document:hover{
    background-color: #cea800;
    box-shadow: 1px 1px 1px 1px #bbb;
  }
</style>
  <?php
  $c = 0;
  ?>
  @foreach ($docs as $key => $doc)
  <?php
  $pdf = substr(strtoupper($doc), -4) === '.PDF';
  $pdf = $pdf ? 1 : 0;
  ?>
    <div class="col-md-6 text-center text-md-start mb-3">
      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ asset('storage/vehiculos/' . $doc) }}" class="btn btn-document" target="_blank">
          <i class="fa-lg fa-solid fa-eye"></i> {{ $nombres[$key] }}
        </a>
        <button type="button" class="btn btn-primary" onclick="upload_file('{{$doc}}', '{{$nombres[$key]}}', {{$pdf}})"><i class="fa-lg fa-solid fa-pen"></i></button>
      </div>
    </div>
    <?php $c++; ?>
  @endforeach
@endif
