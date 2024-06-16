<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login </title>
  @include('partials/header_imports')

  <style>
    body {
      font-family: "Arial", sans-serif;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: #ecf0f1;
      /* Warna latar belakang */
    }

    .container {
      width: 100%;
      max-width: 400px;
    }

    .card {
      background-color: #3498db;
      /* Warna latar card */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      color: #fff;
    }

    h2 {
      text-align: center;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 6px;
    }

    input {
      padding: 10px;
      margin-bottom: 12px;
      border: 1px solid #2980b9;
      /* Warna border input */
      border-radius: 4px;
      transition: border-color 0.3s ease-in-out;
    }

    input:focus {
      border-color: #3498db;
      /* Warna border input saat focus */
    }

    button {
      background-color: #2980b9;
      /* Warna latar button */
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    button:hover {
      background-color: #2c3e50;
      /* Warna latar button saat hover */
    }
    body{
      background-image: url('/images/login_adm_bg.jpg');
      /*image repeat none*/
      background-size: cover;
      
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      @if ($errors->any())
        <div class="alert alert-danger" role="alert">
          Credenciales incorrectas
        </div>
      @endif
      <h2>Iniciar sesión</h2>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="username">Usuario</label>
        <input type="text" id="username" name="usuario" required>
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Ingresar</button>
      </form>
    </div>
  </div>
</body>

</html>
