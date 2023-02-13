<?php

class Cliente{

    //Atributo de clase
    private $listaClientes = [];

    public function __CONSTRUCT(){
        //Contiene los datos
        $this->listaClientes = [
            [
                "id"    => 1,
                "datos" => [
                    "apellidos" => "Francia Minaya", 
                    "nombres"   => "Jhon Edward",
                    "telefono"  => "956111222"
                ]
            ],
            [
                "id"    => 2,
                "datos" => [
                    "apellidos" => "Cárdenas Perez", 
                    "nombres"   => "Fiorella",
                    "telefono"  => "956888999"
                ]
            ],
            [
                "id"    => 3,
                "datos" => [
                    "apellidos" => "Gonzales Fajardo", 
                    "nombres"   => "Martín",
                    "telefono"  => "956000333"
                ]
            ],
            [
                "id"    => 4,
                "datos" => [
                    "apellidos" => "Ochoa Sanchez", 
                    "nombres"   => "Patricia",
                    "telefono"  => "956777222"
                ] 
            ],
            [
                "id"    => 5,
                "datos" => [
                    "apellidos" => "Quispe Montalvan", 
                    "nombres"   => "Ricardo",
                    "telefono"  => "956777888"
                ] 
            ]
        ]; //fin array listaClientes
    }

    public function listarClientes(){
        return $this->listaClientes;
    }//Fin método

    public function buscarCliente($id = ""){
        
        $registroEncontrado = [];

        foreach($this->listaClientes as $registro){
            if ($registro['id'] == $id){
                $registroEncontrado = $registro['datos'];
            }
        }

        return $registroEncontrado;
    }

}//Fin clase

?>