<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Consulta y por medio de un while muestra la lista de los clientes
$query = mysqli_query($result,'select c.id, c.documento, c.nombres, telefono, SUM(cr.valor) as valor from clientes c
								left join creditos cr on c.id = cr.idclientes
								group by c.id order by c.nombres');



$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['documento'] 				. "</td>
				<td>" . $row['nombres'] 				. "</td>
				<td>" . $row['telefono'] 				. "</td>
				<td  align='right'>" . $row['valor'] 	. "</td>
				<td><a href='editarCliente.php?id=" . $row['id'] . "' class='botonTab'><span data-tooltip='Editar'>
					<img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='../credito/creditos.php?id=" . $row['id'] . "' class='botonTab'><span data-tooltip='Historia'>
					<img src='../../img/detalle.png' alt='detalle'></spam></a>
				<a href='eliminarCliente.php?id=" . $row['id'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'>
					<img src='../../img/eliminar.png' alt='eliminar'></spam></a>
				</td>
			</tr>";

 }

// Realiza una segunda consulta que suma el total que deben todos los clientes
 $query2 = mysqli_query($result,'select SUM(cr.valor) as valor from creditos cr');

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $cartera = $query2->fetch_array(MYSQLI_BOTH);

include('../menu.php');

// Se contruye toda la HTML y muestra la información
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
			<p class='title'><h1>Clientes</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' />
			<a href='' id='new' class='menu'><img src='../../img/mas.png'>Nuevo</a>
			<label class='cartera'>Cartera Pendiente: $ " . $cartera['valor'] ."<label/></form>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='5%'>No.</td>
					<td width='20%'>Nombre</td>
					<td width='10%'>Teléfono</td>
					<td width='10%'>Adeudado</td>
					<td width='10%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
		 </div>
	</body>
	<script src='../../js/acciones.js'></script>
</html>";


echo $html;
// $footer = include('../footer.php');
