<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$pedido_id		=	$_POST['pedido_id'];


// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query = mysqli_query($result,"UPDATE pedidos set estado = '2' where pedido_id = '$pedido_id';");

		
	$html = "<script>
		self.location='pedidos_mesas.php';
		opener.location.reload();
	</script>";
	
	echo $html;	