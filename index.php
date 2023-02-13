<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>
  
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-primary text-light">
            <strong>Acceso al sistema</strong>
          </div>
          <div class="card-body">
           <form action="" autocomplete="off">
            <div class="mb-3">
              <label for="email" class="form-label">Nombre de usuario:</label>
              <input type="email" class="form-control" id="email" placeholder="correo@algo.com" autofocus>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña:</label>
              <input type="password" class="form-control" id="password">
            </div>
           </form>
          </div>
          <div class="card-footer text-end">
            <button class="btn btn-primary" id="iniciar-sesion" type="button">Iniciar sesión</button>
            <a class="btn btn-success" type="button" href="registro.php" style="text-decoration:none">Registrarme</a>
          </div>
        </div>
      </div> <!-- col-md-6 -->
      <div class="col-md-3"></div>
    </div> <!-- row -->
  </div> <!-- container -->

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script>
    $(document).ready(function (){

      function login(){
        const datos = {
          "operacion"   : "iniciarSesion",
          "email"       : $("#email").val(),
          "password"    : $("#password").val()
        };

        $.ajax({
          url: 'controllers/usuario.controller.php',
          type: 'GET',
          data: datos,
          dataType: 'JSON',
          success: function (result){
            if (result.login){
              alert(`Bienvenido: ${result.apellidos} ${result.nombres}`);
              window.location.href = `views/empleado.view.php`;
            }else{
              alert(result.mensaje);
            }
          }
        });
      }

      $("#iniciar-sesion").click(login);
      
      $("#password").keypress(function (evt) {
        if (evt.keyCode == 13){
          login();
        }
      });

    });
  </script>

</body>
</html>