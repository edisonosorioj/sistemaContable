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

	$query = mysqli_query($result, "UPDATE estadoCompras set fecha = '$fecha', cantidad = 1, producto = '$producto', 
								detalles = '$detalles', valor = '$valor' where idestado = '$id';");
	
if($query > 0){
	$msg = 'La cuenta fue actualizada';
}else{
	$msg = 'Error al actualizar la cuenta. Intente de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='estadoCompras.php';
</script>";
	
echo $html;
