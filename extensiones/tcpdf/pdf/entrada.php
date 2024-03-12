<?php

require_once "../../../controladores/entradas.controlador.php";
require_once "../../../modelos/entradas.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/componentes.controlador.php";
require_once "../../../modelos/componentes.modelo.php";

require_once "../../../controladores/bases.controlador.php";
require_once "../../../modelos/bases.modelo.php";

class imprimirEntrada
{

	public $codigo;

	public function traerImpresionEntrada()
	{

		//TRAEMOS LA INFORMACIÓN DE LA COTIZACION

		$itemEntrada = "codigo";
		$valorEntrada = $this->codigo;

		$respuestaEntrada = ControladorEntradas::ctrMostrarEntradas($itemEntrada, $valorEntrada);

		$fecha = $respuestaEntrada["fecha"];
		$componentes = json_decode($respuestaEntrada["componentes"], true);

		//TRAEMOS LA INFORMACIÓN DEL PROVEEDOR

		$itemProveedor = "id";
		$valorProveedor = $respuestaEntrada["id_proveedor"];

		$respuestaProveedor = ControladorProveedores::ctrMostrarProveedores($itemProveedor, $valorProveedor);

		//TRAEMOS LA INFORMACIÓN DE LA BASE

		$itemBase = "id";
		$valorBase = $respuestaEntrada["id_base"];

		$respuestaBase = ControladorBases::ctrMostrarBases($itemBase, $valorBase);

		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');


		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage('L', 'A4');


		//$img_file = K_PATH_IMAGES.'bg-cotizacion-pdf.jpg';		
		//$pdf->Image($img_file, 0, 0, 235, 297, '', '', '', false, 300, '', false, false, 0);
		   
		$pdf->setPageMark();
        $pdf->setPrintFooter(false);


		

		// ---------------------------------------------------------

		$bloque1 = <<<EOF
		
	<table style="whidth:100%; border: 1px solid #666">
		
		<tr>
		    <td style="width:80px; border:1px solid #666"><img src="images/logo_avion.png"></td>

			<td aling="left" style=" width:530px">
				
				<div style="font-size:10px; text-align:center; line-height:15px;">
					SANIDAD VEGETAL CRUZ VERDE S.A.S
					<br>
					MANUAL GENERAL DE MANTENIMIENTO
					<br>
					ANEXO D - FORMATOS
					<br>
					D.1.12.  INSPECCIÓN DE RECIBIDO DE COMPONENTES

				</div>

			</td>

			<td style=" width:180px; border:1px solid #666">

				<div style="font-size:10px; text-align:left; line-height:15px;">
					
					Revisión: 4
					<br>
					Fecha: Agosto - 2022.
					
					<br>
					Código: SVF-M-008

				</div>
				
			</td>
       
		</tr>

	</table>
	
EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

		<br><br>
	<table style="font-size:10px; padding:5px 5px;">
	
		<tr>
		
			<td style="border: 1px solid #666; width:220px;">

				Base: $respuestaBase[base]

			</td>

			<td style="border: 1px solid #666; width:100px; text-align:left">
			
				Fecha: $fecha

			</td>
			<td style="border: 1px solid #666; width:320px; text-align:left">
			
				Nombre del Proveedor: $respuestaProveedor[nombre] 

			</td>
			<td style="border: 1px solid #666; width:150px; text-align:left">
			
				Entrada Nº: $valorEntrada 

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; width:540px"></td>

		</tr>


	</table>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

	<table style="font-size:5px; padding:5px 5px;">

		<tr>
		
		<td  rowspan="2"  style="border: 1px solid #666; width:50px; text-align:center">CANT</td>
        <td  rowspan="2"  style="border: 1px solid #666; width:190px; text-align:center">COMPONENTE</td>
		<td  rowspan="2"  style="border: 1px solid #666; width:80px; text-align:center">MARCA</td>
		<td  rowspan="2"  style="border: 1px solid #666; width:90px; text-align:center">MODELO</td>
        <td  rowspan="2"  style="border: 1px solid #666; width:20px; text-align:center">S/N</td>
		<td  rowspan="2"  style="border: 1px solid #666; width:100px; text-align:center">DOCUMENTACIÓN SOPORTE DE TRAZABILIDAD </td>
		<td colspan="2"  style="border: 1px solid #666; width:50px; text-align:center">ESTADO ELEMENTO</td>
		<td  rowspan="2" style="border: 1px solid #666; width:100px; text-align:center">OBSERVACIONES</td>
		<td colspan="2"  style="border: 1px solid #666; width:100px; text-align:center">FIRMA APROBACION</td>

		</tr>
		<tr>
			<td style="border: 1px solid #666; width:25px; text-align:center">Bueno</td>
			<td style="border: 1px solid #666; width:25px; text-align:center">Malo</td>

			<td style="border: 1px solid #666; width:50px; text-align:center">Almacenista</td>
			<td style="border: 1px solid #666; width:50px; text-align:center">GAC</td>
		</tr>

	</table>
	

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------

		
		foreach ($componentes as $key => $item) {

			$estado= $item ["estado"];

			if($estado == "B"){

				$b= "X";
				$m ="";
			}else{
				$b="";
				$m="X";
			}

			$bloque4 = <<<EOF

			<table style="font-size:8px; padding:5px 5px;">

		<tr>
		
		<td  style="border: 1px solid #666; width:50px; text-align:center">$item[cantidad]</td>
        <td  style="border: 1px solid #666; width:190px; text-align:center">$item[descripcion]</td>
		<td  style="border: 1px solid #666; width:80px; text-align:center">$item[marca]</td>
		<td  style="border: 1px solid #666; width:90px; text-align:center">$item[modelo]</td>
        <td  style="border: 1px solid #666; width:20px; text-align:center"></td>
		<td  style="border: 1px solid #666; width:100px; text-align:center">$item[documentos]</td>
		<td  style="border: 1px solid #666; width:25px; text-align:center">$b</td>
		<td  style="border: 1px solid #666; width:25px; text-align:center">$m</td>
		<td  style="border: 1px solid #666; width:100px; text-align:center">$item[observaciones]</td>
		<td  style="border: 1px solid #666; width:50px; text-align:center"></td>
		<td  style="border: 1px solid #666; width:50px; text-align:center"></td>

		</tr>

	</table>


EOF;

			$pdf->writeHTML($bloque4, false, false, false, false, '');
		
		}

		if($respuestaEntrada["estado"]==0){
			$bloque5 = <<<EOF

			<table style="font-size:100px; padding:5px 5px;">
			<tr>
				<td>
				
				Anulada
				</td>
			</tr>
			</table>
	
	EOF;
	
				$pdf->writeHTML($bloque5, false, false, false, false, '');

		}else{
			
		}

	
		// ---------------------------------------------------------
		


		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('cotizacion.pdf', 'D');
		$pdf->Output('entrada.pdf');
	

	}
}
$entrada = new imprimirEntrada();
$entrada->codigo = $_GET["codigo"];
$entrada->traerImpresionEntrada();
