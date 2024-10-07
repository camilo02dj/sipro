<?php
session_start();
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";
require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaVentas {
    public $fechaI;
    public $fechaF;

    public function mostrarTablaVentas() {
        $nit = $_SESSION["usuario"];
        $fechaInicial = $this->fechaI;
        $fechaFinal = $this->fechaF;
        $Ventas = ControladorVentas::ctrVerVentas($nit, $fechaInicial, $fechaFinal);

        if (count($Ventas) == 0) {
            echo '{"data": []}';
            return;
        }
        

        $datosJson = '{"data": [';

        foreach ($Ventas as $i => $reporte) {
            $centros = ControladorCentros::ctrMostrarCentros("codigo", $reporte["co"]);
           

            if($_SESSION["perfil"]=="Vip"){
                $clientes = ControladorClientes::ctrMostrarClientes("nit", $reporte["cliente"]);

                $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . htmlspecialchars($reporte["desc_item"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($centros["centro_operacion"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["nro_documento"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["cantidad"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($clientes["razon_social"], ENT_QUOTES, 'UTF-8') . '", 
                    "' . htmlspecialchars($reporte["fecha"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["cliente"], ENT_QUOTES, 'UTF-8') . '"
                ],';
                

            }else{

                $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . htmlspecialchars($reporte["fecha"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($centros["centro_operacion"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["nro_documento"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["desc_item"], ENT_QUOTES, 'UTF-8') . '",
                    "' . htmlspecialchars($reporte["cantidad"], ENT_QUOTES, 'UTF-8') . '"
                ],';

            }
          
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
