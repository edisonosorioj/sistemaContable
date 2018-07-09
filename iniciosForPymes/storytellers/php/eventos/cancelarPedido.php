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

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query2 = mysqli_query($result,"SELECT SUM(valort) as valor FROM pedidoProductos WHERE pedido_id = '$pedido_id';");

	$row 	= $query2->fetch_assoc();
 	$valor 	= $row['valor'];

if ($estado == 0) {

 	$msg = "El pedido ya fue Cancelado, no es posible hacerlo nuevamente";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

	// Por medidio del PEDIDO ID se obtendrá los id de los propuestos para descontarlos del inventario por medio de una consulta sql.

	 $query4 = mysqli_query($result,"select p.cantidad as cantidadPedido, pp.disponible as disponibleProducto, idproductos as producto_id from pedidoProductos p inner join productos pp on p.producto_id = pp.idproductos where p.pedido_id = '$pedido_id';");


	 while ($row4 = $query4->fetch_array(MYSQLI_BOTH)){

	 	$cantidadPedido = $row4['cantidadPedido'];
	 	$disponibleProducto = $row4['disponibleProducto'];
	 	$producto_id = $row4['producto_id'];

	 	$total = $disponibleProducto + $cantidadPedido;

		$query3 = mysqli_query($result,"UPDATE productos set disponible = '$total' where idproductos = '$producto_id';");

	 }

	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
		$query = mysqli_query($result,"UPDATE pedidos set t_costo = '$valor', estado = '0' where pedido_id = '$pedido_id';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido se canceló correctamente";
	}else{

		$msg = 'Error al cancelar el pedido. Intente nuevamente';

	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='eventos.php';
		opener.location.reload();
	</script>";
	
	echo $html;	
}