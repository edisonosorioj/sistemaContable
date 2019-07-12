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

// Obtiene la información del total del pedido por medio del PEDIDO ID
$query5 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
$row5 	= $query5->fetch_assoc();

$estado = $row5['estado'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
$query2 = mysqli_query($result,"SELECT SUM(valort) as valor FROM pedidoProductos WHERE pedido_id = '$pedido_id';");

	$row 	= $query2->fetch_assoc();
	$valor 	= $row['valor'];

$query = mysqli_query($result,"UPDATE pedidos set t_costo = '0', t_cobrado = '0', estado = '0' where pedido_id = '$pedido_id';");

// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
$query = mysqli_query($result,"DELETE FROM pedidoProductos WHERE pedido_id = '$pedido_id' AND registro_id IS NULL;");
	
$html = "<script>
	self.location='pedidos_mesas.php';
	opener.location.reload();
</script>";

echo $html;	