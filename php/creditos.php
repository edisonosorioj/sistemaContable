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

$id = $_GET['id'];


$query = mysqli_query($result,"select cr.idcreditos as idcreditos, cr.fecha as fecha, cr.detalles as detalles, cr.valor as valor 
								from clientes c inner join creditos cr on c.id = cr.idclientes where cr.idclientes = '$id' 
								order by fecha DESC;");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idcreditos'] 	. "</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td align='right'>" . $row['valor'] 		. "</td>
				<td><a href='editarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab'><img src='../img/editar.png' alt='editar'></a>
				<a href='eliminarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab' class='botonTab'><img src='../img/eliminar.png' alt='eliminar'></a>
				<a href='copiarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab' class='botonTab'><img src='../img/copiar.png' alt='copiar'></a>
				</td>
			</tr>";

 }

$query2 = mysqli_query($result, "select nombres from clientes where id='$id'");

$row2=$query2->fetch_assoc();

$nombre = $row2['nombres'];

$query3 = mysqli_query($result,"select SUM(valor) as total from clientes c inner join creditos cr on c.id = cr.idclientes 
								where cr.idclientes = '$id'");

$row3 = $query3->fetch_assoc();

if($row3['total'] < 0){

	$tr2 .= "<tr class='row' id='rows'>
				<td width='30%'></td>
				<td width='20%'><b>TOTAL CREDITO</b></td>
				<td width='10%' class='deuda'>" . $row3['total'] . "</td>
			</tr>";

}else{
	$tr2 .= "<tr class='row' id='rows'>
			<td width='30%'></td>
			<td width='20%'><b>TOTAL CREDITO</b></td>
			<td width='10%' class='aFavor'>" . $row3['total'] . "</td>
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
			<p class='title'><h1>Estado de Cuenta: $nombre</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='clientes.php' class='menu'>Volver</a>
			<a href='../html/formCredito.php?id=" . $id . "' class='menu'>Agregar Credito</a>
			<a href='../html/formAbono.php?id=" . $id . "' class='menu'>Agregar Abono</a>
			<a href='logout.php' class='close_session salir'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='5%'>Cod.</td>
					<td width='10%'>Fecha</td>
					<td width='20%'>Detalles</td>
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
		</footer>
		</body>
		<script src='../js/acciones.js'></script>
</html>";


echo $html;