<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if (is_array($respuesta) &&  $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

					if ($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["cargo"] = $respuesta["cargo"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						/*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

						date_default_timezone_set('America/Bogota');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if ($ultimoLogin == "ok") {

							echo '<script>

								window.location = "inicio";

							</script>';
						}
					} else {

						echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';
					}
				} else {

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoUsuario"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoUsuario"])

			) {


				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"cargo" => $_POST["nuevoCargo"],
					"email" => $_POST["nuevoEmail"],
					"nombre" => $_POST["nuevoNombre"],
					"usuario" => $_POST["nuevoUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["nuevoPerfil"],
					"ultimo_login"=> '1900-01-01'
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					$nombre = $_POST["nuevoNombre"];
					$email = $_POST["nuevoEmail"];
					$usuario = $_POST["nuevoUsuario"];
					$pass = $_POST["password"];

					$destinatario = "$email";
					$asunto = "Acceso a plataforma Sanidad Vegetal Cruz Verde ";
					$cuerpo = '
				<table style="width: 500px; margin: auto; text-align: left; font-family: sans-serif;">
					<tr>
						<td><img style="width: 130px;" src="https://app.sanidadvegetalcruzverde.com/vistas/img/logo_avion.jpg" alt=""></td>
					</tr>
					<tr>
						<td style="font-size: 30px;">Sanidad Vegetal CRUZ VERDE</td>
					</tr>
					<tr>
						<td><hr></td>
					</tr>
					<tr>
						<td style="padding: 11px 0;">Hola, ' . $nombre . ' Bienvenido al equipo Sanidad Vegetal Cruz Verde!, se te ha asignado un usuario para el acceso a la plataforma:</td>
					</tr>
					<tr>
						<td>Usuario:' . $usuario . '</td>
					</tr>
					<tr>
						<td>Password: <span>' . $pass . '</span></td>
					</tr>
					<tr>
						<td><a style="background: #01d06a; color: #fff; padding: 10px 15px; margin: 23px auto; width: 150px; border: 2px solid #00a554; text-decoration: none; display: block; border-radius: 8px; text-align: center; font-size: 20px;
							" href="https://app.sanidadvegetalcruzverde.com/">Ir Aplicacion</a></td>
					</tr>
				</table>';
					//para el envío en formato HTML 
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

					//dirección del remitente 
					$headers .= "From: Sistema Cartera Sucampo Sullanta SAS <info@sanidadvegetalcruzverde.com>\r\n";

					mail($destinatario, $asunto, $cuerpo, $headers);

					echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Registro Exitoso",
							"Se ha creado correctamente el usuario",
							"success").then(function(result) {
							if (result.value) {
								window.location = "usuarios";
							}
					
						});
					
					})
					</script>';
				}
			} else {

				echo '<script>
				document.addEventListener("DOMContentLoaded", function() {
					Swal.fire(
					"Error de Validacion",
					"¡El usuario no puede ir vacío o llevar caracteres especiales!",
					"error").then(function(result) {
						if (result.value) {
							window.location = "usuarios";
						}
				
					});
				
				})
			</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {


				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[\s\S]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Error",
								"La contraseña no puede ir vacia",
								"error").then(function(result) {
								if (result.value) {
									window.location = "usuarios";
								}
						
							});
						
						})
						</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					
					"nombre" => $_POST["editarNombre"],
					"usuario" => $_POST["editarUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["editarPerfil"],
					"cargo" => $_POST["editarCargo"],
					"email" => $_POST["editarEmail"]
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Edicion Exitosa",
							"Se ha editado correctamente el usuario",
							"success").then(function(result) {
							if (result.value) {
								window.location = "usuarios";
							}
					
						});
					
					})
					</script>';
				}
			} else {

				echo '<script>
				document.addEventListener("DOMContentLoaded", function() {
					Swal.fire(
					"Error de Validacion",
					"¡El usuario no puede ir vacío o llevar caracteres especiales!",
					"error").then(function(result) {
						if (result.value) {
							window.location = "usuarios";
						}
				
					});
				
				})
			</script>';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario()
	{

		if (isset($_GET["idUsuario"])) {

			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") {

				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $_GET["usuario"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire(
                        "Eliminacion Exitosa",
                        "Se ha eliminado correctamente el usuario",
                        "success").then(function(result) {
                        if (result.value) {
                            window.location = "usuarios";
                        }
                
                    });
                
                })

				</script>';
			}
		}
	}

	/*=============================================
ACTUALIZAR CONTRASEÑA
=============================================*/

	static public function ctrActualizarPass()
	{

		if (isset($_POST["nuevoPassword"])) {

				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$passworAnterior = crypt($_POST["passwordAnterior"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$usuario = $_SESSION["usuario"];

				$passBd = ModeloUsuarios::mdlPassActual("usuarios", "usuario", $usuario);

				$pass= $passBd["password"];


				if ($pass != $passworAnterior) {

					echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Error de Validacion",
							"La contraseña anterior no es valida",
							"error").then(function(result) {
							if (result.value) {
								window.location = "cambiar-pass";
							}
					
						});
					
					})
					</script>';
				} else {

					$datos = array(
						"usuario" => $_POST["nuevoUsuario"],
						"password" => $encriptar
					);

					$respuesta = ModeloUsuarios::mdlCambiarPass($tabla, $datos);

					if ($respuesta == "ok") {

						echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Cambio de contraseña OK",
								"Se ha cambiado la contraseña exitosamente",
								"success").then(function(result) {
								if (result.value) {
									window.location = "salir";
								}
						
							});
						
						})
						</script>';
					}
				}
			
		}
	}
}