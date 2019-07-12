<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id = $_POST['idnomina'];
$table = '';

 $query4 = mysqli_query($result,"SELECT u.documento as documento, n.idnomina AS idnomina, u.iduser AS iduser, u.nombre AS nombre, u.apellido AS apellido, u.valor_nomina AS valor_nomina, g.dias AS dias, g.salud AS salud, g.pension AS pension, g.prestamos AS prestamos, g.idgrupo AS idgrupo, g.pago_total AS pago_total, g.auxilio AS auxilio, g.compensacion AS compensacion FROM nomina n inner join grupoNomina g inner join usuarios u on n.idnomina = g.idnomina and u.iduser = g.idusuario WHERE n.idnomina = '$id';");

 while ($row4 = $query4->fetch_array(MYSQLI_BOTH)){

 	$nombres 		= $row4['nombre'] . ' ' . $row4['apellido'];
 	$documento 		= $row4['documento'];
 	$dias 			= $row4['dias'];
 	$valor_nomina 	= ($row4['valor_nomina']/30)*$dias;
 	$auxilio	 	= $row4['auxilio'];
 	$salud 			= $row4['salud'];
 	$pension 		= $row4['pension'];
 	$compensacion 	= ($row4['compensacion']/30)*$dias;
 	$prestamo 		= $row4['prestamos'];
 	$devengado 		= $valor_nomina + $auxilio + $compensacion;
 	$deducciones 	= $salud + $pension + $prestamo;
 	$pago_total 	= $row4['pago_total'];


 	$table .= "
 		<table width='70%'>
			<tr>
				<td><b>Nombres:</b></td>
				<td>$nombres</td>
			</tr>
			<tr>
				<td><b>Documento:</b></td>
				<td>$documento</td>
			</tr>
			<tr>
				<td><b>Dias Laborados:</b></td>
				<td>$dias</td>
			</tr>
			<tr>
				<td colspan='2'>&nbsp;</td>
			</tr>
		</table>
		<table width='100%' border='1'>
			<tr>
				<th colspan='2'>DEVENGADO</th>
				<th colspan='2'>DEDUCCIONES</th>
			</tr>
			<tr>
				<td><b> &nbsp; Concepto</b></td>
				<td><b> &nbsp; Valor</b></td>
				<td><b> &nbsp; Concepto</b></td>
				<td><b> &nbsp; Valor</b></td>
			</tr>
			<tr>
				<td><b> &nbsp; Salario</b></td>
				<td align='right'>$ $valor_nomina &nbsp; </td>
				<td><b> &nbsp; Aportes a Salud</b></td>
				<td align='right'>$ $salud &nbsp; </td>
			</tr>
			<tr>
				<td><b> &nbsp; Aux. Transporte</b></td>
				<td align='right'>$ $auxilio &nbsp; </td>
				<td><b> &nbsp; Aporte a Pensión</b></td>
				<td align='right'>$ $pension &nbsp; </td>
			</tr>
			<tr>
				<td><b> &nbsp; Compensación</b></td>
				<td align='right'>$ $compensacion &nbsp; </td>
				<td><b> &nbsp; Prestamos</b></td>
				<td align='right'>$ $prestamo &nbsp; </td>
			</tr>
			<tr>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
			</tr>
			<tr>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
				<td> &nbsp; </td>
			</tr>
			<tr>
				<td align='right'><b> &nbsp; TOTAL</b></td>
				<td align='right'>$ $devengado &nbsp; </td>
				<td align='right'><b> &nbsp; TOTAL</b></td>
				<td align='right'>$ $deducciones &nbsp; </td>
			</tr>
		</table>
		<table width='100%'>
			<tr>
				<td colspan='4'> &nbsp; </td>
			</tr>
			<tr>
				<td width='30%'><b>TOTAL NOMINA</b></td>
				<td>$ $pago_total </td>
			</tr>
			<tr>
				<td colspan='4'> &nbsp; </td>
			</tr>
		</table>
		<p>Recibo Conforme: ____________________________</p>
		<h2>&nbsp;</h2>
		<div align='center'>--------------------------------------------------------------------------------------------------------------------------------------------------------------</div>
		<h2>&nbsp;</h2>
 	";

 }

// Se crea el HTML con la información del Pedido

$html = "
<!DOCTYPE html>
<head>
<title>Información Nomina</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Administración de Negocios, Admin, Negocios' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel='stylesheet' href='../../css/bootstrap.css'>
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href='../../css/style.css' rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel='stylesheet' href='../../css/font.css' type='text/css'/>
<link href='../../css/font-awesome.css' rel='stylesheet'> 
<!-- //font-awesome icons -->
<script src='../../js/jquery2.0.3.min.js'></script>
<script src='../../js/modernizr.js'></script>
<script src='../../js/jquery.cookie.js'></script>
<script src='../../js/screenfull.js'></script>
</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

	<section class='wrapper scrollable'>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Información Nomina</h2>
					</div>
					" . $table . "
				</div>
				<!-- //input-forms -->
			</div>
		</div>
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;
