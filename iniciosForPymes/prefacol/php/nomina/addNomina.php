<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$nombre		=	$_POST['nombre'];
	$fecha		=	$_POST['fecha'];


// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO nomina (nombre, fecha, estado) VALUES ('$nombre', '$fecha', '0');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La nomina " . $nombre . " fue agregado";
	}else{
		$msg = 'Error al agregar la nomina. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	