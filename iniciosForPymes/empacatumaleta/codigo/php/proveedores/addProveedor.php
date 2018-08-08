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
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];
	$direccion 	=	$_POST['direccion'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO proveedores (documento, empresa, nombres, telefono, correo, direccion) VALUES ('$documento', '$empresa', '$nombres', '$telefono', '$correo', '$direccion');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El proveedor " . $nombres . " fue agregado";
	}else{
		$msg = 'Error al agregar el proveedor. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	