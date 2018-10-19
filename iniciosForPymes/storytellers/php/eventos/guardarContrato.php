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
	$pedido_id		=	$_POST['pedido_id'];
	$cliente_id		=	$_POST['cliente_id'];

// Cuenta si hay ya un contrato guardado con base a su ID
$query2 = mysqli_query($result, "SELECT * FROM contrato WHERE pedido_id = '$pedido_id'");

 $conteo = mysqli_num_rows($query2);


 if ($conteo == 0) {

	$query = mysqli_query($result, "INSERT INTO contrato (contenido, pedido_id, cliente_id) VALUES ('$contenido', '$pedido_id', '$cliente_id');");

 } else {

// Actualiza los detalles del contrato
 	$query = mysqli_query($result, "UPDATE contrato SET contenido = '$contenido' WHERE pedido_id = '$pedido_id';");
	
 }


//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El contrato fue actualizado.";
	}else{
		$msg = "Error guardar el Contrato. Intenta nuevamente.";
	}
		
	$html = "<script>
		window.alert('$msg');
		history.back();
	</script>";
	
echo $html;	