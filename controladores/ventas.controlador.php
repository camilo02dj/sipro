<?php

class ControladorVentas
{


	static public function ctrMostrarVentas($nit, $fechaInicial, $fechaFinal)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $nit, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	static public function ctrDetalleVentas( $item, $nit, $fechaInicial, $fechaFinal)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlDetalleVentas($tabla,  $item, $nit, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	static public function ctrFechaMaxima()
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mldFechaMaxima($tabla);

		return $respuesta;
	}


}