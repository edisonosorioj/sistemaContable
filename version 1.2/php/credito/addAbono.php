<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', '$valor', '$id');");

$query2 = mysqli_query($result, "SELECT * FROM clientes where id = '$id';");

$row=$query2->fetch_assoc();

$idcliente = $row['id'];

if($query > 0) {
	$h1 = '<h1>Abono Guardado</h1>';
}else{
	$h1 = '<h1>Error al Guardar Abono</h1>';
}
	
$html = "<html>
			<head>
				<title>Abono</title>
				<meta charset='UTF-8' />
				<link rel='stylesheet' href='../../css/reset.css' />
				<link rel='stylesheet' href='../../css/estilos.css' />
			</head>
			<body>
				<center>	
					" . $h1 . "
					<a href='creditos.php?id=" . $idcliente . "' class='menu'>Listo!</a>
				</center>
			</body>
			</html>";

echo $html;