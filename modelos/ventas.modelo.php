<?php
require_once "conexion.php";

class ModeloVentas
{
	static public function mdlMostrarVentas($tabla, $nit, $fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor GROUP BY t.desc_item");
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha like '%$fechaFinal%' GROUP BY t.desc_item");

			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("YYYY-mm-dd");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("YYYY-mm-dd");

			if ($fechaFinalMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha BETWEEN :fechaInicial AND :fechaFinalMasUno GROUP BY t.desc_item");
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.item_proveedor, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha BETWEEN :fechaInicial AND :fechaFinal GROUP BY t.desc_item");
            }
            
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            
            $stmt->execute();
            
			return $stmt->fetchAll();

            
		}

       
	}


    static public function mdlDetalleVentas($tabla, $item, $nit, $fechaInicial, $fechaFinal) {
        if ($fechaInicial == null) {
            // Corrección de la consulta para usar placeholders adecuadamente.
            $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.item = :item GROUP BY t.co");
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        } else if ($fechaInicial == $fechaFinal) {
            // Uso de LIKE con los porcentajes directamente en la variable.
            $fechaConFormato = "%{$fechaFinal}%";
            $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.item = :item AND t.fecha LIKE :fecha GROUP BY t.co");
            $stmt->bindParam(":fecha", $fechaConFormato, PDO::PARAM_STR);
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        } else {
            // Corrección del formato de fecha.
            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");
    
            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
    
            if ($fechaFinalMasUno == $fechaActualMasUno) {
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.item = :item AND t.fecha BETWEEN :fechaInicial AND :fechaFinalMasUno GROUP BY t.co");
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.item = :item AND t.fecha BETWEEN :fechaInicial AND :fechaFinal GROUP BY t.co");
            }
    
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            $stmt->bindParam(":item", $item, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        return $stmt->fetchAll();
    }
    




    static public function mdlDetalleVentas2($tabla, $fechaInicial, $fechaFinal, $item, $valor)
    {
        $columnasPermitidas = ['item_proveedor', 'item', 'centro_operacion'];
        if (!in_array($item, $columnasPermitidas)) {
            throw new Exception("El nombre del item '$item' no es válido");
        }

        $baseSQL = "SELECT t.fecha, t.co, t.item, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo";

        // Verifica si ambas fechas están definidas para aplicar el filtro de rango
        if ($fechaInicial && $fechaFinal) {
            $fechaFinalMasUno = (new DateTime($fechaFinal))->modify('+1 day')->format("YYYY-MM-dd");
            $sql = "$baseSQL WHERE $item = :valor AND t.fecha BETWEEN :fechaInicial AND :fechaFinalMasUno GROUP BY t.co";
        } else {
            // Si no hay fechas definidas, solo filtra por el item y valor.
            $sql = "$baseSQL WHERE $item = :valor GROUP BY t.co";
        }

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

        // Vincula las fechas solo si están definidas
        if ($fechaInicial && $fechaFinal) {
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

}

