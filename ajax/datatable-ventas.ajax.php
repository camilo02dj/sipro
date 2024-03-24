<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";

class TablaVentas {
    
    public $proveedor;
    public function mostrarTablaVentas() {
        $item = "item_proveedor";
        $valor = $this->proveedor;

        $Ventas = ControladorVentas::ctrmostrarVentas($item, $valor);

        if (count($Ventas) == 0) {
            echo '{"data": []}';
            return;
        }

        $datosJson = '{"data": [';

        foreach ($Ventas as $i => $reporte) {
            
            $botones =  "<div class='btn-group'><button class='btn btn-success btnImprimirReporte'><i class='fas fa-search-plus'></i></button></div>";


            $datosJson .= '[
                "' . ($i + 1) . '",
                "' . htmlspecialchars($reporte["desc_item"], ENT_QUOTES, 'UTF-8') . '",
                "' . htmlspecialchars(number_format($reporte["totalVendido"], 0, '.', ','), ENT_QUOTES, 'UTF-8') . '",
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