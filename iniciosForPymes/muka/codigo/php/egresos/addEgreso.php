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

// $fecha 		= 	date("Y-m-d");
$fecha_e	= 	$_POST['fecha'];
$cantidad	=	$_POST['cantidad'];
$producto	=	$_POST['producto'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];

date_default_timezone_set('America/Lima');
	
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'EGRESOS';
$acc 	=	'AGREGO NUEVO EGRESO';


$query = mysqli_query($result,"INSERT INTO compras (cantidad, producto, detalles, valor, fecha) VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha_e');");

if($query > 0){
	$msg = 'El egreso fue agregado con exito';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al agregar el egreso. Contácte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;	