<?php

//Controlador recibe una solicitud de la vista...
//Utiliza al modelo para realizar una tarea...
//Retorna el resultado en la vista...
require_once "../models/cliente.php";

if (isset($_GET['operacion'])){

    //Instanciando modelo
    $cliente = new Cliente();
    
    //Identificando la acción
    if ($_GET['operacion'] == 'listar'){
        
        $datos = $cliente->listarClientes();
        sleep(1);

        //Estructura repetitiva, orientada a recorrer colecciones
        foreach($datos as $registro){
            echo "
                <tr>
                    <td>{$registro['id']}</td>
                    <td>{$registro['datos']['apellidos']}</td>
                    <td>{$registro['datos']['nombres']}</td>
                    <td>{$registro['datos']['telefono']}</td>
                    <td>
                        <a href='#' class='btn btn-sm btn-danger'>Eliminar</a>
                        <a href='#' class='btn btn-sm btn-info'>Editar</a>
                    </td>
                </tr>
            ";
        }

    }

    if ($_GET['operacion'] == 'buscar'){
        $resultado = $cliente->buscarCliente($_GET['id']);
        echo json_encode($resultado);
    }

    if ($_GET['operacion'] == 'otros'){
        echo "Puedes hacer lo que quieras...";
    }

}

?>