<?php

require_once "../controladores/maquinas.controlador.php";
require_once "../modelos/maquinas.modelo.php";

class AjaxMostrarMaquinas{

	public function ajaxMostrarMaquina(){

		$item = null;
		$valor = null;

		$respuesta = ControladorMaquinas::ctrMostrarMaquinas($item, $valor);

		echo json_encode($respuesta);


	}
} 