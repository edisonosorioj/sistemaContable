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

$query = mysqli_query($result,'select * from compras order by fecha desc');

$query2 = mysqli_query($result,"select SUM(valor) as total from compras");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>
				<input type='checkbox' value='" . $row['idcompras'] . "' name='ids[]' />
				</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['cantidad'] 	. "</td>
				<td>" . $row['producto'] 	. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td align='right'>" . $row['valor'] 		. "</td>
				<td><a href='editarCompras.php?id=" . $row['idcompras'] . "' class='botonTab'><span data-tooltip='Editar'>
				<img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='eliminarCompra.php?id=" . $row['idcompras'] . "' class='botonTab'><span data-tooltip='Eliminar'>
				<img src='../../img/eliminar.png' alt='eliminar'></spam></a></td>
			</tr>";

 }

 	$row2 = $query2->fetch_assoc();
 	$tr2 .= "<tr class='row' id='rows'>
				<td width='30%'></td>
 				<td width='20%'><b>TOTAL GASTOS</b></td>
 				<td width='10%'>" . $row2['total'] . "</td>
 			</tr>";

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
			<p class='title'><h1>Gastos</h1></p>
			<form>
			<label>Buscar: </label><input type='text' id='search' />
			<label>Desde: </label><input type='date' id='cp-desde' />
			<label>Hasta: </label><input type='date' id='cp-hasta' />
			</form>
			<form action='eliminarVarios.php' method='post'>
			<a href='' id='newCompra' class='menu'><img src='../../img/mas.png'>Nuevo</a>
			<input type='button' value='Actualizar' class='menu' onclick='window.location.reload()' />
			<input type='submit' name='delete' value='Eliminar' class='menu' />
		</nav>
		<div id=destino></div>
		<div class='lista_clientes' id='agrega-registros'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='3%'></td>
					<td width='15%'>Fecha</td>
					<td width='5%'>Can.</td>
					<td width='20%'>Producto</td>
					<td width='25%'>Detalles</td>
					<td width='10%'>Valor</td>
					<td width='8%'></td>
				</tr>"
			 . $tr . 
			 "</table>
			 <div id='espacio'></div>
			 </form>
			 <table class='table_result' id='table_result' width='65%'>"
			 . $tr2 .
			 "</table>
		</div>
		</body>
		<script src='../../js/acciones.js'></script>
</html>";


echo $html;
$footer = include('../footer.php');