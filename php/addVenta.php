<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad 	= 	$_POST['cantidad'];
	$producto 	= 	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

$query = mysqli_query($result,"INSERT INTO estadocuentas (fecha, cantidad, producto, detalles, valor, idestado) 
								VALUES ('$fecha', '$cantidad', '$producto', '$detalles', '$valor', '$id');");

$query2 = mysqli_query($result, "SELECT * FROM estadoCompras where idestado = '$id';");

$row=$query2->fetch_assoc();

$idestado = $row['idestado'];

if($query > 0) {
	$h1 = '<h1>Venta Guardada</h1>';
}else{
	$h1 = '<h1>Error al Guardar Venta</h1>';
}
	
$html = "<html>
			<head>
				<title>Ventas</title>
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