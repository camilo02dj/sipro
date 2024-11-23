<?php
session_start();
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaClientes
{

    public function mostraTablaClientes()
    {
        $item = null;
        $valor = null;

        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

        $datosJson = ["data" => []];

        foreach ($clientes as $i => $cliente) {

            $datosJson["data"][] = [
                $i + 1,
                htmlspecialchars($cliente["codigo"], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($cliente["nit"], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($cliente["razon_social"], ENT_QUOTES, 'UTF-8'),
            ];
        }

        echo json_encode($datosJson);
    }

}


$activarCliente = new TablaClientes();
$activarCliente->mostraTablaClientes();
