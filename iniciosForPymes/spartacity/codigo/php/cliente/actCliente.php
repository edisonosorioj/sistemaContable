<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id					=	$_POST['id'];
	$documento			=	$_POST['documento'];
	$empresa			=	$_POST['empresa'];
	$nombres			=	$_POST['nombres'];
	$telefono 			=	$_POST['telefono'];
	$correo 			=	$_POST['correo'];
	$direccion 			=	$_POST['direccion'];
	$doc_empresa		=	$_POST['doc_empresa'];
	$fecha_nacimiento 	=	$_POST['fecha_nacimiento'];
	$rh 				=	$_POST['rh'];
	$categoria 			=	$_POST['categoria'];
	$seguro_social 		=	$_POST['seguro_social'];

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo', empresa = '$empresa', direccion = '$direccion', doc_empresa = '$doc_empresa', fecha_nacimiento = '$fecha_nacimiento', rh = '$rh', categoria = '$categoria', seguro_social = '$seguro_social' where id = '$id';");

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