<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$fecha		=	$_POST['fecha'];
	$nombre		=	$_POST['nombre'];
	$disponible	=	$_POST['disponible'];
	$valor	=	$_POST['valor'];

	$query = mysqli_query($result, "UPDATE productos set fecha = '$fecha', nombre = '$nombre', disponible = '$disponible', valor = '$valor' where idproductos ='$id';");
	
	if($query > 0){
		$msg = 'El producto fue actualizado con exito';
	}else{
		$msg = 'Error al actualizar el producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	