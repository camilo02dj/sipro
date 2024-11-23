<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

    public $codigoCliente;

    public function ajaxEditarCliente(){

        $item = "codigo";
        $valor = $this->codigoCliente;

        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

        echo json_encode($respuesta);

    }

}

if(isset($_POST["codigoCliente"])){

    $editar = new AjaxClientes();
    $editar -> codigoCliente = $_POST["codigoCliente"];
    $editar -> ajaxEditarCliente();

}


