<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO compras (cantidad, producto, detalles, valor, fecha) VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha');");
	
	if($query > 0){
		$msg = 'El egreso fue agregado con exito';
	}else{
		$msg = 'Error al agregar el egreso. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";
	
echo $html;	