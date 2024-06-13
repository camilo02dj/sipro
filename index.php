<?php

require 'vendor/autoload.php';



require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/centros.controlador.php";
require_once "controladores/inventarios.controlador.php";




require_once "modelos/usuarios.modelo.php";
require_once "modelos/conexion.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/centros.modelo.php";
require_once "modelos/inventarios.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();