<?php

//Se requiere la conexión
require_once 'conexion.php';

class Empleado extends Conexion{

    //Este objeto almacena la conexión que trae Conexion.php
    //y que luego compartirá con TODOS los métodos...
    private $acceso;

    public function __CONSTRUCT(){
        $this->acceso = parent::getConexion();
    }

    //Utilizará el spu_empleados_listar
    public function listarEmpleados(){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_listar()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);    //Arreglo asociativo
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    //Enviaremos un solo elemento (ARRAY ASOCIATIVO) conteniendo los 7 valores requeridos por el SPU
    public function registrarEmpleado($datos = []){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_registrar(?,?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['idarea'],
                    $datos['apellidos'],
                    $datos['nombres'],
                    $datos['dni'],
                    $datos['telefono'],
                    $datos['email'],
                    $datos['direccion']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    //Similar al proceso de registro, añadiendo +idempleado
    public function actualizarEmpleado($datos = []){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_actualizar(?,?,?,?,?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['idempleado'],
                    $datos['idarea'],
                    $datos['apellidos'],
                    $datos['nombres'],
                    $datos['dni'],
                    $datos['telefono'],
                    $datos['email'],
                    $datos['direccion']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function buscarEmpleado($dni = ''){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_buscar_dni(?)");
            $consulta->execute(array($dni));

            //Se utiliza solo fetch (en lugar de fetchAll) porque solo esperamos como máximo 1 registro
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function eliminarEmpleado($idempleado = 0){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_eliminar(?)");
            $consulta->execute(array($idempleado));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function getData($idempleado = 0){
        try{
            $consulta = $this->acceso->prepare("CALL spu_empleados_getdata(?)");
            $consulta->execute(array($idempleado));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

}

?>