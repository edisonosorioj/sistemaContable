<?php
if( !session_id() )
{
    session_start();
}
require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

$query = mysqli_query($result,'select * from productos where idproductos != 1 order by fecha desc');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idproductos']	. "</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['nombre'] 		. "</td>
				<td>" . $row['disponible'] 	. "</td>
				<td><a href='editarProductos.php?id=" . $row['idproductos'] . "' class='botonTab'><img src='../../img/editar.png' alt='editar'></a>
				<a href='eliminarProductos.php?id=" . $row['idproductos'] . "' class='botonTab' class='botonTab'><img src='../../img/eliminar.png' alt='eliminar'></a></td>
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
			<p class='title'><h1>Inventario</h1></p>
			<form>
			<label>Buscar: </label><input type='text' id='search' />
			<label>Desde: </label><input type='date' id='in-desde' />
			<label>Hasta: </label><input type='date' id='in-hasta' />
			</form>
			<a href='../inicio.php' class='menu'>Menu</a>
			<a href='' id='newProducto' class='menu'>Nuevo Producto</a>
			<input type='button' value='Actualizar' onclick='window.location.reload()' />
			<a href='logout.php' class='close_session salir'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes' id='agrega-registros'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='5%'>ID</td>
					<td width='15%'>Fecha</td>
					<td width='25%'>Nombre</td>
					<td width='10%'>Disponible</td>
					<td width='8%'></td>
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