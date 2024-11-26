<?php
session_start();
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaVentas
{
    public $fechaI;
    public $fechaF;

    public function mostrarTablaVentas()
    {
        $nit = $_SESSION["usuario"];
        $fechaInicial = $this->fechaI;
        $fechaFinal = $this->fechaF;
        $perfil = $_SESSION["perfil"];
        $Ventas = ControladorVentas::ctrMostrarVentas($nit, $fechaInicial, $fechaFinal, $perfil);

        if (count($Ventas) == 0) {
            echo '{"data": []}';
            return;
        }


        $datosJson = '{"data": [';

        foreach ($Ventas as $i => $reporte) {

            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . htmlspecialchars($reporte["fecha"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["centro_operacion"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["nro_documento"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["desc_item"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["cantidad"], ENT_QUOTES, 'UTF-8') . '"
                ],';
        }

        // Elimina la última coma
        $datosJson = rtrim($datosJson, ',');
        $datosJson .= ']}';

        echo $datosJson;
    }
}

$activarReporte = new TablaVentas();
$activarReporte->fechaI = $_GET['fechaInicial'];
$activarReporte->fechaF = $_GET['fechaFinal'];
$activarReporte->mostrarTablaVentas();
