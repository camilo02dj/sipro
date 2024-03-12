<?php
require_once "conexion.php";

class ModeloVentas
{
    static public function mdlMostrarVentas($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare($item != null ?
            "SELECT  t.co, t.desc_item, c.centro_operacion, Sum(t.cantidad) as totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE $item = :$item GROUP BY desc_item" :
            "SELECT t.co, t.desc_item, c.centro_operacion, t.cantidad FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo");

        if ($item != null) {
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        }

        $stmt->execute();

        $resultado = $item != null ? $stmt->fetchAll() : $stmt->fetchAll();

        $stmt = null; // Cerrar la declaración PDO correctamente

        return $resultado;
    }
}

