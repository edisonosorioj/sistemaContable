<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$nombre		=	$_POST['nombre'];
	$cantidad	=	$_POST['cantidad'];
	$precio		=	$_POST['precio'];
	$precio_d	=	$_POST['precio_d'];
	
	$query = mysqli_query($result, "UPDATE tipoProducto set nombre = '$nombre', cantidad = '$cantidad', precio = '$precio', precio_d = '$precio_d' where idtipo ='$id';");


if($query > 0){
	$msg = 'El tipo de producto fue actualizado con exito';
}else{
	$msg = 'Error al actualizar el tipo de producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	