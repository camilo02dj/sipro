<?php

class ControladorCentros
{


	static public function ctrMostrarCentros($item, $valor)
	{

		$tabla = "centro_operacion";

		$respuesta = ModeloCentros::mdlMostrarCentros($tabla, $item, $valor);

		return $respuesta;
	}
}