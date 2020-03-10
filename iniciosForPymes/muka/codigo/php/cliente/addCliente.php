<?php
require_once "../conexion.php";

session_start();
if (!isset($_SESSION['login'])) {
	header("Location: ../inicio/session.html");
	exit();
}

if (isset($_SESSION['idadmin'])){
	$idadmin = $_SESSION['idadmin'];
}else{
	$idadmin = 'Usuario sin registro';
}

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$documento	=	$_POST['documento'];
$empresa	=	$_POST['empresa'];
$nombres	=	$_POST['nombres'];
$telefono 	=	$_POST['telefono'];
$correo 	=	$_POST['correo'];
$direccion 	=	$_POST['direccion'];


$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'MESAS';
$acc 	=	'AGREGO NUEVA MESA';

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO clientes (documento, nombres, telefono, correo, empresa, direccion) VALUES ('$documento', '$nombres', '$telefono', '$correo', '$empresa', '$direccion');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El cliente " . $nombres . " fue agregado";
		$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
	}else{
		$msg = 'Error al agregar el cliente. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	