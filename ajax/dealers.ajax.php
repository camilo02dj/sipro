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


	public $activarDealer;
	public $activarId;



	public $validarDealer;

	public function ajaxValidarDealer(){

		$item = "nit";
		$valor = $this->validarDealer;

		$respuesta = ControladorDealers::ctrMostrarDealers($item, $valor);

		echo json_encode($respuesta);

	}
}

if(isset($_POST["idDealer"])){

	$editar = new AjaxDealers();
	$editar -> idDealer = $_POST["idDealer"];
	$editar -> ajaxEditarDealer();

}


if(isset( $_POST["validarDealer"])){

	$valDealer = new AjaxDealers();
	$valDealer -> validarDealer = $_POST["validarDealer"];
	$valDealer -> ajaxValidarDealer();

}

