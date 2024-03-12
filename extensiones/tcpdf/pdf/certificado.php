<?php

session_start();

require_once "../../../controladores/reportes.controlador.php";
require_once "../../../modelos/reportes.modelo.php";

class imprimirCertificado
{

	public $nitCertificado;

	public function traerImpresionCertificado()
	{

		setlocale(LC_TIME, 'es_ES.UTF-8');
		date_default_timezone_set('America/Bogota');
		$fecha = strftime("%d de %B de %Y");
		$nombre = $_SESSION["nombre"];
		$cargo = $_SESSION["cargo"];
		//TRAEMOS LA INFORMACIÓN DEL CERTIFICADO

		$itemCertificado = "nit";
		$valorCertificado = $this->nitCertificado;

		$respuestaCertificado = ControladorReportes::ctrMostrarReportes($itemCertificado, $valorCertificado);
		$consultaCartera = ModeloReportes::mdlSumaCartera("reporte_cartera", $itemCertificado, $valorCertificado);

		$cartera = number_format(abs($consultaCartera["cartera"]), 2);


		$consultaCompras = ModeloReportes::mdlSumaCompras("reporte_cartera", $itemCertificado, $valorCertificado);
		$compras = number_format(abs($consultaCompras["compras"]), 2, '.', ',');



		$consultaInteres = ModeloReportes::mdlSumaInteres("reporte_cartera", $itemCertificado, $valorCertificado);
		$interes = number_format(abs($consultaInteres["interes"]), 2);

		$consultaImpuestos = ModeloReportes::mdlSumaImpuestos("reporte_cartera", $itemCertificado, $valorCertificado);
		$impuestos = number_format(abs($consultaImpuestos["impuestos"]), 2);



		//REQUERIMOS LA CLASE TCPDF

		require_once('tcpdf_include.php');


		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();


		$img_file = K_PATH_IMAGES.'bg-cotizacion-pdf.jpg';		
		$pdf->Image($img_file, 0, 0, 235, 297, '', '', '', false, 300, '', false, false, 0);

		$pdf->setPageMark();
		$pdf->setPrintFooter(false);




		// ---------------------------------------------------------

		$bloque1 = <<<EOF
		
		<table style="width: 100%;">
    <tr>
        <td style="text-align: right;">
            <img src="images/logo-sucamposullanta.jpg" alt="Logo Sucampo Sullanta" width="300">
        </td>
    </tr>
</table>


		<br>
		<br>
		<br>
		<br>
		<br>
	

	<table>
		<tr>
			<td align="left" style="width:100%">
				<div style="text-align:center">
					<span style="font-size:14px;">SUCAMPO SULLANTA S.A.S</span>
					<br>
					<span style="font-size:12px;">NIT 890.707.192-0</span>
					<br>
				</div>
			</td>
		</tr>
	</table>
	
	
	
EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

		
		<h3 style="text-align: center;">CERTIFICA:</h3>
		<br>
		<br>
		<br>
		<br>


EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

		<table style="width:100%;  border-collapse: collapse; margin-left:auto; margin-right:auto;">
		<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">QUE:</td>
			<td style="border: 1px solid #666; text-align:left; padding:5px">$respuestaCertificado[razon_social]</td>
    	</tr>
		<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">CC/Nit:</td>
			<td style="border: 1px solid #666; text-align:left; padding:5px">$respuestaCertificado[nit]</td>
    	</tr>
    	<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">A DICIEMBRE 31 DE $respuestaCertificado[ano] NOS ADEUDABA LA SUMA DE::</td>
			<td style="border: 1px solid #666; text-align:right; padding:5px;">$ $cartera</td>
   		</tr>
    	<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">QUE NOS COMPRO PRODUCTOS POR:</td>
			<td style="border: 1px solid #666; text-align:right; padding:5px;">$ $compras</td>
    	</tr>
    	<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">QUE NOS PAGO INTERESES POR LA SUMA DE:</td>
			<td style="border: 1px solid #666; text-align:right; padding:5px;">$ $interes</td>
    	</tr>
    	<tr>
			<td style="border: 1px solid #666; font-size:10px text-align:left; padding:5px;">IVA GENERADO EN COMPRAS POR:</td>
			<td style="border: 1px solid #666; text-align:right; padding:5px; ">$ $impuestos</td>
    	</tr>
		</table>

<br>

	<p>INFORMACION DE ENERO A DICIEMBRE DE $respuestaCertificado[ano]
	<br>
	<br>
	<br>
	<p>Dada en la ciudad de Ibagué, $fecha</p>
	
	

EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque5 = <<<EOF

		

		<table style="whidth:100%;">
		
		<tr>
		
		<br>
		<br>

			<td aling="left" style="width:480px">
				
				<div style="font-size:12px; text-align:left; line-height:15px;">
					
					<br>
					Firma Autorizada:
					<br>
					<br>
					<br>
					______________________________
					<br>
					$nombre
					<br>
					$cargo
				</div>
			</td>
		</tr>

	</table>


EOF;


		$pdf->writeHTML($bloque5, false, false, false, false, '');





		// ---------------------------------------------------------
		//SALIDA DEL ARCHIVO 

		//$pdf->Output('cotizacion.pdf', 'D');
		$pdf->Output('certificado.pdf');
	}
}
$certificado = new imprimirCertificado();
$certificado->nitCertificado = $_GET["nitCertificado"];
$certificado->traerImpresionCertificado();
