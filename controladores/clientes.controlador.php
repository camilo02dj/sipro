<?php

class ControladorClientes{

    static public function ctrMostrarClientes($item, $valor){
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }
}