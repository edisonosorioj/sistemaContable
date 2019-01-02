<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$dia		=	$_POST['dia'];
	$precio		=	$_POST['precio'];
	$impuesto	=	$_POST['impuesto'];


// Editar sede según el formulario recibido
	$query = mysqli_query($result,"UPDATE precio_x_dia SET dia = '$dia', precio = '$precio', impuesto = '$impuesto' WHERE pxd_id = '$id';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El valor de la sede fue actualizado";
	}else{
		$msg = 'Error al actualizar el valor de la sede. Intente nuevamente o consulte con el Administrador del sistema';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	