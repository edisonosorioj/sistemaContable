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
 

$query = mysqli_query($result,'select * from productos where idproductos != 0 order by idproductos');

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
 				<td>
				<input type='checkbox' value='" . $row['idproductos'] . "' name='ids[]' />
				</td>
				<td>" . $row['idproductos']	. "</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['nombre'] 		. "</td>
				<td>" . $row['disponible'] 	. "</td>
				<td>" . number_format($row['valor'], 0, ",", ".") 	. "</td>
				<td><a href='editarProductos.php?id=" . $row['idproductos'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='eliminarProductos.php?id=" . $row['idproductos'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a></td>
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
			<p class='title'><h1>Inventario</h1></p>
			<form>
			<label>Buscar: </label><input type='text' id='search' />
			<label>Desde: </label><input type='date' id='in-desde' />
			<label>Hasta: </label><input type='date' id='in-hasta' />
			</form>
			<form action='eliminarVarios.php' method='post'>
			<a href='' id='newProducto' class='menu'><img src='../../img/mas.png'>Nuevo</a>
			<input type='button' value='Actualizar' class='menu' onclick='window.location.reload()' />
			<input type='submit' name='delete' value='Eliminar' class='menu' />
		</nav>
		<div id=destino></div>
		<div class='lista_clientes' id='agrega-registros'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='3%'><input type='checkbox' id='checkTodos' /></td>
					<td width='5%'>ID</td>
					<td width='15%'>Fecha</td>
					<td width='25%'>Nombre</td>
					<td width='10%'>Disponible Lb.</td>
					<td width='10%'>Precio</td>
					<td width='8%'></td>
				</tr>"
			 . $tr . 
			 "</table>
			 </form>
		</div>
		</body>
		<script src='../../js/acciones.js'></script>
		<script>
		$('#checkTodos').change(function () {
      		$('input:checkbox').prop('checked', $(this).prop('checked'));
  		});
  		</script>
</html>";


echo $html;
// $footer = include('../footer.php');