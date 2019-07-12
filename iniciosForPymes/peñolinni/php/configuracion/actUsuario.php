<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$idadmin	=	$_POST['id'];
	$documento	=	$_POST['documento'];
	$nombre		=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$idrol	 	=	$_POST['rol'];
	$login	 	=	$_POST['login'];
	$password 	=	$_POST['contrasena'];

// Agrega nuevos usuarios según el formulario recibido
	if ($password != '') {
		$query = mysqli_query($result,"UPDATE administradores SET documento = '$documento', nombre = '$nombre', apellido = '$apellido', idrol = '$idrol', login = '$login', contrasena = md5('$password') where idadmin = '$idadmin';");
	}else{
		$query = mysqli_query($result,"UPDATE administradores SET documento = '$documento', nombre = '$nombre', apellido = '$apellido', idrol = '$idrol', login = '$login' where idadmin = '$idadmin';");
	}

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El usuario " . $nombre . " fue actualizado";
	}else{
		$msg = 'Error al editar el usuario. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	