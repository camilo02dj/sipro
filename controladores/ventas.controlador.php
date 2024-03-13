<?php

class ControladorVentas
{


	static public function ctrMostrarVentas($fechaInicial, $fechaFinal, $item, $valor)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $fechaInicial, $fechaFinal, $item, $valor);

		return $respuesta;
	}

	static public function ctrDetalleVentas($fechaInicial, $fechaFinal, $item, $valor)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlDetalleVentas($tabla, $fechaInicial, $fechaFinal, $item, $valor);

		return $respuesta;
	}
}