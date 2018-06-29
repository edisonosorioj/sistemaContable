<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre			=	$_POST['nombres'];
	$familia		=	$_POST['familia'];
	$descripcion	=	$_POST['descripcion'];
	$marca			=	$_POST['marca'];
	$genero			=	$_POST['genero'];
	
	$query = mysqli_query($result, "UPDATE productos set nombres = '$nombre', familia = '$familia', descripcion = '$descripcion', marca = '$marca', genero = '$genero' where idproductos ='$id';");


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