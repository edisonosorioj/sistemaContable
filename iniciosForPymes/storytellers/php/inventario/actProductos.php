<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$newProveedor	=	$_POST['newProveedor'];
	$disponible		=	$_POST['disponible'];
	$costo			=	$_POST['costo'];
	$valor			=	$_POST['valor'];

if ($newProveedor == 'Seleccionar') {

	$query = mysqli_query($result, "UPDATE productos set nombre = '$nombre', disponible = '$disponible', costo = '$costo', valor = '$valor' where idproductos ='$id';");

}else{

	$query = mysqli_query($result, "UPDATE productos set nombre = '$nombre', disponible = '$disponible', costo = '$costo', valor = '$valor', proveedor_id = '$newProveedor' where idproductos ='$id';");
	
}
	
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