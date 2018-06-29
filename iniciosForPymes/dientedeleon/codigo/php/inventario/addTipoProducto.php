<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$nombre		=	$_POST['nombre'];
	$cantidad	=	$_POST['cantidad'];
	$precio 	=	$_POST['precio'];
	$precio_d	=	$_POST['precio_d'];


	$query = mysqli_query($result,"INSERT INTO tipoProducto (nombre, cantidad, precio, precio_d) VALUES ('$nombre', '$cantidad', '$precio', '$precio_d');");
	
	if($query > 0){
		$msg = 'El tipo de producto fue agregado';
	}else{
		$msg = 'Error al agregar el tipo de producto. Intente de nuevo o contacte al Administrador.';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	