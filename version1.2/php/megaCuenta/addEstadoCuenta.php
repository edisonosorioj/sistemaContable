<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha		=	$_POST['fecha'];
	$cantidad	=	1;
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO estadoCompras (fecha, cantidad, producto, detalles, valor) VALUES ('$fecha', '$cantidad', '$producto', '$detalles', '$valor');");
	
if($query > 0){
	$msg = 'La cuenta fue agregada';
}else{
	$msg = 'Error al agregar la cuenta. Intente de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='estadoCompras.php';
</script>";
	
echo $html;