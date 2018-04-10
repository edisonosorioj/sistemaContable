<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

// Realiza la actualización del credito o abono
$query = mysqli_query($result, "UPDATE creditos set fecha = '$fecha', detalles = '$detalles', valor = '$valor' where idcreditos = '$id';");

if($query > 0){
	$msg = 'El registro fue actualizado con exito';
}else{
	$msg = 'Error al actualizar el registro. Contacte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;