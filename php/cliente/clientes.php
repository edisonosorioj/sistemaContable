<?php

if( !session_id() )
{
    session_start();
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$query = mysqli_query($result,'select * from clientes order by id desc');


$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['documento'] 		. "</td>
				<td>" . $row['nombres'] 		. "</td>
				<td>" . $row['telefono'] 		. "</td>
				<td>" . $row['correo'] 			. "</td>
				<td><a href='editarCliente.php?id=" . $row['id'] . "' class='botonTab'><img src='../../img/editar.png' alt='editar'></a>
				<a href='eliminarCliente.php?id=" . $row['id'] . "' class='botonTab' class='botonTab'><img src='../../img/eliminar.png' alt='eliminar'></a>
				<a href='../credito/creditos.php?id=" . $row['id'] . "' class='botonTab' class='botonTab'><img src='../../img/detalle.png' alt='detalle'></a></td>
			</tr>";

 }


$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<nav>
			<p class='title'><h1>Clientes</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='../inicio/inicio.php' class='menu'>Menu</a>
			<a href='' id='new' class='menu'>Nuevo Cliente</a>
			<a href='../inicio/logout.php' class='close_session salir'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Documento</td>
					<td width='20%'>Nombre</td>
					<td width='10%'>Teléfono</td>
					<td width='20%'>Correo</td>
					<td width='15%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
		 </div>
		 <footer>
		</footer>
	</body>
	<script src='../../js/acciones.js'></script>
</html>";


echo $html;
