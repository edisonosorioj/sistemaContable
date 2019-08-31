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
	
$id			=	$_POST['id'];
$fecha 		= 	$_POST['fecha'];
$cantidad	=	$_POST['cantidad'];
$producto	=	$_POST['producto'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];

date_default_timezone_set('America/Lima');
	
$id 	=	$_POST['id'];
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'EGRESOS';
$acc 	=	'ACTUALIZO EGRESO CON ID = ' . $id;

// Actualiza el registro de la compra por medio de la consulta siguiente
$query = mysqli_query($result, "UPDATE compras set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idcompras = '$id';");
	
if($query > 0){
	$msg = 'El egreso fue actualizado';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al actualizar el egreso. Actualice e intente de nuevo';
}

// Genera la alerta según el resultado del QUERY
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;	