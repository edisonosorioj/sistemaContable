<?php
require_once 'conexion.php';

$query = 'select * from clientes';

$result = $conn->query($query);

$tr = '';

 while ($row = $result->fetch_array(MYSQLI_BOTH)){

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
		<link rel='stylesheet' href='../css/estilos.css' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<script src='login.js'></script>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Clientes</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='agregarCliente.php' class='agregar'>Nuevo Cliente</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
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
		 </body>
</html>";


echo $html;
