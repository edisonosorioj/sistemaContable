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
$ae 	= '';

date_default_timezone_set('America/Lima');
	
$id 	=	$_GET['id'];
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'EGRESOS';
$acc 	=	'ELIMINAR EGRESO CON ID ' . $id;

$query = mysqli_query($result,"DELETE FROM compras WHERE idcompras = '$id'");

if($query > 0){
	$msg = 'El egreso fue eliminado';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al eliminar el egreso. Intentelo de nuevo!';
}

// Contruye el Alert y regresa a Egresos 
$html = "<script>
	window.alert('$msg');
	self.location='egresos.php';
</script>";

echo $html;	
			