<?php

class ControladorTraslados
{

	/*=============================================
	MOSTRAR TRASLADOS
	=============================================*/

	static public function ctrMostrarTraslados($item, $valor)
	{

		$tabla = "traslados";

		$respuesta = ModeloTraslados::mdlMostrarTraslados($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	CREAR TRASLADO
	=============================================*/

	static public function ctrCrearTraslado()
	{

		if (isset($_POST["nuevoTraslado"])) {

			/*=============================================
      ACTUALIZAR LAS ENTRADAS DEL CLIENTE Y AUMENTAR EL STOCK Y AUMENTAR LAS VENTAS DE LOS COMPONENTES
      =============================================*/

			if ($_POST["listaComponentesTraslados"] == "") {

				echo '<script>

        swal({
            type: "error",
            title: "El traslado no se ha ejecuta si no hay componentes",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "registrar-traslado";

                }
              })

        </script>';

				return;
			}


			$listaComponentesTraslados = json_decode($_POST["listaComponentesTraslados"], true);

			$totalComponentesTraslados = array();

			foreach ($listaComponentesTraslados as $key => $value) {

				array_push($totalComponentesTraslados, $value["cantidad"]);

				$idBase = $_SESSION["id_base"];
				$baseDestino = $_POST["nuevaBase"];

				if ($baseDestino == 1) {

					$tablaComponentes = "componentes";
					$item = "id";
					$valor = $value["id"];
					$item2 = "id_componente";
					$orden = "id";
					$traerComponente = ModeloComponentes::mdlMostrarComponentes($tablaComponentes, $item, $valor, $orden);
					$item1b = "stock";
					$valor1b = $traerComponente["stock"] + $value["cantidad"];
					$nuevoStock = ModeloComponentes::mdlActualizarComponente($tablaComponentes, $item1b, $valor1b, $valor);
					$traerComponenteReal = ModeloTraslados::mdlMostrarComponentesTraslados("componentes_t", $item2, $valor, $idBase);
					$valorC = $traerComponenteReal["stock"] - $value["cantidad"];
					$actInventario = ModeloTraslados::mdlActualizarTraslado("componentes_t", $item1b, $valorC, $valor, $idBase);
				} else {

					$tablaComponentes = "componentes_t";
					$item = "id";
					$item2 = "id_componente";
					$valor = $value["id"];
					$orden = "id";

					$traerComponente = ModeloTraslados::mdlMostrarComponentesTraslados($tablaComponentes, $item2, $valor, $baseDestino);

					$traerComponenteReal = ModeloComponentes::mdlMostrarComponentes("componentes", $item, $valor, $orden);

					$item1b = "stock";
					$valor1b = $traerComponenteReal["stock"] - $value["cantidad"];
					$item1C = "stock";
					if (is_array($value["cantidad"])) {
						$valor1C = $value["cantidad"] + $traerComponente["stock"];
					}
					if (is_array($traerComponente)) {
						$valor1C = $value["cantidad"] + $traerComponente["stock"];
					}
					$nuevoStockReal = ModeloComponentes::mdlActualizarComponente("componentes", $item1b, $valor1b, $valor);

					if (empty($traerComponente)) {

						$traslados = array(
							"id_base" => $_POST["nuevaBase"],
							"id_componente" => $value["id"],
							"stock" => $value["cantidad"],
						);

						$registrarComponente = ModeloTraslados::mdlRegistrarComponenteTraslado($tablaComponentes, $traslados);
					} else {

						$registrarComponente = ModeloTraslados::mdlActualizarTraslado($tablaComponentes, $item1C, $valor1C, $valor, $baseDestino);
					}
				}
			}

			$tabla = "traslados";
			$codigo = $_POST["nuevoTraslado"];

			$datos = array(
				"codigo" => $_POST["nuevoTraslado"],
				"fecha" => $_POST["nuevaFecha"],
				"componentes" => $_POST["listaComponentesTraslados"],
				"id_base" => $_POST["nuevaBase"],
			);

			$respuesta = ModeloTraslados::mdlIngresarTraslado($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Registro exitoso",
                    text: "¿Desde imprimir el comprobante de traslado?",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "No",
                    confirmButtonText: "Imprimir!"
                }).then(function(result) {
                    if (result.value) {
            
                        window.open("extensiones/tcpdf/pdf/traslados.php?codigoTraslado=" + ' . $codigo . ', "_blank");
                        window.location = "traslados";
                    }else{
                        window.location = "traslados";
                    }

            
                });
            
            })
            </script>';
			} else {

				echo '<script>
				document.addEventListener("DOMContentLoaded", function() {
					Swal.fire(
					"Error de Validacion",
					"¡Se presento un error al realizar el traslado",
					"error").then(function(result) {
						if (result.value) {
							window.location = "proveedores";
						}
				
					});
				
				})
			</script>';
			}
		}
	}
	/*=============================================
	EDITAR TRASLADO
	=============================================*/

	static public function ctrEditarTraslado()
	{

		if (isset($_POST["editarIdBase"])) {

			if (

				preg_match('/^[0-9.]+$/', $_POST["editarIdBase"])
			) {

				$tabla = "traslados";

				$datos = array(
					"id" => $_POST["idTraslado"],
					"codigo" => $_POST["editarCodigo"],
					"id_base" => $_POST["editarBase"],
					"fecha" => $_POST["editarFecha"],
					"componentes" => $_POST["editarListaComponentes"]
				);

				$respuesta = ModeloTraslados::mdlEditarTraslado($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>
					document.addEventListener("DOMContentLoaded", function() {
						Swal.fire(
							"Registro Exitoso",
							"Se ha editado correctamente el traslado",
							"success").then(function(result) {
							if (result.value) {
								window.location = "traslados";
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
							"¡El traslado no puede ir vacío o llevar caracteres especiales!",
							"error").then(function(result) {
								if (result.value) {
									window.location = "traslados";
								}
						
							});
						
						})
					</script>';
			}
		}
	}

	static public function ctrAnluarTraslado()
	{

		if (isset($_GET["idTraslado"])) {

			$tabla = "traslados";
			$idTraslado = $_GET["idTraslado"];

			$itemE = "id";
			$valor = $idTraslado;

			$traslados = ModeloTraslados::mdlMostrarTraslados($tabla, $itemE, $valor);

			$componentes = json_decode($traslados["componentes"], true);

			$totalComponentesTraslados = array();

			foreach ($componentes as $key => $value) {

				array_push($totalComponentesTraslados, $value["cantidad"]);

				$tablaComponentes = "componentes";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerComponente = ModeloComponentes::mdlMostrarComponentes($tablaComponentes, $item, $valor, $orden);


				$item1b = "stock";
				$valor1b = $traerComponente["stock"] + $value["cantidad"];

				$nuevoStock = ModeloComponentes::mdlActualizarComponente($tablaComponentes, $item1b, $valor1b, $valor);
			}

			$datos = array(
				"id" => $idTraslado,
				"estado" => 0
			);

			$respuesta = ModeloTraslados::mdlAnularTraslado($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire(
                        "Eliminacion Exitosa",
                        "Se ha anulado correctamente el traslado",
                        "success").then(function(result) {
                        if (result.value) {
                            window.location = "traslados";
                        }
                
                    });
                
                })

				</script>';
			}
		}
	}

	static public function ctrMostrarComponentesT($item, $valor)
	{

		$tabla = "componentes_t";

		$respuesta = ModeloTraslados::mdlMostrarcomponentesT($tabla, $item, $valor);

		return $respuesta;
	}
}
