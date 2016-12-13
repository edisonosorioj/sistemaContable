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
$tr2 = '';
$deuda = '';

$id = $_GET['id'];


$query = mysqli_query($result,"select cr.idcreditos as idcreditos, cr.fecha as fecha, cr.detalles as detalles, cr.valor as valor 
								from clientes c inner join creditos cr on c.id = cr.idclientes where cr.idclientes = '$id' 
								order by cr.idcreditos DESC, fecha DESC;");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
 				<td>
				<input type='checkbox' value='" . $row['idcreditos'] . "' name='ids[]' />
				</td>
				<td>" . $row['idcreditos'] 	. "</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td align='right'>" . $row['valor'] 		. "</td>
				<td><a href='editarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='copiarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab' class='botonTab'><span data-tooltip='Copiar Ing.'><img src='../../img/copiar.png' alt='copiar'></spam></a>
				<a href='eliminarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a>
				</td>
			</tr>";

 }

$query2 = mysqli_query($result, "select nombres from clientes where id='$id'");

$row2=$query2->fetch_assoc();

$nombre = $row2['nombres'];

$query3 = mysqli_query($result,"select SUM(valor) as total from clientes c inner join creditos cr on c.id = cr.idclientes where cr.idclientes = '$id'");

$row3 = $query3->fetch_assoc();

if($row3['total'] < 0){

	$deuda .="<label class='deuda'>Cartera Pendiente: $ " . $row3['total'] ."</label></form>";

}else{
	$deuda .="<label class='aFavor'>Cartera a Favor: $ " . $row3['total'] ."</label></form>";

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
			<p class='title'><h1>Estado de Cuenta: $nombre</h1> " . $deuda . "</p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<form action='eliminarVarios.php' method='post'>
			<a href='../cliente/clientes.php' class='menu'>Volver</a>
			<a href='../../html/formCredito.php?id=" . $id . "' class='menu'>Agregar Credito</a>
			<a href='../../html/formAbono.php?id=" . $id . "' class='menu'>Agregar Abono</a>
			<input type='submit' name='delete' value='Eliminar' class='menu' />
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='3%'></td>
					<td width='5%'>Cod.</td>
					<td width='10%'>Fecha</td>
					<td width='20%'>Detalles</td>
					<td width='10%'>Valor</td>
					<td width='10%'>Acciones</td>
				</tr>"
			 . $tr . 
			 "</table>
			 </form>
		</div>
	</body>
	<script src='../../js/acciones.js'></script>
</html>";


echo $html;
