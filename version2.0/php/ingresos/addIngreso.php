<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) 
				VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha');");
	
	
if($query > 0){
	$msg = 'El Ingreso fue agregado con exito';
}else{
	$msg = 'Error al Ingresar el egreso. Contacte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;		
