<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


$fecha 			= 	date('Y-m-d');
$fecha_inicio 	= 	($_POST['fecha_inicio'] != '') ? $_POST['fecha_inicio'] : date('Y-m-d', strtotime('-7 day', strtotime($fecha)));
$fecha_fin 		= 	($_POST['fecha_fin'] 	!= '') ? $_POST['fecha_fin'] 	: $fecha;

// Consulta y por medio de un while muestra la lista de los clientes

$query2 = "select c.id, c.empresa, c.documento, c.nombres, c.telefono, c.correo, c.direccion, cr.valor as valor, cr.fecha from clientes c left join creditos cr on c.id = cr.idclientes where cr.fecha between '$fecha_inicio' and '$fecha_fin';"; 

$query = mysqli_query($result,$query2);


$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){
 		
	 	$tr .=	"<tr class='rows' id='rows'>
					<td>" . $row['fecha'] 	. "</td>
					<td>" . $row['empresa'] 	. "</td>
					<td>" . $row['nombres'] 	. "</td>
					<td  align='right'>$ " . number_format($row['valor'], 0, ",", ".") 	. "</td>
				</tr>";
 	

 }

// Realiza una segunda consulta que suma el total que deben todos los clientes
 $query2 = mysqli_query($result,"select SUM(valor) as valor from creditos where fecha between '$fecha_inicio' and '$fecha_fin';");

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $carFecha = $query2->fetch_array(MYSQLI_BOTH);
 $cTotal = number_format($carFecha['valor'], 0, ",", ".");


 // Tabla de Estado Clientes

 // Consulta y por medio de un while muestra la lista de los clientes
$query3 = mysqli_query($result,'select c.id, c.empresa, c.documento, c.nombres, c.telefono, c.correo, c.direccion, SUM(cr.valor) as valor from clientes c left join creditos cr on c.id = cr.idclientes group by c.id order by c.nombres');



$tr3 = '';

 while ($row3 = $query3->fetch_array(MYSQLI_BOTH)){

 	$tr3 .=	"<tr class='rows' id='rows'>
				<td>" . $row3['documento'] 	. "</td>
				<td>" . $row3['empresa'] 	. "</td>
				<td>" . $row3['nombres'] 	. "</td>
				<td>" . $row3['telefono'] 	. "</td>
				<td  align='right'>$ " . number_format($row3['valor'], 0, ",", ".") 	. "</td>
			</tr>";

 }

 // Realiza una segunda consulta que suma el total que deben todos los clientes
 $query4 = mysqli_query($result,'select SUM(cr.valor) as valor from creditos cr');

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $caCliente = $query4->fetch_array(MYSQLI_BOTH);
 $cTotal2 = number_format($caCliente['valor'], 0, ",", ".");


$html="<!DOCTYPE html>
<head>
<title>Informe General</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />

</head>
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Informe General</h2>
				</div>
				<div class='bs-component mb20 col-md-12'>
					<h4>Fechas de Reporte: $fecha_inicio - $fecha_fin</h4>
			  	</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Fecha</th>
							<th>Empresa</th>
							<th>Nombres</th>
							<th>Saldo</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr . 
						  "
						</tbody>
					  </table>
					</div>
				</div>
				<div class='bs-component mb20 col-md-6'>
			  		<h3>Total Cartera: $ $cTotal</h3>
			  	</div>

			  	<div class='bs-component mb20 col-md-12'>
					<h4>Estado Cuenta Clientes</h4>
			  	</div>
			  	<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Empresa</th>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Saldo</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr3 . 
						  "
						</tbody>
					  </table>
					</div>
				</div>
				<div class='bs-component mb20 col-md-6'>
			  		<h3>Total Cartera: $ $cTotal2</h3>
			  	</div>
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2019 ForPymes . All Rights Reserved . Design by ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
