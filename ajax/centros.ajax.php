<?php

require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";

class AjaxCentros{

    public $codigoCentro;

    public function ajaxEditarCentro(){

        $item = "codigo";
        $valor = $this->codigoCentro;

        $respuesta = ControladorCentros::ctrMostrarCentros($item, $valor);

        echo json_encode($respuesta);

    }

}

if(isset($_POST["codigoCentro"])){

    $editar = new AjaxCentros();
    $editar -> codigoCentro = $_POST["codigoCentro"];
    $editar -> ajaxEditarCentro();

}


