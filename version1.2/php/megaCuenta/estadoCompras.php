<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$query = mysqli_query($result,'select * from estadoCompras order by idestado desc');


$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 			. "</td>
				<td>" . $row['cantidad'] 		. "</td>
				<td>" . $row['producto'] 		. "</td>
				<td>" . $row['detalles'] 		. "</td>
				<td>" . $row['valor'] 			. "</td>
				<td><a href='editarMegaCuenta.php?id=" . $row['idestado'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='estadoCuentas.php?id=" . $row['idestado'] . "' class='botonTab' class='botonTab'><span data-tooltip='Detalles'><img src='../../img/detalle.png' alt='detalle'></spam></a></td>
			</tr>";

				// <a href='eliminarMegaCuenta.php?id=" . $row['idestado'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a>
 }

include('../menu.php');

$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
		<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Mega Cuentas</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' />
			<a href='' id='newEstado' class='menu'><img src='../../img/mas.png'>Agregar</a></form>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Fecha</td>
					<td width='5%'>Can.</td>
					<td width='15%'>Producto</td>
					<td width='25%'>Detalles</td>
					<td width='10%'>Valor</td>
					<td width='10%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
		 </div>
	</body>
	<script src='../../js/acciones.js'></script>
</html>";


echo $html;
$footer = include('../footer.php');
