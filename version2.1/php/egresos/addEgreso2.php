<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO compras (cantidad, producto, detalles, valor, fecha) 
				VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha');");

	$query2 = mysqli_query($result,"UPDATE productos SET disponible = disponible + $cantidad
				WHERE nombre = '$producto';");

	
if(($query > 0)&&($query2 > 0)){
	$msg = 'La Compra fue agregada con exito y se actualizo correctamente el Inventario';
}else{
	$msg = 'Error al Ingresar la Compra. Intente de nuevo. Si persiste el problema, notifique al administrador del sistema.';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;	