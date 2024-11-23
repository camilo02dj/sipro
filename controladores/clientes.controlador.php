<?php

class ControladorClientes{

    static public function ctrMostrarClientes($item, $valor){
        $tabla = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }


    static public function ctrCrearCliente() {

		if (isset($_POST["nuevoCliente"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["razon_social"])) {
	
				$tabla = "clientes";
	
				// Recoger datos del formulario
				$datos = array(
					"codigo" => $_POST["nuevoCliente"],
					"nit" => $_POST["nuevoNit"],
					"razon_social" => $_POST["nuevaRazonSocial"]
					
				);
				$respuesta = ModeloClientes::mdlCrearCliente($tabla, $datos);
	
				// Mostrar mensaje según la respuesta
				if ($respuesta == "ok") {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Registro Exitoso",
								"Se ha creado correctamente el cliente.",
								"success"
							).then((result) => {
								if (result.isConfirmed) {
									window.location = "clientes";
								}
							});
						});
					</script>';
				} else {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Error",
								"Hubo un problema al registrar el cliente.",
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
							"¡El cliente no puede ir vacío o contener caracteres especiales!",
							"error"
						);
					});
				</script>';
			}
		}
	}

	static public function ctrBorrarCliente()
	{

		if (isset($_GET["codigoCliente"])) {

			$tabla = "clientes";
			$datos = $_GET["codigoCliente"];

			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire(
                        "Eliminacion Exitosa",
                        "Se ha eliminado correctamente el cliente",
                        "success").then(function(result) {
                        if (result.value) {
                            window.location = "clientes";
                        }
                
                    });
                
                })

				</script>';
			}
		}
	}



	static public function ctrEditarCliente() {

		if (isset($_POST["editarCliente"])) {
	
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["editarCliente"])) {
	
				$tabla = "clientes";
	
				// Recoger datos del formulario
				$datos = array(
					"codigo" => $_POST["editarCliente"],
					"nit" => $_POST["editarNit"],
					"razon_social" => $_POST["editarRazonSocial"]
				);
	
				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);
	
				// Mostrar mensaje según la respuesta
				if ($respuesta == "ok") {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Registro Exitoso",
								"Se ha editado correctamente el cliente.",
								"success"
							).then((result) => {
								if (result.isConfirmed) {
									window.location = "clientes";
								}
							});
						});
					</script>';
				} else {
					echo '<script>
						document.addEventListener("DOMContentLoaded", function() {
							Swal.fire(
								"Error",
								"Hubo un problema al registrar el cliente.",
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
							"¡El cliente no puede ir vacío o contener caracteres especiales!",
							"error"
						);
					});
				</script>';
			}
		}
	}

}