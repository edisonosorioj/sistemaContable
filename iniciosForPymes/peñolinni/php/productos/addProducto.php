<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$nombre		=	$_POST['nombre'];
	$estado		=	$_POST['estado'];
	$grupo		=	$_POST['grupo'];


	$query = mysqli_query($result,"INSERT INTO items (nombre, estado, grupo) VALUES ('$nombre', '$estado', '$grupo');");
	
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