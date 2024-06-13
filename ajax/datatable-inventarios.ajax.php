<?php
session_start();
require_once "../controladores/inventarios.controlador.php";
require_once "../modelos/inventarios.modelo.php";
require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";

class TablaInventarios {
    
    public function mostrarTablaInventarios() {
        if($_SESSION["perfil"]=="Administrador" || $_SESSION["perfil"]== "Especial" ){
        $item = null;
        $valor = null;
        }else{
            $item = "cod_proveedor_item";
            $valor = $_SESSION["usuario"];
        }
    
        $inventarios = ControladorInventarios::ctrMostrarInventarios($item, $valor);

        $datosJson = ["data" => []];

        foreach ($inventarios as $i => $inventario) {
            $co = ControladorCentros::ctrMostrarCentros("id", $inventario["co_bodega"]);
            $color = $this->getColorDeFecha($inventario["fecha_vcto_lote"]);
            $datosJson["data"][] = [
                $i + 1,
                htmlspecialchars($inventario["desc_item"], ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($inventario["cant_disponible"], ENT_QUOTES, 'UTF-8'),
                "<span style='color: $color'>" . htmlspecialchars($inventario["fecha_vcto_lote"], ENT_QUOTES, 'UTF-8') . "</span>",
                htmlspecialchars($co["centro_operacion"], ENT_QUOTES, 'UTF-8')
            ];
        }

        echo json_encode($datosJson);
    }

    private function getColorDeFecha($fecha) {
        if ($fecha == '0000-00-00' || empty($fecha)) {
            return 'black';
        }
        $fechaHoy = new DateTime();
        $fechaVencimiento = new DateTime($fecha);
        $diferencia = $fechaHoy->diff($fechaVencimiento);
        $dias = (int) $diferencia->format('%a');

        if ($diferencia->invert == 1) {
            return 'red'; // Fecha pasada
        } elseif ($dias <= 30) {
            return 'red';
        } elseif ($dias <= 60) {
            return 'orange';
        } else {
            return 'green';
        }
    }
}


$activarInventario = new TablaInventarios();
$activarInventario->mostrarTablaInventarios();