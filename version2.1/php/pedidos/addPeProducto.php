<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$producto	=	$_POST['producto'];
	$cantidad 	=	$_POST['cantidad'];
	$pedido_id 	=	$_POST['id'];



// Consulta para que aparezca la información de los productos disponibles
	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE nombre = '$producto';");

	$row = $query2->fetch_assoc();

 	$producto_id = $row['idproductos'];
 	$valor = $row['valor'];
 	$canProducto = $row['disponible'] - $cantidad;

 	$valort = $valor * $cantidad;

// Genera el ID de Cliente y del Pedido para tabla
 	$query3 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");

 	$row2 = $query3->fetch_assoc();

 	$cliente_id = $row2['cliente_id'];

// Agrega producto a la tabla pedidoProductos
	$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) 
									VALUES ('$producto', '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '$producto_id');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El producto fue agregado";
	}else{
		$msg = 'Error al agregar el cliente. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	