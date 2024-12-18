<?php

class Conexion {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=localhost;dbname=sipro', 'root', '');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit('Error: ' . $e->getMessage());
        }
    }

    public static function conectar() {
        if (!self::$instancia) {
            self::$instancia = new Conexion();
        }
        return self::$instancia->conexion;
    }
}

