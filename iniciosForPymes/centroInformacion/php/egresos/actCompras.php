<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$id			=	$_POST['id'];
$fecha 		= 	$_POST['fecha'];
$cantidad	=	$_POST['cantidad'];
$producto	=	$_POST['producto'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];

// Actualiza el registro de la compra por medio de la consulta siguiente
$query = mysqli_query($result, "UPDATE compras set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idcompras = '$id';");
	
if($query > 0){
	$msg = 'El egreso fue actualizado';
}else{
	$msg = 'Error al actualizar el egreso. Actualice e intente de nuevo';
}

// Genera la alerta según el resultado del QUERY
$html = "<script>
	window.alert('$msg');
	self.location='compras.php';
</script>";
	
echo $html;	