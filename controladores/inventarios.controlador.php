<?php


class ControladorInventarios{

    static public function ctrMostrarInventarios($item, $valor){

        $tabla= "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventarios($tabla, $item, $valor);

        return $respuesta;
    }


}