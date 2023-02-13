<?php

require_once '../models/empleado.php';

//Si existe una operación...
if (isset($_GET['operacion'])){

    //Instanciamos la clase Empleado
    $empleado = new Empleado();

    if ($_GET['operacion'] == 'listarEmpleados'){
        $data = $empleado->listarEmpleados();

        if ($data){
            //Enviamos datos para que la vista RENDERICE
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idempleado']}</td>
                        <td>{$registro['nombrearea']}</td>
                        <td>{$registro['apellidos']}</td>
                        <td>{$registro['nombres']}</td>
                        <td>{$registro['dni']}</td>
                        <td>{$registro['telefono']}</td>
                        <td>{$registro['email']}</td>
                        <td>
                            <a href='#' data-ideliminar='{$registro['idempleado']}' class='btn btn-sm btn-danger eliminar'><i class='fa-solid fa-trash'></i></a>
                            <a href='#' data-ideditar='{$registro['idempleado']}' class='btn btn-sm btn-info editar'><i class='fa-solid fa-pencil'></i></a>
                        </td>
                    </tr>
                ";
            }
        }
    }

    if ($_GET['operacion'] == 'registrarEmpleado'){   
        //Debemos recuperar los datos que nos envía la vista
        //Estos datos lo guardamos en un ARRAY ASOCIATIVO
        //Recuerda: El modelo NO solicita 7 variables, sino, 1 solo objeto
        $datos = [
            "idarea"        => $_GET['idarea'],     // NOTA: $_GET[] datos enviados por la vista
            "apellidos"     => $_GET['apellidos'],
            "nombres"       => $_GET['nombres'],
            "dni"           => $_GET['dni'],
            "telefono"      => $_GET['telefono'],
            "email"         => $_GET['email'],
            "direccion"     => $_GET['direccion']
        ];

        //El array ya recibió los datos de la vista, procedemos a guardar
        $empleado->registrarEmpleado($datos);
    }

    if ($_GET['operacion'] == 'actualizarEmpleado'){   
        $datos = [
            "idempleado"    => $_GET['idempleado'],
            "idarea"        => $_GET['idarea'],
            "apellidos"     => $_GET['apellidos'],
            "nombres"       => $_GET['nombres'],
            "dni"           => $_GET['dni'],
            "telefono"      => $_GET['telefono'],
            "email"         => $_GET['email'],
            "direccion"     => $_GET['direccion']
        ];

        $empleado->actualizarEmpleado($datos);
    }

    if ($_GET['operacion'] == 'buscarEmpleado'){
        $data = $empleado->buscarEmpleado($_GET['dni']);
        echo json_encode($data);
    }

    if ($_GET['operacion'] == 'eliminarEmpleado'){
        $empleado->eliminarEmpleado($_GET['idempleado']);
    }

    if ($_GET['operacion'] == 'getData'){
        $data = $empleado->getData($_GET['idempleado']);
        
        //dataType: 'JSON'
        echo json_encode($data);
    }

}

?>