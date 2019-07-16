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
$valor_pedido	=	$_POST['valor_pedido'];
$registro_id	= 	'';

// Obtiene la información del total del pedido por medio del PEDIDO ID
$query5 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
$row5 	= $query5->fetch_assoc();

$estado 		= $row5['estado'];
$nombre_pedido 	= $row5['nombre_pedido'];
$cliente_id		= $row5['cliente_id'];


$query6 = mysqli_query($result,"SELECT pp.registro_id AS registro_id FROM pedidoProductos pp ORDER BY pp.registro_id DESC LIMIT 1;");
$row6 	= $query6->fetch_assoc();

$registro_id = ($row6['registro_id'] == '') ? 0 : $row6['registro_id'];

$registro_id = $registro_id + 1;

if ($estado != 0){

	//Agrega un registro al resumen del cliente

	 $fecha 		= date('y-m-d');
	 $detalles 		= "Pedido No. " . $pedido_id . " - " . $nombre_pedido;

	 $query = mysqli_query($result,"INSERT INTO ingresos (fecha, cantidad, producto, detalles, valor) VALUES ('$fecha', '1', '$detalles', CONCAT('Pedido desde mesa ','$cliente_id'), '$valor_pedido');");


	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query1 = mysqli_query($result,"UPDATE pedidos set estado = '0' where pedido_id = '$pedido_id';");

	$query2 = mysqli_query($result,"UPDATE pedidoProductos set registro_id = '$registro_id' where pedido_id = '$pedido_id' and registro_id is null;");

	$query6 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', '$valor_pedido', '$cliente_id');");


	}else{
		$msg = "No puedes pagar un pedido sino lo haz realizado.";
	}
	
		
	$html = "<script>
		opener.location.reload();
		location.href='pedidos_mesas.php';
		window.close();
	</script>";
	
	echo $html;	