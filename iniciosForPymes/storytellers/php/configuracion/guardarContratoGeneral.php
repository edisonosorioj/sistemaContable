<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$contenido		=	urlencode($_POST['contenido']);


// Actualiza contrato
 $query = mysqli_query($result, "UPDATE contrato_base SET contrato = '$contenido' WHERE id = 1;");


//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El Contrato Base fue actualizado.";
	}else{
		$msg = "Error guardar el Contrato Base. Intenta nuevamente.";
	}
		
	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";
	
echo $html;	