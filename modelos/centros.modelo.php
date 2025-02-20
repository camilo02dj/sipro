<?php
require_once "conexion.php";

class ModeloCentros
{
    static public function mdlMostrarCentros($tabla, $item, $valor)
    {
        try {
            $db = Conexion::conectar();

            $stmt = $db->prepare($item != null ?
                "SELECT * FROM $tabla WHERE $item = :$item" :
                "SELECT * FROM $tabla");

            if ($item != null) {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }

            $stmt->execute();

            $resultado = $item != null ? $stmt->fetch() : $stmt->fetchAll();

            $stmt = null; 

            return $resultado;
        } catch (PDOException $e) {
            // Captura errores y registra el mensaje
            error_log("Error en mdlMostrarCentros: " . $e->getMessage());
            return "error";
        }
    }

    static public function mdlRegistrarCentroOperacion($tabla, $datos)
    {
        try {
            $db = Conexion::conectar();

            $stmt = $db->prepare("INSERT INTO $tabla (codigo, centro_operacion, depto, tipo) VALUES (:codigo, :centro_operacion, :depto, :tipo)");

            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":centro_operacion", $datos["centro_operacion"], PDO::PARAM_STR);
            $stmt->bindParam(":depto", $datos["depto"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Captura errores y registra el mensaje
            error_log("Error en mdlRegistrarCentroOperacion: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null; 
        }
    }

    static public function mdlEditarCentroOperacion($tabla, $datos)
    {
  
        try {
            $db = Conexion::conectar();

            $stmt = $db->prepare("UPDATE $tabla SET centro_operacion = :centro_operacion, depto = :depto, tipo = :tipo WHERE codigo = :codigo");

            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":centro_operacion", $datos["centro_operacion"], PDO::PARAM_STR);
            $stmt->bindParam(":depto", $datos["depto"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Captura errores y registra el mensaje
            error_log("Error en mdlEditarCentroOperacion: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null; 
        }
    }


    static public function mdlBorrarCentros($tabla, $datos)
    {
        try {
            $conexion = Conexion::conectar();
            $stmt = $conexion->prepare("DELETE FROM $tabla WHERE codigo = :codigo");

            $stmt->bindParam(":codigo", $datos, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                return "ok";
            } else {
                $errorInfo = $stmt->errorInfo();
                return [
                    "error" => "Error al ejecutar la consulta",
                    "details" => $errorInfo
                ];
            }
        } catch (PDOException $e) {
            return [
                "error" => "Error de base de datos",
                "details" => $e->getMessage()
            ];
        } catch (Exception $e) {
            return [
                "error" => "Error inesperado",
                "details" => $e->getMessage()
            ];
        } finally {
            if (isset($stmt)) {
                $stmt = null;
            }
            if (isset($conexion)) {
                $conexion = null;
            }
        }
    }
    



}
