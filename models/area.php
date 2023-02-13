<?php

require_once 'conexion.php';

class Area extends Conexion{

  private $acceso;

  public function __CONSTRUCT(){
    $this->acceso = parent::getConexion();
  }

  public function listarAreas(){
    try{
      $consulta = $this->acceso->prepare("CALL spu_areas_listar()");
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

}

?>