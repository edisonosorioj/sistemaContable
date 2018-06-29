<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$proveedor	=	$_POST['proveedor'];
	$nombre		=	$_POST['nombre'];
	$disponible	=	$_POST['disponible'];
	$valor		=	$_POST['valor'];


	$query = mysqli_query($result,"INSERT INTO productos (fecha, nombre, disponible, valor, porveedor_id) VALUES ('$fecha','$nombre', '$disponible', '$valor', '$proveedor');");
	
	if($query > 0){
		$msg = 'El producto fue agregado';
	}else{
		$msg = 'Error al agregar el producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	