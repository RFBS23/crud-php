<!--FONTAWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous">
<?php
    if(isset($_POST['submit'])){
        echo "<div class='alert alert-success' role='alert'>
                <h4 class='alert-heading fa-solid fa-circle-check'> NOTA!</h4>
                <p>Hola Que Tal <i class='fa-solid fa-hand-sparkles'></i> Para Poder Registrarte Debes Completar Todos Los Campos.</p>
                <hr>
                <p class='mb-0'>En Caso De Que No Sea Asi Apareceran Los Campos Por Completar Aqui <i class='fa-solid fa-face-sad-tear'></i>.</p>
            </div>";

        //Apellidos
        if(empty($apellidos)){
            echo "<div class='error' id='apellidos'></div>";
        } else{
            if(strlen($nombres) > 50){
                echo "<p>El nombre es muy largo</p>";
            }
        }

        //nombres
        if(empty($nombres)){
            echo "<div class='error' id='nombre'></div>";
        }

        //telefono
        if(empty($telefono)){
            echo "<div class='error' id='telefono'></div>";
        }

        //correo
        if(empty($correo)){
            echo "<div class='error' id='correo'></div>";
        }

        //contraseña
        if(empty($contra)){
            echo "<div class='error' id='contra'></div>";
        }
    }
?>
