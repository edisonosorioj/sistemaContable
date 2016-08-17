<?php
if( !session_id() )
{
    session_start();
}
require_once 'conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';
$tr2 = '';

$query = mysqli_query($result,'select * from ingresos order by fecha desc');

$query2 = mysqli_query($result,'select SUM(valor) as total from ingresos');

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['cantidad'] 	. "</td>
				<td>" . $row['producto'] 	. "</td>
				<td align='left'>" . $row['detalles'] 	. "</td>
				<td align='right'>" . $row['valor'] . "</td>
				<td><a href='editarIngreso.php?id=" . $row['idingresos'] . "' class='botonTab'><img src='../img/editar.png' alt='editar'></a>
				<a href='eliminarIngreso.php?id=" . $row['idingresos'] . "' class='botonTab' class='botonTab'><img src='../img/eliminar.png' alt='eliminar'></a></td>
			</tr>";

 }

 	$row2 = $query2->fetch_assoc();
 	$tr2 .= "<tr class='row' id='rows'>
				<td width='30%'></td>
 				<td width='20%'><b>TOTAL INGRESOS</b></td>
 				<td width='10%'>" . $row2['total'] . "</td>
 			</tr>";


$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<script src='../js/bootstrap.min.js'></script>
		<script src='../js/bootstrap.js'></script>
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<nav>
			<p class='title'><h1>Ingresos</h1></p>
			<form>
				<label>Buscar: </label><input type='text' id='search' />
				<label>Desde: </label><input type='date' id='bd-desde' />
				<label>Hasta: </label><input type='date' id='bd-hasta' />
			</form>
			<a href='inicio.php' class='boton'>Menu</a>
			<a href='' id='newIngreso' class='boton'>Nuevo Ingreso</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes' id='agrega-registros'>
			<table class='table_result' id='table_result'>
					<tr class='name_list'>
						<td width='10%'>Fecha</td>
						<td width='10%'>Cantidad</td>
						<td width='15%'>Producto</td>
						<td width='25%'>Detalles</td>
						<td width='10%'>Valor</td>
						<td width='10%'>Acciones</td>
					</tr>"
				 . $tr . 
			 "</table>
			 <div id='espacio'></div>
			 <table class='table_result' id='table_result' width='65%'>"
			 	. $tr2 .
			 "</table>
		</div>
		<footer>
			<a href='inicio.php' class='boton'>Menu</a>
		</footer>
		</body>
		<script src='../js/acciones.js'></script>
</html>";


echo $html;