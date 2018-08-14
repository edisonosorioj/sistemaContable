<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$descripcion	=	$_POST['descripcion'];
	$precio			=	$_POST['precio'];

	$query = mysqli_query($result, "UPDATE lista_precios set descripcion = '$descripcion', precio = '$precio' where id ='$id';");
	
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