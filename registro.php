<?php
  if(isset($_POST['submit'])){
    $apellidos = $_POST['apellidos'];
    $nombres = $_POST['nombres'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--FONTAWESOME-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1 class="text-center py-3">REGISTRATE</h1>

    <div class="row mb-2">
      <div class="col-md-6">
        <h3>Notificacion de Tu Proceso de Registro</h3>
          <hr class="py-2">
            <?php
              include("validacion.php");
            ?>
          </hr>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 border rounded-3">
          <form class="row g-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <div class="col-md-6">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" onkeypress="return SoloLetras(event);" required autofocus>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nombres</label>
                <input type="text" name="nombres" class="form-control" onkeypress="return SoloLetras(event);" required>
            </div>

            <div>
              <label class="form-label">Telefono</label>
              <input type="text" name="telefono" class="form-control" maxlength="9" onkeypress="return SoloNumeros(event);" required>
            </div>

            <div>
              <label class="form-label" for="">Correo</label>
              <input type="text" name="correo" class="form-control" >
            </div>

            <div>
              <label class="form-label">Contraseña</label>
              <input type="password" name="contra" class="form-control" >
            </div>

            <div class="col-12 mb-2">
              <button class="btn btn-outline-primary" name="submit" id="liveAlertBtn" type="button">Registrarme</button>
              <a  class="btn btn-outline-danger" type="button" href="index.php" style="text-decoration: none;">Ahora No</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="javascript/alerta.js"></script>
  <script>
    //para nombres y apellidos
    function SoloLetras(e){
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toString();
      letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú";

      especiales = [8,13];
      tecla_especial = false
      for(var i in especiales) {
        if(key == especiales[i]){
          tecla_especial = true;
          break;
        }
      }

      if(letras.indexOf(tecla) == -1 && !tecla_especial){
        alert("Ingresar solo letras");
        return false;
      }
    }

    //para ingresar solo numeros
    function SoloNumeros(evt){
      if(window.event){
      keynum = evt.keyCode;
      }
      else{
        keynum = evt.which;
      }

      if((keynum > 47 && keynum < 58) || keynum == 8 || keynum== 13){
        return true;
      }
      else{
        alert("Ingresar solo numeros");
        return false;
      }
    }
  </script>
</body>
</html>