<?php
require_once "conexion.php";

class ModeloCentros
{
    static public function mdlMostrarCentros($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare($item != null ?
            "SELECT * FROM $tabla WHERE $item = :$item" :
            "SELECT * FROM $tabla");

        if ($item != null) {
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        }

        $stmt->execute();

        $resultado = $item != null ? $stmt->fetch() : $stmt->fetchAll();

        $stmt = null; // Cerrar la declaración PDO correctamente

        return $resultado;
    }
}

