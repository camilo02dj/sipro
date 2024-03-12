<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class TablaVentas {
    
    public function mostrarTablaVentas() {
        $item = null;
        $valor = null;

        $Ventas = ControladorVentas::ctrmostrarVentas($item, $valor);

        if (count($Ventas) == 0) {
            echo '{"data": []}';
            return;
        }

        $datosJson = '{"data": [';

        foreach ($Ventas as $i => $reporte) {
            $botones =  "<div class='btn-group'><button class='btn-xs btn btn-success btnImprimirReporte' nitCertificado='" . $reporte["nit"] . "'><i class='  fas fa-cloud-download-alt'></i></button></div>";


            $datosJson .= '[
                "' . ($i + 1) . '",
                "' . htmlspecialchars($reporte["co"], ENT_QUOTES, 'UTF-8') . '",
                "' . htmlspecialchars($reporte["desc_item"], ENT_QUOTES, 'UTF-8') . '",
                "' . htmlspecialchars($reporte["cantidad"], ENT_QUOTES, 'UTF-8') . '",
                "' . $botones . '"
            ],';
        }

        $datosJson = rtrim($datosJson, ',');
        $datosJson .= ']}';

        echo $datosJson;
    }
}

$activarReporte = new TablaVentas();
$activarReporte->mostrarTablaVentas();