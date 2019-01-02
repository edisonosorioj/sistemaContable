<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$producto	=	$_POST['producto'];
	$detalles	=	$_POST['detalles'];
	$cantidad	=	$_POST['cantidad'];
	$fecha 		= 	date("Y-m-d");

	$query = mysqli_query($result,"INSERT INTO novedadProducto (productoId, detalles, cantidad, fecha) VALUES ('$producto', '$detalles', '$cantidad', '$fecha')");
	
	if($query > 0){
		$msg = 'La novedad al producto fue agregado';
	}else{
		$msg = 'Error al agregar novedad del producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	