<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$documento	=	$_POST['documento'];
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];

	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo' where id ='$id';");
	
	if($query > 0){
		$msg = "El cliente ". $nombres ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el cliente. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";
	
echo $html;	