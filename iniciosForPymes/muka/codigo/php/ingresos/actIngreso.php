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
	
$id			=	$_POST['id'];
$fecha 		= 	$_POST['fecha'];
$cantidad	=	$_POST['cantidad'];
$producto	=	$_POST['producto'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];

date_default_timezone_set('America/Lima');
	
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'INGRESOS';
$acc 	=	'ACTUALIZO INGRESO CON ID ' . $id . ' - ' . $producto;

$query = mysqli_query($result, "UPDATE ingresos set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idingresos = '$id';");

if($query > 0){
	$msg = 'El Ingreso fue actualizado';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al actualizar el Ingreso. Actualice e intente de nuevo';
}

// Genera la alerta según el resultado del QUERY
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;	