<?php
require_once "../conexion.php";

session_start();
if (!isset($_SESSION['login'])) {
	header("Location: ../inicio/session.html");
	exit();
}

if (isset($_SESSION['idadmin'])){
	$idadmin = $_SESSION['idadmin'];
}

$conex = new conection();
$result = $conex->conex();

// $fecha 		= 	date("Y-m-d");
$fecha 		= 	$_POST['fecha'];
$cantidad	=	$_POST['cantidad'];
$producto	=	$_POST['producto'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];

date_default_timezone_set('America/Lima');
	
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'INGRESOS';
$acc 	=	'AGREGO NUEVO INGRESO';

$query = mysqli_query($result,"INSERT INTO ingresos (fecha, cantidad, producto, detalles, valor) 
				VALUES ('$fecha', '$cantidad', '$producto', '$detalles', '$valor');");
	
	
if($query > 0){
	$msg = 'El Ingreso fue agregado con exito';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al Ingresar el egreso. Contacte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;		
