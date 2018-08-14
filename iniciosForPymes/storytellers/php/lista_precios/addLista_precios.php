<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$item			=	$_POST['item'];
	$descripcion	=	$_POST['descripcion'];
	$precio			=	$_POST['precio'];


	$query = mysqli_query($result,"INSERT INTO lista_precios (item_id, descripcion, precio) VALUES ('$item','$descripcion', '$precio');");
	
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