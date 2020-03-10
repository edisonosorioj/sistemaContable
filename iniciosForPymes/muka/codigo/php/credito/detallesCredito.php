<?php
// Version 2.0 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';
$tr2 = '';
$deuda = '';


// Obtiene el ID enviado desde Cliente para visualizar su historial
$registro_id 	= $_GET['registro_id'];
$cliente_id 	= $_GET['cliente_id'];
$fecha 			= $_GET['fecha'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"SELECT c.peproducto_id as peproducto_id, cr.idcreditos as idcreditos, cr.fecha as fecha, c.producto as producto, c.valort as valort, cr.registro_id as registro_id FROM pedidoProductos c INNER JOIN creditos cr ON c.registro_id = cr.registro_id WHERE cr.registro_id = '$registro_id' AND c.cliente_id = '$cliente_id' and cr.idclientes = '$cliente_id' and cr.fecha = '$fecha' ORDER BY cr.idcreditos DESC, fecha DESC;");

$conteo = 1;

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $conteo 	. "</td>
				<td width='250px'>" . $row['fecha'] 		. "</td>
				<td>" . $row['producto'] 	. "</td>
				<td>$ " . number_format($row['valort'], 0, ",", ".") 	. "</td>
			</tr>";

	$conteo++;

 }

// Utilizamos esta consulta para obtener el nombre del cliente en su historial 
$query2 = mysqli_query($result, "SELECT c.nombres, cr.idclientes as idclientes FROM clientes c INNER JOIN creditos cr on c.id = cr.idclientes WHERE cr.registro_id = '$registro_id' ORDER BY cr.idcreditos DESC, fecha DESC;");

$row2=$query2->fetch_assoc();

$nombre 	= $row2['nombres'];
$id 		= $row2['idclientes'];

// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query3 = mysqli_query($result,"SELECT SUM(valort) as total FROM pedidoProductos WHERE registro_id = '$registro_id' and cliente_id = '$cliente_id';");

$row3 = $query3->fetch_assoc();

$deuda .="<label class='aFavor'>Valor Cuenta: $ " . number_format($row3['total'], 0, ",", ".") ."</label></form>";

// Se contruye el HTML para imprimirlo mas adelante.

$html="<!DOCTYPE html>
	<head>
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
		<link rel='icon' href='../../images/fav.png'>
	</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>$nombre</h2>
				</div>
				<div class='bs-component mb20 col-md-8'>
					<button type='button' class='btn btn-primary hvr-icon-pulse col-11' onclick='window.close();'>Cerrar</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					  	<h3>" . $deuda . "</h3>
					    <table border='1'>
						<thead>
						  <tr>
							<th>No.</th>
							<th>Fecha</th>
							<th width='30%'>Detalles</th>
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
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© " . date('Y') . " ForPymes. All Rights Reserved . Design by <a href='https://forpymes.co'></a>ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
	<script>
		$('#checkTodos').change(function () {
  		$('input:checkbox').prop('checked', $(this).prop('checked'));
		});
	</script>
</body>
</html>";

echo $html;
