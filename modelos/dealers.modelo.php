<?php

require_once "conexion.php";

class ModeloDealers
{


	static public function mdlMostrarDealers($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}


		$stmt = null;
	}


	static public function mdlRegistrarDealers($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nit, nombre, proveedor) VALUES (:nit, :nombre, :proveedor)");

		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}


	static public function mdlEditarDealers($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, nit = :nit WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}


	/*=============================================
	BORRAR DEALER
	=============================================*/

	static public function mdlBorrarDealers($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;

		
	}


	static public function mdlValidaDealers($tabla, $nit, $proveedor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nit = :nit AND proveedor = :proveedor");
        $stmt->bindParam(":nit", $nit, PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $proveedor, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();

        $stmt = null; 

        return $result;
    }
}
