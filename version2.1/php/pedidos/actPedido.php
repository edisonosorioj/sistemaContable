<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre_pedido	=	$_POST['nombre_pedido'];
	$cliente		=	$_POST['cliente'];


// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', cliente = '$cliente' where id ='$id';");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El cliente ". $nombres ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el cliente. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	