<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$nombres		=	$_POST['nombres'];
	$telefono 		=	$_POST['telefono'];
	$red			=	$_POST['red'];
	$correo 		=	$_POST['correo'];
	$distribuidor 	=	$_POST['distribuidor'];
	$observaciones 	=	$_POST['observaciones'];

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE clientes set nombres = '$nombres', telefono = '$telefono', red = '$red', correo = '$correo', distribuidor = '$distribuidor', observaciones = '$observaciones' where id ='$id';");

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