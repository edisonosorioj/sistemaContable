<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$tr = '';

$query = mysqli_query($result,'select * from estadoCompras order by idestado desc');

$query2 = mysqli_query($result,'select SUM(ec.valor) as valor from estadoCompras ec');
 
 $cartera = $query2->fetch_array(MYSQLI_BOTH);

				// <td>" . $row['cantidad'] 		. "</td>

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 								. "</td>
				<td>" . $row['producto'] 							. "</td>
				<td>" . $row['detalles'] 							. "</td>
				<td>" . number_format($row['valor'], 0, ",", ".") 	. "</td>
				<td><a href='editarMegaCuenta.php?id=" . $row['idestado'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='estadoCuentas.php?id=" . $row['idestado'] . "' class='botonTab' class='botonTab'><span data-tooltip='Detalles'><img src='../../img/detalle.png' alt='detalle'></spam></a>
				<a href='eliminarMegaCuenta.php?id=" . $row['idestado'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a>
				</td>
			</tr>";

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
	</head>
	<body>
		<nav>
			<p class='title'><h1>Mega Cuentas</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' />
			<a href='' id='newEstado' class='menu'><img src='../../img/mas.png'>Agregar</a>
			<label class='cartera'>Saldos: $ " . number_format($cartera['valor'], 0, ",", ".") ."<label/></form>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Fecha</td>
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
