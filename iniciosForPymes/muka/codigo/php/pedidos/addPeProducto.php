<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$producto	=	$_POST['producto'];
	$cantidad 	=	$_POST['cantidad'];
	$detalles 	=	$_POST['detalles'];
	$pedido_id 	=	$_POST['pedido_id'];
	$cliente_id =	$_POST['cliente_id'];

$query3 = mysqli_query($result, "select * from pedidos where pedido_id = '$pedido_id'");

$row3 = $query3->fetch_assoc();

$estado = $row3['estado'];

if ($estado == 1) {
	 
	$msg = "El pedido ya fue realizado, no es posible agregar mas productos. Si desea hacerlo debe cancelarlo primero el pedido y despues agregar el producto";

	$html = "<script>
		window.alert('$msg');
		javascript:history.back();
	</script>";

	echo $html;	

}else{

// Consulta para que aparezca la información de los productos disponibles
	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE nombre = '$producto';");

	$row = $query2->fetch_assoc();

 	$producto_id 	= $row['idproductos'];
 	$valor 			= $row['valor'];
 	$disponible 	= $row['disponible'];

 	$valort = $valor * $cantidad;

// Agrega producto a la tabla pedidoProductos
 	if ($disponible > 0) {
		$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) VALUES ( CONCAT('$producto', ' - ' ,'$detalles'), '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '$producto_id');");
		$html = "<script>
			javascript:history.back();
		</script>";
		echo $html;
 	}else{

		$html = "<script>
					window.alert('No hay disponibilidad del producto. Actualice desde el Módulo de Inventarios');
					javascript:history.back();
				</script>";

		echo $html;	
 	}
}