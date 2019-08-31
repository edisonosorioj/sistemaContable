<?php

session_start();

if ($_SESSION['idadmin']){

	$idadmin 	= $_SESSION['idadmin'];
	$idrol 		= $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

if ($idrol == 0 || $idrol == 1) {

	$documento	=	$_POST['documento'];
	$nombres	=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$login 		=	$_POST['login'];
	$password 	=	$_POST['password'];

// Consulta para actualizar el cliente
	if ($password != '') {
		$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombres', apellido = '$apellido', login = '$login', contrasena = md5('$password') where idadmin = '$idadmin';");
	}else{

		$query = mysqli_query($result, "UPDATE administradores set documento = '$documento', nombre = '$nombres', apellido = '$apellido', login = '$login' where idadmin = '$idadmin';");
	}
} else {

	$id					=	$idadmin;
	$documento			=	$_POST['documento'];
	$empresa			=	$_POST['acudiente'];
	$nombres			=	$_POST['nombre'];
	$telefono 			=	$_POST['telefono'];
	$correo 			=	$_POST['correo'];
	$direccion 			=	$_POST['direccion'];
	$doc_empresa		=	$_POST['doc_empresa'];
	$fecha_nacimiento 	=	$_POST['fecha_nacimiento'];
	$rh 				=	$_POST['rh'];

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo', empresa = '$empresa', direccion = '$direccion', doc_empresa = '$doc_empresa', fecha_nacimiento = '$fecha_nacimiento', rh = '$rh' where id = '$id';");
}


// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El usuario ". $nombres ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el usuario. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='../inicio/index.php';
	</script>";	
	
echo $html;	