<?php
require_once "conexion.php";

class ModeloVentas
{
    static public function mdlMostrarVentas($tabla, $nit, $fechaInicial, $fechaFinal)
    {

        if ($fechaInicial == null) {

            $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.referencia, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor GROUP BY t.referencia, t.desc_item");
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicial == $fechaFinal) {

            $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.referencia, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha like '%$fechaFinal%' GROUP BY t.desc_item, t.referencia");

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
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item_proveedor, t.referencia, t.item, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha BETWEEN :fechaInicial AND :fechaFinalMasUno GROUP BY t.desc_item, t.referencia");
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
                $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
                $stmt->execute(); // Asegúrate de ejecutar la consulta dentro de esta condición
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT t.co, t.item, t.item_proveedor, t.referencia, t.fecha, t.desc_item, c.centro_operacion, SUM(t.cantidad) AS totalVendido FROM $tabla AS t INNER JOIN centro_operacion AS c ON t.co = c.codigo WHERE item_proveedor = :item_proveedor AND t.fecha BETWEEN :fechaInicial AND :fechaFinal GROUP BY t.desc_item, t.referencia");
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
                $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            }
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }


    static public function mdlDetalleVentas($tabla, $item, $nit, $fechaInicial, $fechaFinal)
    {
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


    static public function mldFechaMaxima($tabla)
    {


        $stmt = Conexion::conectar()->prepare("SELECT MAX(fecha) AS fechaMaxima, MIN(fecha) AS fechaMinima FROM $tabla ");

        $stmt->execute();

        return $stmt->fetch();
        //$stmt -> close();

       
    }

    static public function mdlVentas($tabla, $nit, $fechaInicial, $fechaFinal)
    {

        if ($fechaInicial == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE item_proveedor = :item_proveedor ORDER BY fecha ASC");
            $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        } else if ($fechaInicial == $fechaFinal) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE item_proveedor = :item_proveedor AND fecha like '%$fechaFinal%' ORDER BY fecha ASC");

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
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE item_proveedor = :item_proveedor AND fecha BETWEEN :fechaInicial AND :fechaFinalMasUno ORDER BY fecha ASC ");
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinalMasUno", $fechaFinalMasUno, PDO::PARAM_STR);
                $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
                $stmt->execute(); // Asegúrate de ejecutar la consulta dentro de esta condición
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE item_proveedor = :item_proveedor AND fecha BETWEEN :fechaInicial AND :fechaFinal ORDER BY fecha ASC");
                $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
                $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
                $stmt->bindParam(":item_proveedor", $nit, PDO::PARAM_STR);
            }
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }
}
