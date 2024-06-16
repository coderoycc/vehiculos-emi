<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LOGIN</title>
  @include('partials/header_imports')

  <style>
    .btn-color {
      background-color: #174287;
      color: #fff;

    }

    .profile-image-pic {
      height: 150px;
      width: 150px;
      object-fit: cover;
    }

    .rounded-shield {
      border-radius: 0px 0px 50% 50%;
    }

    .cardbody-color {
      background-color: #ebf2fa;
    }

    a {
      text-decoration: none;
    }
    body{
      background-image: url('/images/bg_auth_public.jpg');
      /* image centered in X and Y*/
      background-position: center;
      background-size: cover;
    }
  </style>
</head>

<body>
  <div class="container" >
    <div class="row">
      <div class="col-md-6 offset-md-3" style="max-height: 100vh">
        <h2 class="text-center text-light mt-4">Control de vehículos</h2>
        <div class="card my-5">
          <form action="{{ route('login_post') }}" method="POST" class="card-body cardbody-color p-lg-5">
            @csrf
            <div class="text-center mt-1">
              <img src="{{ asset('images/logo_emi0.png') }}"
                class="img-fluid profile-image-pic img-thumbnail rounded-shield my-3" width="200px" alt="profile">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="usuario" id="Username" aria-describedby="emailHelp"
                placeholder="Usuario">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-2 w-100">Ingresar</button>
            </div>
            @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                Credenciales incorrectas
              </div>
            @endif
            <div class="form-text text-center mb-4 text-muted">
              Si no tiene una cuenta, comuníquese con el administrador.
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</body>

</html>
