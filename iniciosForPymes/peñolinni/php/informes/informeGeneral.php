<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
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



// Total Egresos según Fechas

$query = mysqli_query($result,"select * from compras where fecha between '$fecha_inicio' and '$fecha_fin';");

$tr = '';

while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['cantidad'] 	. "</td>
				<td>" . $row['producto'] 	. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td align='right'>$ " . number_format($row['valor'], 0, ",", ".") 		. "</td>
			</tr>";

 }

$query2 = mysqli_query($result,"select SUM(valor) as total from compras where fecha between '$fecha_inicio' and '$fecha_fin';");
 	$row2 = $query2->fetch_assoc();
 	$egresos = $row2['total'];


// Total Ingresos según Fechas

$query3 = mysqli_query($result,"select * from ingresos where fecha between '$fecha_inicio' and '$fecha_fin';");

$tr2 = '';

 while ($row3 = $query3->fetch_array(MYSQLI_BOTH)){

 	$tr2 .=	"<tr class='rows' id='rows'>
				<td>" . $row3['fecha'] 				. "</td>
				<td>" . $row3['cantidad'] 			. "</td>
				<td>" . $row3['producto'] 			. "</td>
				<td>" . $row3['detalles'] 			. "</td>
				<td align='right'>" . number_format($row3['valor'], 0, ",", ".") . "</td>
			</tr>";

 }

$query4 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha between '$fecha_inicio' and '$fecha_fin';");
 	$row4 = $query4->fetch_assoc();
 	$ingresos = $row4['total'];


// Lo organiza en un array y permite utilizar cada uno de los parametros
 $carFecha = $query2->fetch_array(MYSQLI_BOTH);
 $cTotal = number_format($carFecha['valor'], 0, ",", ".");

// Balance entre Ingresos y Egresos

$balance = $ingresos - $egresos;
$iva = $ingresos * 0.19;


 // Tabla de Estado Clientes

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

 // Utilizamos esta consulta para obtener el datos de las variables de configuracion
$query4 = mysqli_query($result, "select * from variables;");

$rows = mysqli_num_rows ($query4);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row4 = mysqli_fetch_array($query4);  
        $rows4[$i] = $row4["nombre"];  
        $datos[$rows4[$i]] = $row4["detalle"];  
    }  
              
}  

$varIva	= $datos['iva'];
$detallesIva = '';

if ($varIva == 1) {
 $detallesIva = "<div class='agile-tables'>
					<div class='w3l-table-info'>
					<h3>Valor IVA</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Valor Iva</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
						  	<td>" . number_format($iva, 0, ",", ".") . "</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				</div>";
};

 // Tabla de productos vendidos por pedido

$query5 = mysqli_query($result,'select producto, SUM(cantidad) as cantidad, SUM(valort) as valor, producto_id from pedidoProductos group by producto_id;');


$tr5 = '';

 while ($row5 = $query5->fetch_array(MYSQLI_BOTH)){

 	$tr5 .=	"<tr class='rows' id='rows'>
				<td>" . $row5['producto_id'] 	. "</td>
				<td>" . $row5['producto'] 	. "</td>
				<td>" . $row5['cantidad'] 	. "</td>
				<td  align='right'>$ " . number_format($row5['valor'], 0, ",", ".") 	. "</td>
			</tr>";

 }



$html="<!DOCTYPE html>
<head>
<title>Informe General</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />

</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

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
					<h3>Total Egresos: $ " . number_format($egresos, 0, ",", ".") . "</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Fecha</th>
							<th>Cantidad</th>
							<th>Producto</th>
							<th>Detalles</th>
							<th>Valor</th>
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

				<div class='agile-tables'>
					<div class='w3l-table-info'>
					<h3>Total Ingresos: $ " . number_format($ingresos, 0, ",", ".") . "</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Fecha</th>
							<th>Cantidad</th>
							<th>Producto</th>
							<th>Detalles</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr2 . 
						  "
						</tbody>
					  </table>
					</div>
				</div>

				<div class='agile-tables'>
					<div class='w3l-table-info'>
					<h3>Balance General</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Valor Balance</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
						  	<td>" . number_format($balance, 0, ",", ".") . "</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				</div>

				" . $detallesIva . "

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

			  	<div class='bs-component mb20 col-md-12'>
					<h4>Informe de Productos</h4>
			  	</div>
			  	<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr5 . 
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
