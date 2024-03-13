<?php
require_once "conexion.php";

class ModeloVentas
{
    static public function mdlMostrarVentas($tabla, $fechaInicial, $fechaFinal, $item, $valor)
    {
        // Asegura que el nombre del item esté entre los permitidos para prevenir inyección SQL.
        // Incluye 'item_proveedor' si es uno de los campos válidos que deseas filtrar.
        $columnasPermitidas = ['item_proveedor', 'item', 'centro_operacion'];
        if (!in_array($item, $columnasPermitidas)) {
            // Lanza una excepción si el nombre de la columna no es válido.
            throw new Exception("El nombre del item '$item' no es válido");
        }

        // Construye la base de la consulta SQL.
        $baseSQL = "SELECT t.co, t.item, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo";

        // Ajusta la consulta según si se especificaron fechas.
        if ($fechaInicial == null) {
            $sql = "$baseSQL WHERE $item = :valor GROUP BY t.desc_item";
        } else if ($fechaInicial == $fechaFinal) {
            $fechaConFormato = "%$fechaFinal%";
            $sql = "$baseSQL WHERE $item = :valor AND t.fecha LIKE :fecha GROUP BY t.desc_item";
        } else {
            $fechaFinalMasUno = (new DateTime($fechaFinal))->modify('+1 day')->format("Y-m-d");
            $sql = "$baseSQL WHERE $item = :valor AND t.fecha BETWEEN :fechaInicial AND :fechaFinalMasUno GROUP BY t.desc_item";
        }

        // Prepara la consulta SQL.
        $stmt = Conexion::conectar()->prepare($sql);

        // Vincula los valores a los marcadores de posición en la consulta SQL.
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        if (isset($fechaConFormato)) {
            $stmt->bindParam(":fecha", $fechaConFormato, PDO::PARAM_STR);
        }
        if (isset($fechaInicial) && $fechaInicial != $fechaFinal) {
            $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
            $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
        }

        // Ejecuta la consulta.
        $stmt->execute();

        // Retorna los resultados.
        return $stmt->fetchAll();
    }


    static public function mdlDetalleVentas($tabla, $fechaInicial, $fechaFinal, $item, $valor)
    {
        $columnasPermitidas = ['item_proveedor', 'item', 'centro_operacion'];
        if (!in_array($item, $columnasPermitidas)) {
            throw new Exception("El nombre del item '$item' no es válido");
        }

        $baseSQL = "SELECT t.fecha, t.co, t.item, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo";

        // Verifica si ambas fechas están definidas para aplicar el filtro de rango
        if ($fechaInicial && $fechaFinal) {
            $fechaFinalMasUno = (new DateTime($fechaFinal))->modify('+1 day')->format("Y-m-d");
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

