<?php

class Conexion {
    // Almacenamos la única instancia de PDO
    private static $instancia = null;

    // Constructor privado para prevenir la creación de múltiples instancias
    private function __construct() {
        // Constructor vacío o configuración inicial si es necesario
    }

    // Método para obtener la instancia de la conexión
    public static function conectar() {
        if (self::$instancia === null) {
            // Si aún no existe una instancia, la creamos
            $opciones = array(
                PDO::ATTR_PERSISTENT => true,  // Conexión persistente
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  // Activar excepciones para errores
            );

            try {
                self::$instancia = new PDO('mysql:host=localhost;dbname=sipro', 'root', '', $opciones);
                self::$instancia->exec("set names utf8");  // Aseguramos la codificación utf8
            } catch (PDOException $e) {
                die('Error al conectar con la base de datos: ' . $e->getMessage());
            }
        }
        // Devolvemos la instancia existente
        return self::$instancia;
    }

    // Método para cerrar la conexión
    public static function cerrar() {
        self::$instancia = null;  // Cerramos la conexión estableciendo la instancia a null
    }
}

?>
