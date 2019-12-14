<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$documento	=	$_POST['documento'];
	$empresa	=	$_POST['empresa'];
	$campo1		=	$_POST['campo1'];
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];
	$direccion 	=	$_POST['direccion'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO clientes (documento, nombres, telefono, correo, empresa, direccion, campo1) VALUES ('$documento', '$nombres', '$telefono', '$correo', '$empresa', '$direccion', '$campo1');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El cliente " . $nombres . " fue agregado";
	}else{
		$msg = 'Error al agregar el cliente. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	