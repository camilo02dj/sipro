<?php

class ControladorCentros
{


	static public function ctrMostrarCentros($item, $valor)
	{

		$tabla = "centro_operacion"; 

		$respuesta = ModeloCentros::mdlMostrarCentros($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrCrearCentroOperacion() {

		if (isset($_POST["nuevoCentro"])) {
	
			// Validar entrada de "nuevoCentro"
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["nuevoCentro"])) {
	
				$tabla = "centro_operacion";
	
				// Recoger datos del formulario
				$datos = array(
					"codigo" => $_POST["nuevoCodigo"],
					"centro_operacion" => $_POST["nuevoCentro"],
					"depto" => $_POST["nuevoDepto"],
					"tipo" => $_POST["nuevoTipo"]
				);
	
				// Llamar al modelo para registrar el centro de operación
				$respuesta = ModeloCentros::mdlRegistrarCentroOperacion($tabla, $datos);
	
				// Mostrar mensaje según la respuesta
				if ($respuesta == "ok") {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Registro Exitoso",
								"Se ha creado correctamente el centro de operacion.",
								"success"
							).then((result) => {
								if (result.isConfirmed) {
									window.location = "centros-operacion";
								}
							});
						});
					</script>';
				} else {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Error",
								"Hubo un problema al registrar el centro de operacion.",
								"error"
							);
						});
					</script>';
				}
			} else {
				// Mensaje de error por validación fallida
				echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Error de Validación",
							"¡El centro no puede ir vacío o contener caracteres especiales!",
							"error"
						);
					});
				</script>';
			}
		}
	}

	static public function ctrBorrarCentro()
	{

		if (isset($_GET["codigoCentro"])) {

			$tabla = "centro_operacion";
			$datos = $_GET["codigoCentro"];

			$respuesta = ModeloCentros::mdlBorrarCentros($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire(
                        "Eliminacion Exitosa",
                        "Se ha eliminado correctamente el centro operacion",
                        "success").then(function(result) {
                        if (result.value) {
                            window.location = "centros-operacion";
                        }
                
                    });
                
                })

				</script>';
			}
		}
	}



	static public function ctrEditarCentroOperacion() {

		if (isset($_POST["editarCentro"])) {
	
			// Validar entrada de "nuevoCentro"
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["editarCentro"])) {
	
				$tabla = "centro_operacion";
	
				// Recoger datos del formulario
				$datos = array(
					"codigo" => $_POST["editarCodigo"],
					"centro_operacion" => $_POST["editarCentro"],
					"depto" => $_POST["editarDepto"],
					"tipo" => $_POST["editarTipo"]
				);
	
				// Llamar al modelo para registrar el centro de operación
				$respuesta = ModeloCentros::mdlEditarCentroOperacion($tabla, $datos);
	
				// Mostrar mensaje según la respuesta
				if ($respuesta == "ok") {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Registro Exitoso",
								"Se ha editado correctamente el centro de operacion.",
								"success"
							).then((result) => {
								if (result.isConfirmed) {
									window.location = "centros-operacion";
								}
							});
						});
					</script>';
				} else {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Error",
								"Hubo un problema al registrar el centro de operacion.",
								"error"
							);
						});
					</script>';
				}
			} else {
				// Mensaje de error por validación fallida
				echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Error de Validación",
							"¡El centro no puede ir vacío o contener caracteres especiales!",
							"error"
						);
					});
				</script>';
			}
		}
	}




}
	