<?php

class ControladorVentas
{


	static public function ctrMostrarVentas($nit, $fechaInicial, $fechaFinal, $perfil)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $nit, $fechaInicial, $fechaFinal, $perfil);

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

	static public function ctrVerVentas($nit, $fechaInicial, $fechaFinal, $perfil)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlVentas($tabla, $nit, $fechaInicial, $fechaFinal, $perfil);

		return $respuesta;
	}


	static public function ctrMostrarVentasDealers($nit, $fechaInicial, $fechaFinal)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentasDealers($tabla, $nit, $fechaInicial, $fechaFinal);

		return $respuesta;
	}



}