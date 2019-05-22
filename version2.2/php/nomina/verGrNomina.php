<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from grupoNomina where idgrupo ='$id'");

$row = $query->fetch_assoc();

$idnomina 		= $row['idnomina'];
$idusuario 		= $row['idusuario'];
$auxilio 		= number_format($row['auxilio'], 0, ",", ".");
$compensacion 	= number_format($row['compensacion'], 0, ",", ".");
$salud 			= number_format($row['salud'], 0, ",", ".");
$pension 		= number_format($row['pension'], 0, ",", ".");
$prestamo 		= number_format($row['prestamos'], 0, ",", ".");
$pago_total 	= $row['pago_total'];
$dias 			= $row['dias'];

$deducciones2 = $row['salud'] + $row['pension'] + $row['prestamos'];
$deducciones = number_format($deducciones2, 0, ",", ".");

$pago_total = number_format($pago_total, 0, ",", ".");


$query2 = mysqli_query($result, "select * from usuarios where iduser = '$idusuario'");

$row2 = $query2->fetch_assoc();

$nombres 		= $row2['nombre'] . ' ' . $row2['apellido'];
$valor_nomina 	= ($row2['valor_nomina']/30)*$dias;
$compensacion2 	= ($row['compensacion']/30)*$dias;
$documento	 	= $row2['documento'];

$devengado = $valor_nomina + $row['auxilio'] + $compensacion2;
$devengado = number_format($devengado, 0, ",", ".");

$compensacion2 = number_format($compensacion2, 0, ",", ".");
$valor_nomina = number_format($valor_nomina, 0, ",", ".");

$query3 = mysqli_query($result, "select * from nomina where idnomina = '$idnomina'");

$row3 = $query3->fetch_assoc();

$estado = $row3['estado'];

if ($estado == 1) {
	 
	$msg = "La nomina ya fue realizada, no es posible cambiar los usuarios. Si desea cambiarlos debe cancelarlo primero y realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";

	echo $html;	
}else{



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
<body class='dashboard-page'>

	<section class='wrapper scrollable'>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Información Nomina</h2>
					</div>
					<form action='editarGrNomina.php?id=$id' method='post'>
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
								<td align='right'>$ $compensacion2 &nbsp; </td>
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
						<button type='submit' class='btn btn-default w3ls-button'>Cambiar</button> 
						<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cerrar</button> 
					</form> 
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
}