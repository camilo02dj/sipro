<?php

class ControladorDealers
{


	static public function ctrMostrarDealers($item, $valor)
	{

		$tabla = "dealers";

		$respuesta = ModeloDealers::mdlMostrarDealers($tabla, $item, $valor);

		return $respuesta;
	}


	static public function ctrValidarDealer($nit, $proveedor)
	{

		$tabla = "dealers";

		$respuesta = ModeloDealers::mdlValidaDealers($tabla, $nit, $proveedor);

		return $respuesta;
	}



    static public function ctrCrearDelears()
	{
		if (isset($_POST["nuevoDealer"])) {
			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ .\-_]+$/', $_POST["nuevoDealer"])

			) {
				$tabla = "dealers";

				$datos = array(
					"nit" => $_POST["nuevoNitD"],
					"nombre" => $_POST["nuevoDealer"],
					"proveedor"=> $_POST["proveedor"]
				);

				$respuesta = ModeloDealers::mdlRegistrarDealers($tabla, $datos);

				if ($respuesta == "ok") {
				
					// Mensaje de éxito al crear el usuario
					echo '<script>
					   document.addEventListener("DOMContentLoaded", function() {
					   Swal.fire(
						   "Registro Exitoso",
						   "Se ha creado correctamente el dealer.",
						   "success"
					   ).then((result) => {
						   if (result.isConfirmed) {
							   window.location = "dealers";
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
						   "Hubo un problema al crear el dealer.",
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
					   "¡El dealer no puede ir vacío o llevar caracteres especiales!",
					   "error"
				   );
				})
				   </script>';
			}
		}
	}


	static public function ctrEditarDealer()
	{

		if (isset($_POST["editarDealer"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreD"])) {


				$tabla = "dealers";

				$datos = array(

					"id" => $_POST["editarDealer"],
					"nombre" => $_POST["editarNombreD"]
				);

				$respuesta = ModeloDealers::mdlEditarDealers($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Edicion Exitosa",
							"Se ha editado correctamente el dealer",
							"success").then(function(result) {
							if (result.value) {
								window.location = "dealers";
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
					"¡El dealer no puede ir vacío o llevar caracteres especiales!",
					"error").then(function(result) {				
					});
				
				})
			</script>';
			}
		}
	}


	static public function ctrBorrarDealer()
	{

		if (isset($_GET["idDealer"])) {

			$tabla = "dealers";
			$datos = $_GET["idDealer"];

			$respuesta = ModeloDealers::mdlBorrarDealers($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire(
                        "Eliminacion Exitosa",
                        "Se ha eliminado correctamente el dealer",
                        "success").then(function(result) {
                        if (result.value) {
                            window.location = "dealers";
                        }
                
                    });
                
                })

				</script>';
			}
		}
	}






}