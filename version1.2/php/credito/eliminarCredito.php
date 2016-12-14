<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id = $_GET['id'];
	
$query = mysqli_query($result, "delete from creditos where idcreditos = '$id'");

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
			<input type='button' onclick='history.back(2)' name='listo' value='Listo'>
		</center>
	</body>
	</html>";

echo $html;
