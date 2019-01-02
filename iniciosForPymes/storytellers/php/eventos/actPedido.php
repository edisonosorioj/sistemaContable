<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombre_pedido	=	$_POST['nombre_pedido'];
	$cliente		=	$_POST['cliente'];
	$start			=	$_POST['start'];
	$end			=	$_POST['end'];
	$sede			=	$_POST['sede'];
	$invitados		=	$_POST['invitados'];


// Consulta para actualizar el cliente
 	if ($cliente == 'Seleccione') {
		
		$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', start = '$start', end = '$end', invitados = '$invitados' where pedido_id ='$id';");
		
	}else{

		$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', cliente_id = '$cliente', start = '$start', end = '$end', invitados = '$invitados' where pedido_id ='$id';");
		}
	
	if ($sede == 'Seleccione') {
		
		$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', start = '$start', end = '$end', invitados = '$invitados' where pedido_id ='$id';");
 		
 	}else{

		$query = mysqli_query($result, "UPDATE pedidos set nombre_pedido = '$nombre_pedido', start = '$start', end = '$end', sede_id = '$sede', invitados = '$invitados' where pedido_id = '$id';");
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