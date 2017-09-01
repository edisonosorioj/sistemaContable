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
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];

	$query = mysqli_query($result,"INSERT INTO clientes (documento, nombres, telefono, correo) VALUES ('$documento', '$nombres', '$telefono', '$correo');");
	
	if($query > 0){
		$msg = "El cliente " . $nombres . " fue agregado";
	}else{
		$msg = 'Error al agregar el cliente. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='clientes.php';
	</script>";
	
echo $html;	