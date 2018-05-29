<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre_pedido	=	$_POST['nombre_pedido'];
	$cliente		=	$_POST['cliente'];

// Agrega nuevos usuarios según el formulario recibido
	$query2 = mysqli_query($result,"SELECT * FROM clientes WHERE nombres = '$cliente';");

	$row = $query2->fetch_assoc();
 	$cliente_id = $row['id'];

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', cliente_id = '$cliente_id' where pedido_id ='$id';");

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