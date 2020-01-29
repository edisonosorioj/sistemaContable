<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$pedido_id	=	$_POST['pedido_id'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query5 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
	$row5 	= $query5->fetch_assoc();

	$estado = $row5['estado'];
	$valor 	= $row5['t_costo'];

if ($estado == 0) {

 	$msg = "El pedido ya fue Cancelado, no es posible hacerlo nuevamente";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

	// Por medidio del PEDIDO ID se obtendrá los id de los propuestos para descontarlos del inventario por medio de una consulta sql.

	 $query4 = mysqli_query($result,"SELECT p.cantidad AS cantidadPedido, pp.disponible AS disponibleProducto, idproductos AS producto_id FROM pedidoProductos p INNER JOIN productos pp ON p.producto_id = pp.idproductos WHERE p.pedido_id = '$pedido_id';");


	 while ($row4 = $query4->fetch_array(MYSQLI_BOTH)){

	 	$cantidadPedido = $row4['cantidadPedido'];
	 	$disponibleProducto = $row4['disponibleProducto'];
	 	$producto_id = $row4['producto_id'];

	 	$total = $disponibleProducto + $cantidadPedido;

		$query3 = mysqli_query($result,"UPDATE productos SET disponible = '$total' WHERE idproductos = '$producto_id';");

	 }

	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
		$query = mysqli_query($result,"UPDATE pedidos SET t_cobrado = '0', estado = '0' WHERE pedido_id = '$pedido_id';");

	// Elimina el dato de creditos
		$query = mysqli_query($result,"DELETE FROM creditos WHERE detalles LIKE 'Pedido No. $pedido_id%' AND valor = '-$valor';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido se canceló correctamente";
	}else{

		$msg = 'Error al cancelar el pedido. Intente nuevamente';

	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='pedido.php';
		opener.location.reload();
	</script>";
	
	echo $html;	
}