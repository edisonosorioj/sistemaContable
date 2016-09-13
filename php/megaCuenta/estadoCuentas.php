<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
	
	header("Location: ../inicio/session.php");
	 
	exit;
}


require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';
$tr2 = '';

$id = $_GET['id'];


$query = mysqli_query($result,"select cr.idescuentas as idescuentas, cr.fecha as fecha, cr.cantidad as cantidad, cr.producto as producto, 
								cr.detalles as detalles, cr.valor as valor from estadoCompras c inner join estadoCuentas cr 
								on c.idestado = cr.idestado where cr.idestado = '$id' order by fecha DESC;");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idescuentas'] 	. "</td>
				<td>" . $row['fecha'] 			. "</td>
				<td>" . $row['cantidad'] 		. "</td>
				<td>" . $row['producto'] 		. "</td>
				<td>" . $row['detalles'] 		. "</td>
				<td align='right'>" . $row['valor'] 		. "</td>
				<td><a href='editarEstadoCuenta.php?id=" . $row['idescuentas'] . "' class='botonTab'><span data-tooltip='Editar'><img src='../../img/editar.png' alt='editar'></spam></a>
				<a href='eliminarEstadoCuenta.php?id=" . $row['idescuentas'] . "' class='botonTab' class='botonTab'><span data-tooltip='Eliminar'><img src='../../img/eliminar.png' alt='eliminar'></spam></a>
				</td>
			</tr>";

 }

$query2 = mysqli_query($result, "select * from estadoCompras where idestado='$id'");

$row2=$query2->fetch_assoc();

$producto = $row2['producto'];
$valor = $row2['valor'];

$query3 = mysqli_query($result,"select SUM(cr.valor) as total from estadoCompras c inner join estadoCuentas cr on c.idestado = cr.idestado 
								where cr.idestado = '$id'");

$row3 = $query3->fetch_assoc();

if($row3['total'] < 0){

	$tr2 .= "<tr class='row' id='rows'>
				<td width='30%'></td>
				<td width='20%'><b>TOTAL ESTADO</b></td>
				<td width='10%' class='deuda'>" . $row3['total'] . "</td>
			</tr>";

}else{
	$tr2 .= "<tr class='row' id='rows'>
			<td width='30%'></td>
			<td width='20%'><b>TOTAL ESTADO</b></td>
			<td width='10%' class='aFavor'>" . $row3['total'] . "</td>
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
		<title>Estado Super Cuenta</title>
	</head>
	<body>
		<nav>
			<p class='title'><h1>Estado de Cuenta: $producto $ $valor</h1></p>
			<form><label>Buscar: </label><input type='text' id='search' /></form>
			<a href='estadoCompras.php' class='menu'>Volver</a>
			<a href='../../html/formGasto.php?id=" . $id . "' class='menu'>Agregar Gasto</a>
			<a href='../../html/formVenta.php?id=" . $id . "' class='menu'>Agregar Producto</a>
			<a href='logout.php' class='close_session salir'>Salir</a>
		</nav>
		<div id=destino></div>
		<div class='lista_clientes'>
		<table class='table_result' id='table_result'>
				<tr class='name_list'>
					<td width='5%'>ID</td>
					<td width='10%'>Fecha</td>
					<td width='5%'>Cant.</td>
					<td width='10%'>Producto</td>
					<td width='20%'>Detalles</td>
					<td width='10%'>Valor</td>
					<td width='7%'>Opc.</td>
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