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


		
$query = mysqli_query($result, "UPDATE ingresos set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idingresos = '$id';");


	
if($query > 0){
	$msg = 'El Ingreso fue actualizado';
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