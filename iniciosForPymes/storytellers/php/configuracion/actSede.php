<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id	=	$_POST['id'];
	$nombre		=	$_POST['nombre'];
	$estado		=	$_POST['estado'];
	$color	 	=	$_POST['color'];

// Editar sede según el formulario recibido
	$query = mysqli_query($result,"UPDATE sede SET nombre = '$nombre', estado = '$estado', color = '$color' where sede_id = '$id';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La sede " . $nombre . " fue actualizada";
	}else{
		$msg = 'Error al editar la sede. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	