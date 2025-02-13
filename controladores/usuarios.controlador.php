<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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

				if (is_array($respuesta) && $respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {
					if ($respuesta["estado"] == 1) {
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["cargo"] = $respuesta["cargo"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						date_default_timezone_set('America/Bogota');
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;
						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						// Verificar si es la primera vez que el usuario inicia sesión
						$primera_vez = $respuesta["primera_vez"]; // Asumimos que esta línea obtiene correctamente el valor de 'primera_vez'

						if ($ultimoLogin == "ok") {
							// Si es la primera vez (primera_vez == 0), redirigir a cambiar contraseña
							if ($primera_vez == 0) {
								echo '<script>window.location = "cambiar-pass";</script>';
							} else {
								// Si no es la primera vez, continuar a la página de ventas
								echo '<script>window.location = "ventas";</script>';
							}
						}
					} else {
						echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "El usuario no esta activado",
                        showConfirmButton: false,
                        timer: 1500
                        });
                    });
                    </script>';
					}
				} else {
					echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error de usuario y/o contraseña",
                        showConfirmButton: false,
                        timer: 1500
                        });
                    });
                    </script>';
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
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["nuevoUsuario"])

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
					"ultimo_login" => '1900-01-01'
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				if ($respuesta == "ok") {
					$mail = new PHPMailer(true);

					try {
						$nombre = $_POST["nuevoNombre"];
						$usuario = $_POST["nuevoUsuario"];
						$pass = $_POST["password"];
						$mail->SMTPDebug = 0; // Disable Debugging in production
						$mail->isSMTP();
						$mail->Host = 'webmail.sucampo.com.co';
						$mail->SMTPAuth = true;
						$mail->Username = 'camilohernandez@sucampo.com.co';
						$mail->Password = 'W0lf4ng.2145'; // Cambia 'tu_contraseña' por la contraseña real
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
						$mail->Port = 25;

						$mail->setFrom('camilohernandez@sucampo.com.co', 'SIPRO - Sistema de Informacion Proveedores');
						$mail->addAddress($_POST["nuevoEmail"], $_POST["nuevoNombre"]);

						$mail->isHTML(true);
						$mail->Subject = 'Acceso a SIPRO - SucampoSullanta SAS';
						$mail->Body = '<table style="width: 500px; margin: auto; text-align: left; font-family: sans-serif;">
						   <tr>
							   <td><img style="width: 130px;" src="https://servicios.sucampo.com.co/vistas/img/logo.jpg" alt=""></td>
						   </tr>
						   <tr>
							   <td style="font-size: 30px;">SIPRO - SucampoSullanta</td>
						   </tr>
						   <tr>
							   <td><hr></td>
						   </tr>
						   <tr>
							   <td style="padding: 11px 0;">Hola, ' . $nombre . ' Bienvenido al sistema SIPRO, la plataforma web desarrollada por Sucampo-Sullanta SAS, desarrollada exclusivamente para facilitarte la consulta de las unidades vendidas. Para garantizar un acceso seguro y personalizado, se te ha asignado un usuario unico para la plataforma.</td>
						   </tr>
						   <tr>
							   <td>Usuario:' . $usuario . '</td>
						   </tr>
						   <tr>
							   <td>Password: <span>' . $pass . '</span></td>
						   </tr>
						   <tr>
							   <td><a style="background: #01d06a; color: #fff; padding: 10px 15px; margin: 23px auto; width: 150px; border: 2px solid #00a554; text-decoration: none; display: block; border-radius: 8px; text-align: center; font-size: 20px;
								   " href="https://servicios.sucampo.com.co/sipro/">Ir Aplicacion</a></td>
						   </tr>
					   </table>';
						//$mail->AltBody = 'Esta es la versión en texto plano del correo electrónico para clientes que no aceptan HTML';

						$mail->send();
					} catch (Exception $e) {
						// Considera manejar este error de manera que informe al usuario/administrador
						echo 'El mensaje no pudo ser enviado. Error: ', $mail->ErrorInfo;
					}

					// Mensaje de éxito al crear el usuario
					echo '<script>
					   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Registro Exitoso",
						   "Se ha creado correctamente el usuario y se ha enviado un correo electrónico.",
						   "success"
					   ).then((result) => {
						   if (result.isConfirmed) {
							   window.location = "usuarios";
						   }
					   });
					})
					   </script>';
				} else {
					// Mensaje de error al crear el usuario
					echo '<script>
					   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Error",
						   "Hubo un problema al crear el usuario.",
						   "error"
					   );
					})
					   </script>';
				}
			} else {
				// Validación fallida
				echo '<script>
				   document.addEventListener("DOMContentLoaded", function() {
				   Swal.fire(
					   "Error de Validación",
					   "¡El usuario no puede ir vacío o llevar caracteres especiales!",
					   "error"
				   );
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

			if (preg_match('/^.+$/s', $_POST["editarNombre"])) {



				$tabla = "usuarios";


				$datos = array(

					"nombre" => $_POST["editarNombre"],
					"usuario" => $_POST["editarUsuario"],
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
			$pass = $passBd["password"];

			// Verificar que la contraseña antigua es correcta
			if ($pass != $passworAnterior) {
				echo '<script>
				   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Error de Validación",
						   "La contraseña anterior no es válida",
						   "error"
					   ).then(function(result) {
						   if (result.value) {
							   window.location = "cambiar-pass";
						   }
					   });
				   });
				   </script>';
			} else {
				// Verificar que la nueva contraseña no sea igual a la antigua
				if ($pass == $encriptar) {
					echo '<script>
				   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Error",
						   "La nueva contraseña no puede ser igual a la contraseña anterior",
						   "error"
					   );
				   });
				   </script>';
				} else {
					// Proceder con el cambio de contraseña
					$datos = array(
						"usuario" => $_SESSION["usuario"], // Asegúrate de que este sea el nombre de usuario correcto a actualizar
						"password" => $encriptar
					);

					$respuesta = ModeloUsuarios::mdlCambiarPass($tabla, $datos);

					if ($respuesta == "ok") {
						echo '<script>
						   document.addEventListener("DOMContentLoaded", function() {
							   Swal.fire(
								   "Cambio de contraseña OK",
								   "Se ha cambiado la contraseña exitosamente, vuelve a iniciar sesión con tu nueva contraseña",
								   "success"
							   ).then(function(result) {
								   if (result.value) {
									   window.location = "salir";
								   }
							   });
						   });
						   </script>';
					}
				}
			}
		}
	}



	/*=============================================
	  OLVIDO CONTRASEÑA
	  =============================================*/

	  static public function ctrOlvidoP()
	  {
		  if (isset($_POST["nuevoOlvido"])) {
			  $tabla = "usuarios";
			  $pass = bin2hex(random_bytes(3));  // Genera una contraseña de 6 caracteres aleatorios
			  $encriptar = crypt($pass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			  $usuario = $_POST["nuevoOlvido"];
			  $consulta = ModeloUsuarios::mdlMostrarUsuarios("usuarios","usuario", $usuario);
			  $email = $consulta["email"];
	  
			  $datos = array(
				  "usuario" => $usuario,
				  "password" => $encriptar
			  );
	  
			  $respuesta = ModeloUsuarios::mdlOlvidoPass($tabla, $datos);
	  
			  if ($respuesta == "ok") {
				  
				  $mail = new PHPMailer(true);
				  try {
					$mail->SMTPDebug = 0;
					$mail->isSMTP();
					$mail->Host = 'webmail.sucampo.com.co';
					$mail->SMTPAuth = true;
					$mail->Username = 'camilohernandez@sucampo.com.co';
					$mail->Password = 'W0lf4ng.2145'; 
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
					$mail->Port = 25;
					$mail->CharSet = 'UTF-8';

					$mail->setFrom('camilohernandez@sucampo.com.co', 'SIPRO - Sistema de Informacion Proveedores');
					$mail->addAddress($email, $usuario);

					$mail->isHTML(true);
					$mail->Subject = 'Acceso a SIPRO - SucampoSullanta SAS';
					$mail->Body = '<table style="width: 500px; margin: auto; text-align: left; font-family: sans-serif;">
					   <tr>
						   <td><img style="width: 130px;" src="https://servicios.sucampo.com.co/vistas/img/logo.jpg" alt=""></td>
					   </tr>
					   <tr>
						   <td style="font-size: 30px;">SIPRO - SucampoSullanta</td>
					   </tr>
					   <tr>
						   <td><hr></td>
					   </tr>
					   <tr>
						   <td style="padding: 11px 0;">Se ha restablecido la contraseña para el usuario: '.$usuario.' su nueva contraseña de acceso es: '.$pass.'</td>
					   </tr>
					   <tr>
						   <td><a style="background: #01d06a; color: #fff; padding: 10px 15px; margin: 23px auto; width: 150px; border: 2px solid #00a554; text-decoration: none; display: block; border-radius: 8px; text-align: center; font-size: 20px;
							   " href="https://servicios.sucampo.com.co/sipro/">Ir Aplicacion</a></td>
					   </tr>
				   </table>';
					//$mail->AltBody = 'Esta es la versión en texto plano del correo electrónico para clientes que no aceptan HTML';

					$mail->send();
				} catch (Exception $e) {
					// Considera manejar este error de manera que informe al usuario/administrador
					echo 'El mensaje no pudo ser enviado. Error: ', $mail->ErrorInfo;
				}
	  
				  echo '<script>
						   document.addEventListener("DOMContentLoaded", function() {
							   Swal.fire(
								   "Restablecimiento Contraseña OK",
								   "Se restablecio su contraseña y se ha enviado al correo electrónico: '.$email.'",
								   "success"
							   ).then(function(result) {
								   if (result.value) {
									   window.location = "salir";
								   }
							   });
						   });
					   </script>';
			  }
		  }
	  }


	/*=============================================
	CAMBIAR CONTRASEÑA DESDE ADMIN
	=============================================*/

	static public function ctrCambiarPassAdmin()
	{
		if (isset($_POST["password"])) {
			$tabla = "usuarios";
			$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$datos = array(
				"usuario" => $_POST["usuario"],
				"password" => $encriptar
			);

			$respuesta = ModeloUsuarios::mdlCambiarPassAdmin($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
				   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Cambio de contraseña OK",
						   "Se ha cambiado la contraseña exitosamente",
						   "success"
					   ).then(function(result) {
						   if (result.value) {
							   window.location = "usuarios";
						   }
					   });
				   });
				   </script>';
			}
		}
	}
	  
}
