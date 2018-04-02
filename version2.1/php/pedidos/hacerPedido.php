<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$pedido_id		=	$_POST['pedido_id'];
	$cobrado		=	$_POST['cobrado'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query2 = mysqli_query($result,"SELECT SUM(valort) as valor FROM pedidoProductos WHERE pedido_id = '$pedido_id';");

	$row = $query2->fetch_assoc();
 	$valor = $row['valor'];

// Por medidio del PEDIDO ID se obtendrá los id de los propuestos para descontarlos del inventario por medio de una consulta sql.

 	

// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query = mysqli_query($result,"UPDATE pedidos set t_costo = '$valor', t_cobrado = '$cobrado', estado = '1' where pedido_id = '$pedido_id';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido se hizo correctamente";
	}else{
		$msg = 'Error al agregar el pedido. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='pedido.php';
		opener.location.reload();
	</script>";
	
echo $html;	