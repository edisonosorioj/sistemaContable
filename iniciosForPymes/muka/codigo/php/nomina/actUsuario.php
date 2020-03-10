<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id					=	$_GET['id'];
	$nombre				=	$_POST['nombre'];
	$apellido			=	$_POST['apellido'];
	$documento			=	$_POST['documento'];
	$fecha_contrato 	=	$_POST['fecha_contrato'];
	$fecha_fin_contrato =	$_POST['fecha_fin_contrato'];
	$valor_nomina 		=	$_POST['valor_nomina'];


// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE usuarios set nombre = '$nombre', apellido = '$apellido', documento = '$documento', fecha_contrato = '$fecha_contrato', fecha_fin_contrato = '$fecha_fin_contrato', valor_nomina = '$valor_nomina' where iduser ='$id';");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El usuario ". $nombre ." ". $apellido ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el usuario. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	