<?php
if( !session_id() )
{
    session_start();
}
require_once 'conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

$id = $_GET['id'];

$query = mysqli_query($result,"select * from clientes c inner join clientesxcreditos cc inner join creditos cr on 
	c.id = cc.idclientes and cc.idcreditos = cr.idcreditos where c.id = '$id';");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['cr.idcreditos'] 		. "</td>
				<td>" . $row['cr.fecha'] 	. "</td>
				<td>" . $row['cr.detalles'] 	. "</td>
				<td>" . $row['cr.valor'] 	. "</td>
				<td><a href='editarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab'>Editar</a>
				<a href='eliminarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab' class='botonTab'>Eliminar</a></td>
			</tr>";

 }

$query2 = mysqli_query($result, "select nombres from clientes where id='$id'");

$row2=$query2->fetch_assoc();

$nombre = $row2['nombres'];

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
			<p class='title'><h1>Estado de $nombre</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='clientes.php' class='boton'>Volver</a>
			<a href='' id='newCredito' class='boton'>Agregar Valor</a>
			<a href='logout.php' class='close_session'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='10%'>Cod.</td>
					<td width='10%'>Fecha</td>
					<td width='20%'>Detalles</td>
					<td width='10%'>Valor</td>
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