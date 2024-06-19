<?php
session_start();
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";

class TablaVentas {
    public function mostrarTablaVentas() {
        $nit = $_SESSION["usuario"];
        $fechaInicial = isset($_GET['fechaInicial']) ? $_GET['fechaInicial'] : null;
        $fechaFinal = isset($_GET['fechaFinal']) ? $_GET['fechaFinal'] : null;
        $Ventas = ControladorVentas::ctrVerVentas($nit, $fechaInicial, $fechaFinal);

        if (count($Ventas) == 0) {
            echo '{"data": []}';
            return;
        }

        $datosJson = '{"data": [';

        foreach ($Ventas as $i => $reporte) {
            $centros = ControladorCentros::ctrMostrarCentros("codigo", $reporte["co"]);
            $datosJson .= '[
                "' . ($i + 1) . '",
                "' . htmlspecialchars($reporte["fecha"], ENT_QUOTES, 'UTF-8') . '",
                "' . htmlspecialchars($centros["centro_operacion"], ENT_QUOTES, 'UTF-8') . '",
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
$activarReporte->mostrarTablaVentas();
