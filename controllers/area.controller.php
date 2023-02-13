<?php

require_once "../models/area.php";

if (isset($_GET['operacion'])){

  $area = new Area();

  if ($_GET['operacion'] == 'listarAreas'){

    //Renderizar los datos para la vista...
    $data = $area->listarAreas();

    //Verificando si tiene datos
    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idarea']}'>{$registro['nombrearea']}</option>";
      }
    }

  }

}

?>