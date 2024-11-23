<?php
require_once "conexion.php";

class ModeloClientes{

    static public function mdlMostrarClientes($tabla, $item, $valor){

        if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}


		$stmt = null;
    }


	static public function mdlCrearCliente($tabla, $datos)
    {
        try {
            $db = Conexion::conectar();

            $stmt = $db->prepare("INSERT INTO $tabla (codigo, nit, razon_social) VALUES (:codigo, :nit, :razon_social)");

            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
            $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            error_log("Error en mdlRegistrarCentroOperacion: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null; 
        }
    }

    static public function mdlEditarCliente($tabla, $datos)
    {
  
        try {
            $db = Conexion::conectar();

            $stmt = $db->prepare("UPDATE $tabla SET  razon_social = :razon_social WHERE codigo = :codigo");

            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
            $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);


            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            error_log("Error en mdlEditarCentroOperacion: " . $e->getMessage());
            return "error";
        } finally {
            $stmt = null; 
        }
    }


    static public function mdlBorrarCliente($tabla, $datos)
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