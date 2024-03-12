<?php

require_once "../../../controladores/salidas.controlador.php";
require_once "../../../modelos/salidas.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/componentes.controlador.php";
require_once "../../../modelos/componentes.modelo.php";

require_once "../../../controladores/bases.controlador.php";
require_once "../../../modelos/bases.modelo.php";

require_once "../../../controladores/salida-componente.controlador.php";
require_once "../../../modelos/salida-componente.modelo.php";

require_once "../../../controladores/maquinas.controlador.php";
require_once "../../../modelos/maquinas.modelo.php";

class imprimirSalida
{

	public $codigo;

	public function traerImpresionSalida()
	{

		$itemSalida = "codigo";
		$valorSalida = $this->codigo;

		$respuestaSalida = ControladorSalidas::ctrMostrarSalidas($itemSalida, $valorSalida);

		$fecha = $respuestaSalida["fecha"];
		$componentes = json_decode($respuestaSalida["componentes"], true);

		//TRAEMOS LA INFORMACIÓN DE LA BASE

		$itemBase = "id";
		$valorBase = $respuestaSalida["id_base"];

		$respuestaBase = ControladorBases::ctrMostrarBases($itemBase, $valorBase);

		


		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');


		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();


		//$img_file = K_PATH_IMAGES.'bg-cotizacion-pdf.jpg';		
		//$pdf->Image($img_file, 0, 0, 235, 297, '', '', '', false, 300, '', false, false, 0);

		$pdf->setPageMark();
		$pdf->setPrintFooter(false);




		// ---------------------------------------------------------

		$bloque1 = <<<EOF
		
		<table style="whidth:100%;">
		
		<tr>
		
		<br>
			
		    <td style="width:80px"><img src="images/logo_avion.jpg"></td>

			<td aling="left" style=" width:220px">
				
				<div style="font-size:10px; text-align:left; line-height:15px;">
					
					<br>
					SANIDAD VEGETAL CRUZ VERDE S.A.S
					<br>
					NIT: 890.700.446
					<br>
					Fecha: $fecha
					<br>
					Base : $respuestaBase[base]
				</div>
			</td>
			<td aling="left" style=" width:220px; text-align:left"><br><br>Salida de Inventario N° SIV $respuestaSalida[codigo]
			</td>
		</tr>

	</table>
	
EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

		<br><br>

EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

	<table style="font-size:5px; padding:5px 5px;">

		<tr>
		<td style="border: 1px solid #666; width:50px; text-align:center">PARTE #</td>
		<td style="border: 1px solid #666; width:50px; text-align:center">SERIE NUMERO</td>
		<td style="border: 1px solid #666; width:50px; text-align:center">AERONAVE</td>
		<td style="border: 1px solid #666; width:160px; text-align:center">COMPONENTE</td>
		<td style="border: 1px solid #666; width:30px; text-align:center">CANT</td>
		<td style="border: 1px solid #666; width:100px; text-align:center">DETALLE</td>
		<td style="border: 1px solid #666; width:50px; text-align:center">VR UNITARIO</td>
		<td style="border: 1px solid #666; width:50px; text-align:center">VR TOTAL</td>

		</tr>

	</table>
	

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------


		foreach ($componentes as $key => $item) {

		$itemComponente = "id";
		$valorComponente = $item["id"];
		$respuestaComponente = ControladorComponentes::ctrMostrarComponentes($itemComponente, $valorComponente, "id");

			$itemMaquina = "id";
			$valorMaquina = $item["maquina"];

			$respuestaMaquina = ControladorMaquinas::ctrMostrarMaquinas($itemMaquina, $valorMaquina);



			foreach ($respuestaMaquina as $key => $itemMaquina) {
			
			}
		
			$valorU = $item["total"] / $item["cantidad"];
			$valorUnitario = number_format($valorU,0);
			$valortotal = number_format($item["total"],0);


				$bloque4 = <<<EOF

			<table style="font-size:6px; padding:5px 5px;">

		<tr>
		<td  style="border: 1px solid #666; width:50px; ">$respuestaComponente[codigo]</td>
		<td style="border: 1px solid #666; width:50px; ">$item[serieNumero]</td>
		<td  style="border: 1px solid #666; width:50px; ">$respuestaMaquina[matricula]</td>
		<td style="border: 1px solid #666; width:160px; ">$item[descripcion]</td>
		<td style="border: 1px solid #666; width:30px; text-align:center">$item[cantidad]</td>
		<td style="border: 1px solid #666; width:100px; ">$item[detalle]</td>
		<td style="border: 1px solid #666; width:50px; text-align:right"$>$ $valorUnitario</td>
		<td style="border: 1px solid #666; width:50px; text-align:right">$ $valortotal</td>

		</tr>

	</table>

EOF;

				$pdf->writeHTML($bloque4, false, false, false, false, '');
			
		}

		$total = number_format($respuestaSalida["valor_total"],0);

		$bloque5 = <<<EOF


		<table style="font-size:6px; padding:5px 5px;">

		<tr>
		<td  style="width:50px; "></td>
		<td  style="width:50px; "></td>
		<td style="width:50px; "></td>
		<td style="width:160px; "></td>
		<td style="width:30px; text-align:center"></td>
		<td style="width:100px; "></td>
		<td style="border: 1px solid #666; width:50px; text-align:left">Total</td>
		<td style="border: 1px solid #666; width:50px; text-align:right">$ $total</td>

		</tr>

	</table>



EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

		$bloque6 = <<<EOF

		

		<table style="whidth:100%;">
		
		<tr>
		
		<br>
		<br>

			<td aling="left" style="width:180px">
				
				<div style="font-size:8px; text-align:left; line-height:15px;">
					
					<br>
					Almacenista
					<br>
					<br>
					<br>
					__________________________________
					
				</div>
			</td>
			<td aling="left" style="width:160px;  text-align:left">
			<div style="font-size:8px; text-align:left; line-height:15px;">
					
					<br>
					VoBo
					<br>
					GAC
					<br>
					<br>
					_____________________________
					
				</div>
			</td>
			<td aling="left" style="width:200px;  text-align:left">
			<div style="font-size:8px; text-align:left; line-height:15px;">
					
					<br>
					Entregado A:
					<br>
					$respuestaSalida[recibe]
					<br>
					<br>
					_________________________________________
					<br>
					Recibí Conforme C.C:
					<br>
					Tecnico Lic No._________ TMA(_) TERM (_)GAC (_)
				</div>
			</td>
		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

if($respuestaSalida["estado"]== 0){
	$bloque7 = <<<EOF

	<table style="font-size:100px; padding:5px 5px;">
			<tr>
				<td>
				
				Anulada
				</td>
			</tr>
			</table>
	

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');


}



		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('cotizacion.pdf', 'D');
		$pdf->Output('entrada.pdf');
	}
}
$salida = new imprimirSalida();
$salida->codigo = $_GET["codigo"];
$salida->traerImpresionSalida();
