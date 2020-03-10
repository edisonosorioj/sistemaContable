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
$nueva_mesa		=	$_POST['nueva_mesa'];

// Actualiza la tabla de pedidos
$query = mysqli_query($result,"UPDATE pedidoProductos SET pedido_id = '$nueva_mesa' WHERE pedido_id = '$pedido_id' AND registro_id IS NULL;");

$query1 = mysqli_query($result,"UPDATE pedidos SET estado = 0 WHERE pedido_id = '$pedido_id';");
$query2 = mysqli_query($result,"UPDATE pedidos SET estado = 1 WHERE pedido_id = '$nueva_mesa';");

//Según la respuesta de la inserción se da una respuesta en un alert 
if($query > 0 && $query1 > 0 && $query2 > 0){
	$msg = "El cambio de mesa se hizo correctamente";
}else{

	$msg = 'Error al cambiar de mesa. Intente nuevamente o contacte al administrador';

}
	
$html = "<script>
	window.alert('$msg');
	window.opener.document.location='pedidos_mesas.php';
	window.close();
</script>";

echo $html;