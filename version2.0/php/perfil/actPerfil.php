<?php

session_start();

if ($_SESSION['idadmin']){

	$idadmin = $_SESSION['idadmin'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$documento	=	$_POST['documento'];
	$nombre		=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$login 		=	$_POST['login'];
	$password 	=	$_POST['password'];

// Consulta para actualizar el cliente
	if ($password != '') {
		$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombre', apellido = '$apellido', login = '$login', password = md5('$password') where idadmin = '$idadmin';");
	}else{

		$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombre', apellido = '$apellido', login = '$login' where idadmin = '$idadmin';");
	}

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El usuario ". $nombre ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el usuario. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='../inicio/index.php';
		opener.location.reload();
	</script>";	
	
echo $html;	