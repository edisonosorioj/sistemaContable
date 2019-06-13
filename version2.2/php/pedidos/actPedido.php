<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre_pedido	=	$_POST['nombre_pedido'];
	$fecha			=	$_POST['fecha'];
	$actual_cliente =	$_POST['actual_cliente'];
	$cliente_id		=	$_POST['cliente'];

// Consulta para actualizar el cliente
if ($cliente_id == $actual_cliente) {
	$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', fecha = '$fecha' where pedido_id ='$id';");
	}else{
	$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', fecha = '$fecha', cliente_id = '$cliente_id' where pedido_id ='$id';");
	}

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El pedido fue actualizado correctamente";
	}else{
		$msg = 'Error al actualizar el Pedido. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	