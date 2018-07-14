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
	$estado		=	$_POST['estado'];
	$color	 	=	$_POST['color'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO sede (nombre, estado, color) VALUES ('$nombre', '$estado', '$color');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La Sede " . $nombre . " fue agregado";
	}else{
		$msg = 'Error al agregar el usuario. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";
	
echo $html;	