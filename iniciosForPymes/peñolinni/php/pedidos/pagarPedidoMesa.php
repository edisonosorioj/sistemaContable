<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

if (isset($_SESSION['idadmin'])){
	$idadmin = $_SESSION['idadmin'];
}else{
	$idadmin = 'Usuario sin registro';
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$pedido_id		=	$_POST['pedido_id'];
$valor_pedido	=	$_POST['valor_pedido'];
$registro_id	= 	'';
$fecha 			=	date('Y-m-d H:i:s');
$u_id 			=	$idadmin;
$mod 			=	'PEDIDOS';
$acc 			=	'REALIZO PAGO DE MESA ' . $pedido_id;

// Obtiene la información del total del pedido por medio del PEDIDO ID
$query5 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
$row5 	= $query5->fetch_assoc();

$estado 		= $row5['estado'];
$nombre_pedido 	= $row5['nombre_pedido'];
$cliente_id		= $row5['cliente_id'];


$query6 = mysqli_query($result,"SELECT * FROM creditos WHERE registro_id = (SELECT  MAX(registro_id) FROM creditos) LIMIT 1;");
$row6 	= $query6->fetch_assoc();

$registro_id = ($row6['registro_id'] == '') ? 0 : $row6['registro_id'];

$registro_id++;

if ($estado != 0){

	//Agrega un registro al resumen del cliente

	$fecha		= date('Y-m-d H:i:s');
	$detalles 	= $nombre_pedido;

	$query = mysqli_query($result,"INSERT INTO ingresos (fecha, cantidad, producto, detalles, valor) VALUES (DATE_SUB(NOW(),INTERVAL 10 HOUR), '1', '$detalles', CONCAT('Pedido desde mesa ','$cliente_id'), '$valor_pedido');");


	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query1 = mysqli_query($result,"UPDATE pedidos SET estado = '0' WHERE pedido_id = '$pedido_id';");

	$query2 = mysqli_query($result,"UPDATE pedidoProductos SET registro_id = '$registro_id' WHERE pedido_id = '$pedido_id' AND registro_id is NULL;");

	$query6 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes, registro_id) VALUES (CONCAT(CURDATE(), ' ', CURTIME()), '$detalles', '$valor_pedido', '$cliente_id', '$registro_id');");

	$msg = "El pedido fue realizado correctamente.";

	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");

}else{
	$msg = "No puedes pagar un pedido sino lo haz realizado.";
}
	
		
$html = "<script>
	window.alert('$msg');
	window.opener.document.location='pedidos_mesas.php';
	window.close();
</script>";

echo $html;	