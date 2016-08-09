<?php
if( !session_id() )
{
    session_start();
}
require_once 'conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

$query = mysqli_query($result,'select * from compras order by fecha desc');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['cantidad'] 	. "</td>
				<td>" . $row['producto'] 	. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td>" . $row['valor'] 		. "</td>
				<td><a href='editarCompra.php?id=" . $row['idcompras'] . "' class='botonTab'>Editar</a>
				<a href='eliminarCompra.php?id=" . $row['idcompras'] . "' class='botonTab' class='botonTab'>Eliminar</a></td>
			</tr>";

 }


$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<nav>
			<p class='title'><h1>Compras</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='inicio.php' class='boton'>Menu</a>
			<a href='' id='newCompra' class='boton'>Nueva Compra</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Fecha</td>
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
		<script src='../js/acciones.js'></script>
</html>";


echo $html;