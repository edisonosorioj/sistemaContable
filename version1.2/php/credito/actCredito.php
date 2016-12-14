<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

$query = mysqli_query($result, "UPDATE creditos set fecha = '$fecha', detalles = '$detalles', valor = '$valor' where idcreditos = '$id';");

$query2 = mysqli_query($result, "SELECT * FROM creditos where idcreditos = '$id' limit 1;");

$row=$query2->fetch_assoc();

$idcliente = $row['idclientes'];

if($query > 0) {
	$h1 = '<h1>Credito Actualizado</h1>';
}else{
	$h1 = '<h1>Error al Actualizar Credito</h1>';
}

$html = "<html>
	<head>
		<title>Creditos</title>
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