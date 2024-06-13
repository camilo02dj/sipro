<?php

require_once 'conexion.php';
class ModeloInventario
{

	static public function mdlMostrarInventarios($tabla, $item, $valor)
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

	static public function mdlFechaInventario($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT MAX(fecha) as fecha FROM $tabla");
		$stmt->execute();

		return $stmt->fetch();

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}


		$stmt = null;
	}
}
