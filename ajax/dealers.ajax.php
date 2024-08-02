<?php

require_once "../controladores/dealers.controlador.php";
require_once "../modelos/dealers.modelo.php";

class AjaxDealers{

    public $idDealer;

    public function ajaxEditarDealer(){

        $item = "id";
        $valor = $this->idDealer;

        $respuesta = ControladorDealers::ctrMostrarDealers($item, $valor);

        echo json_encode($respuesta);

    }

    public $dealer;
    public $proveedor;

    public function ajaxValidarDealer(){

        $nit =  $this->dealer;
        $proveedor = $this->proveedor;

        $respuesta = ControladorDealers::ctrValidarDealer($nit, $proveedor);

        echo json_encode($respuesta);

    }
}

if(isset($_POST["idDealer"])){

    $editar = new AjaxDealers();
    $editar -> idDealer = $_POST["idDealer"];
    $editar -> ajaxEditarDealer();

}

if(isset($_POST["dealer"]) && isset($_POST["proveedor"])){

    $valDealer = new AjaxDealers();
    $valDealer -> dealer = $_POST["dealer"];
    $valDealer -> proveedor = $_POST["proveedor"];
    $valDealer -> ajaxValidarDealer();

}
