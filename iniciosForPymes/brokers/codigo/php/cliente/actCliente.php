<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$documento	=	$_POST['documento'];
	$empresa	=	$_POST['empresa'];
	$campo1		=	$_POST['campo1'];
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];
	$direccion 	=	$_POST['direccion'];

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo', empresa = '$empresa', direccion = '$direccion', campo1 = '$campo1' where id ='$id';");

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