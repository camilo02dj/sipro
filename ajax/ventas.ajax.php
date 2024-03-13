<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas{

	public $item;
	public $fechaInicial;
	public $fechaFinal;

	public function ajaxMostrarDetalleVentas(){

		$item2 = "item";
		$valor = $this->item;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;

		$respuesta = ControladorVentas::ctrDetalleVentas($fechaInicial, $fechaFinal, $item2, $valor);

		echo json_encode($respuesta);
	}
}

if (isset($_POST["item"])) {

	$venta = new AjaxVentas();
	$venta->item = $_POST["item"];
	$venta->ajaxMostrarDetalleVentas();
}
