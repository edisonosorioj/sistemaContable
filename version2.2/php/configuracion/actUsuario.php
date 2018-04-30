<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$documento	=	$_POST['documento'];
	$nombre		=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$idrol	 	=	$_POST['rol'];
	$login	 	=	$_POST['login'];
	$password 	=	md5($_POST['password']);

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"UPDATE administradores SET documento = '$documento', nombre = '$nombre', apellido = '$apellido', idrol = '$idrol', login = '$login', contrasena = '$password';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El usuario " . $nombres . " fue actualizado";
	}else{
		$msg = 'Error al editar el usuario. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	