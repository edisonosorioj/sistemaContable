<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}


require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';
$tr2 = '';

$id = $_GET['id'];


$query = mysqli_query($result,"select cr.idescuentas as idescuentas, cr.fecha as fecha, cr.cantidad as cantidad, cr.producto as producto, cr.detalles as detalles, cr.valor as valor from estadoCompras c inner join estadoCuentas cr on c.idestado = cr.idestado where cr.idestado = '$id' order by fecha DESC;");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

				// <td>" . $row['idescuentas'] 	. "</td>
 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 			. "</td>
				<td>" . $row['cantidad'] 		. "</td>
				<td>" . $row['producto'] 		. "</td>
				<td>" . $row['detalles'] 		. "</td>
				<td align='right'>" . $row['valor'] 		. "</td>
				<td><a href='editarEstadoCuenta.php?id=" . $row['idescuentas'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='eliminarEstadoCuenta.php?id=" . $row['idescuentas'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a>
				</td>
			</tr>";

 }

$query2 = mysqli_query($result, "select * from estadoCompras where idestado='$id'");

$row2=$query2->fetch_assoc();

$producto = $row2['producto'];
$valor = $row2['valor'];

$query3 = mysqli_query($result,"select SUM(cr.valor) as total from estadoCompras c inner join estadoCuentas cr on c.idestado = cr.idestado where cr.idestado = '$id'");

$row3 = $query3->fetch_assoc();

$sumas = $valor + $row3['total'];

if($row3['total'] < 0){

	$tr2 .= "<label class='deuda'>$sumas</label>";

}else{
	$tr2 .= "<label class='aFavor'>$sumas</laber>";
}

include('../menu.php');

$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<meta name='viewport' content='width=device-width'/>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
		<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
		<title>Estado Super Cuenta</title>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Estado de Cuenta: $producto $ " . $tr2 . "</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='estadoCompras.php' class='menu'>Volver</a>
			<a href='../../html/formGasto.php?id=" . $id . "' class='menu'><img src='../../img/mas.png'>Agr. Gasto</a>
			<a href='../../html/formVenta.php?id=" . $id . "' class='menu'><img src='../../img/mas.png'>Agr. Producto</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Fecha</td>
					<td width='5%'>Cant.</td>
					<td width='10%'>Producto</td>
					<td width='20%'>Detalles</td>
					<td width='10%'>Valor</td>
					<td width='7%'>Opc.</td>
				</tr>"
			 . $tr . 
			 "</table>
		</div>
		</body>
		<script src='../../js/acciones.js'></script>
</html>";

					// <td width='5%'>ID</td>

echo $html;
$footer = include('../footer.php');