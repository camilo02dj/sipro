<?php

class ControladorVentas
{


	static public function ctrMostrarVentas($item, $valor)
	{

		$tabla = "vtas_proveedor";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;
	}
}