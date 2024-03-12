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

		$cartera = number_format(abs($consultaCartera["cartera"]),2);


		$consultaCompras = ModeloReportes::mdlSumaCompras("reporte_cartera", $itemCertificado, $valorCertificado);
		$compras = number_format(abs($consultaCompras["compras"]), 2, '.', ',');



		$consultaInteres = ModeloReportes::mdlSumaInteres("reporte_cartera", $itemCertificado, $valorCertificado);
		$interes = number_format(abs($consultaInteres["interes"]),2);

		$consultaImpuestos = ModeloReportes::mdlSumaImpuestos("reporte_cartera", $itemCertificado, $valorCertificado);
		$impuestos = number_format(abs($consultaImpuestos["impuestos"]),2);



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
		
		<table style="width:100%">
		<tr>
			<td style="width:80px">
				<img src="images/logo-sucampo.jpg">
			</td>
			<td align="left" style="width:470px">
				<div style="text-align:center">
					<span style="font-size:14px;">SucampoSullanta SAS</span>
					<br>
					<span style="font-size:8px;">NIT 890.707.192-0</span>
					<br>
				</div>
			</td>
		</tr>
	</table>
	
	
	
EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque2 = <<<EOF

		
		<h3 style="text-align: center;">CERTIFICA QUE:</h3>
		<br>
		<p>$respuestaCertificado[razon_social] identificado con CC/Nit: $respuestaCertificado[nit] a 31 de Diciembre del año $respuestaCertificado[ano] su estado de cuenta fue:</p>
		<br>


EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------

		$bloque3 = <<<EOF

		<table style="width:100%; border-collapse: collapse; margin-left:auto; margin-right:auto;">
    <tr>
        <td style="border: 1px solid #666; text-align:left; padding:5px;">Nos adeudaba la suma de:</td>
        <td style="border: 1px solid #666; text-align:right; padding:5px; font-size: larger;">$ $cartera</td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; text-align:left; padding:5px;">Nos compró productos por:</td>
        <td style="border: 1px solid #666; text-align:right; padding:5px; font-size: larger;">$ $compras</td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; text-align:left; padding:5px;">Nos pagó intereses por la suma de:</td>
        <td style="border: 1px solid #666; text-align:right; padding:5px; font-size: larger;">$ $interes</td>
    </tr>
    <tr>
        <td style="border: 1px solid #666; text-align:left; padding:5px;">IVA generado por compras por:</td>
        <td style="border: 1px solid #666; text-align:right; padding:5px; font-size: larger;">$ $impuestos</td>
    </tr>
</table>

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

			<td aling="left" style="width:180px">
				
				<div style="font-size:8px; text-align:left; line-height:15px;">
					
					<br>
					Firma Autorizada:
					<br>
					<br>
					<br>
					__________________________________
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
