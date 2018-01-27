<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$documento	=	$_POST['documento'];
	$nombres	=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$login 		=	$_POST['login'];
	$password 	=	$_POST['password'];

// Consulta para actualizar el cliente
	if ($password == '') {
		$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombre', apellido = '$apellido, 'login = '$login', login = '$login', password = '$password' where idadmin ='$id';");
	}else{

	$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombre', apellido = '$apellido, 'login = '$login', login = '$login' where idadmin ='$id';");
	}

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El usuario ". $nombres ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el usuario. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
	</script>";	
	
echo $html;	