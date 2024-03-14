<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentas{

	public $item;
	public $proveedor;
	public $fechaInicial;
	public $fechaFinal;

	public function ajaxMostrarDetalleVentas(){

		$item2 = "item";
		$valor = $this->item;
		$nit = $this->proveedor;
		$fechaInicial = $this->fechaInicial;
		$fechaFinal = $this->fechaFinal;

		$respuesta = ControladorVentas::ctrDetalleVentas($valor, $nit, $fechaInicial, $fechaFinal);

		echo json_encode($respuesta);
	}
}

if (isset($_POST["item"])) {

	$venta = new AjaxVentas();
	$venta->item = $_POST["item"];
	$venta->proveedor = $_POST["proveedor"];
	$venta->fechaInicial = $_POST["fechaInicial"];
	$venta->fechaFinal = $_POST["fechaFinal"];
	$venta->ajaxMostrarDetalleVentas();
}
