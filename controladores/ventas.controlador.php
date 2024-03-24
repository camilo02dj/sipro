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


//////////////////////////////////////////////////////

static public function ctrMostrarVentasT($fechaInicial, $fechaFinal)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentasT($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	static public function ctrDetalleVentasT( $item, $fechaInicial, $fechaFinal)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlDetalleVentasT($tabla,  $item, $fechaInicial, $fechaFinal);

		return $respuesta;
	}





}