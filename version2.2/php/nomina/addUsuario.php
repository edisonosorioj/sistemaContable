<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$nombre				=	$_POST['nombre'];
	$apellido			=	$_POST['apellido'];
	$documento			=	$_POST['documento'];
	$fecha_contrato	 	=	$_POST['fecha_contrato'];
	$fecha_fin_contrato	=	$_POST['fecha_fin_contrato'];
	$nomina	 			=	$_POST['nomina'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO usuarios (nombre, apellido, documento, fecha_contrato, fecha_fin_contrato, valor_nomina) VALUES ('$nombre', '$apellido', '$documento', 'fecha_contrato','$fecha_fin_contrato', '$nomina');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El usuario " . $nombres . " fue agregado";
	}else{
		$msg = 'Error al agregar el usuario. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	