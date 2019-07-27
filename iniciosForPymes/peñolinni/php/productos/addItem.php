<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		= 	$_POST['id'];
	$nombre		=	$_POST['nombre'];
	$valor		=	$_POST['valor'];


	$query = mysqli_query($result,"INSERT INTO precio_x_item (iditems, nombre, valor) VALUES ('$id', '$nombre', '$valor');");
	
	if($query > 0){
		$msg = 'El Item fue agregado correctamente';
	}else{
		$msg = 'Error al agregar el Item. Intente de nuevo o contacte al administrador';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	