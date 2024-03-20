<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Seguimiento</title>
  @include('partials.header_imports')
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

</body>

</html>