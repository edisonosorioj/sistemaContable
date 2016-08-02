<?php

if( !session_id() )
{
    session_start();
}

require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();

$query = mysqli_query($result,'select * from clientes');


$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['documento'] 		. "</td>
				<td>" . $row['nombres'] 		. "</td>
				<td>" . $row['telefono'] 		. "</td>
				<td>" . $row['correo'] 			. "</td>
				<td>" . "<a href=''>Editar </a>" . "<a href=''> Eliminar</a>" . "</td>
			</tr>";

 }


$html = "<html>
	<head>
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Clientes</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='' id='new' class='agregar'>Nuevo Cliente</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Documento</td>
					<td width='20%'>Nombre</td>
					<td width='10%'>Teléfono</td>
					<td width='20%'>Correo</td>
					<td width='20%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
		 </div>
		 <footer>
			<a href='inicio.php' class='agregar'>Menu</a>
		</footer>
	</body>
	<script src='../js/acciones.js'></script>
</html>";


echo $html;
