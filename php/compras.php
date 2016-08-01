<?php
if( !session_id() )
{
    session_start();
}
require_once 'conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

$query = mysqli_query($result,'select * from compras');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['cantidad'] 		. "</td>
				<td>" . $row['producto'] 		. "</td>
				<td>" . $row['detalles'] 		. "</td>
				<td>" . $row['valor'] 			. "</td>
				<td>" . "<a href=''>Editar </a>" . "<a href=''> Eliminar</a>" . "</td>
			</tr>";

 }


$html = "<html>
	<head>
		<link rel='stylesheet' href='../css/estilos.css' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Clientes</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='agregarCliente.php' class='agregar'>Nueva Compra</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Cantidad</td>
					<td width='20%'>Producto</td>
					<td width='10%'>Detalles</td>
					<td width='20%'>Valor</td>
					<td width='20%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
		</div>
		<footer>
			<a href='inicio.php' class='agregar'>Menu</a>
		</footer>
		</body>
</html>";


echo $html;