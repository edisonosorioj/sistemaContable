<?php 
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id = $_GET['id'];
	
$query = mysqli_query($result, "delete from estadoCuentas where idescuentas = '$id'");

if($query > 0) {
	$h1 = '<h1>Estado de Cuenta Actualizado</h1>';
}else{
	$h1 = '<h1>Error al Actualizar Estado de Cuenta</h1>';
}

$html = "<html>
	<head>
		<title>Estado de Cuenta</title>
		<meta charset='UTF-8' />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			" . $h1 . "
			<input type='button' onclick='history.back(2)' name='listo' value='Listo'>
		</center>
	</body>
	</html>";

echo $html;
