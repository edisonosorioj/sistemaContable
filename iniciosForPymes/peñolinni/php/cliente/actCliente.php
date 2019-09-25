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
}else{
	$idadmin = 'Usuario sin registro';
}

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$id			=	$_POST['id'];
$documento	=	$_POST['documento'];
$empresa	=	$_POST['empresa'];
$nombres	=	$_POST['nombres'];
$telefono 	=	$_POST['telefono'];
$correo 	=	$_POST['correo'];
$direccion 	=	$_POST['direccion'];
	
$id 		=	$_POST['id'];
$fecha 		=	date('Y-m-d H:i:s');
$u_id 		=	$idadmin;
$mod 		=	'MESAS';
$acc 		=	'ACTUALIZO LA MESA CON ID ' . $id . $nombres;

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo', empresa = '$empresa', direccion = '$direccion' where id ='$id';");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El cliente ". $nombres ." fue actualizado";
		$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
	}else{
		$msg = 'Error al actualizar el cliente. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	