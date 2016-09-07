<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];


$query = mysqli_query($result, "UPDATE estadoCuentas set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', 
								detalles = '$detalles', valor = '$valor' where idescuentas = '$id';");

$query2 = mysqli_query($result, "SELECT * FROM estadoCuentas where idescuentas = '$id' limit 1;");

$row=$query2->fetch_assoc();

$idestado = $row['idestado'];

if($query > 0) {
	$h1 = '<h1>Estado de Cuenta Actualizado</h1>';
}else{
	$h1 = '<h1>Error al Actualizar Estado de Cuenta</h1>';
}

$html = "<html>
	<head>
		<title>Creditos</title>
		<meta charset='UTF-8' />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			" . $h1 . "
			<a href='estadoCuentas.php?id=" . $idestado . "' class='menu'>Listo!</a>
		</center>
	</body>
	</html>";

echo $html;