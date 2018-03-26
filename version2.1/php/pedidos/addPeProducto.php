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
	$pedido_id 	=	$_POST['pedido_id'];
	$cliente_id	=	$_POST['cliente_id'];



// Agrega nuevos usuarios según el formulario recibido
	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE nombre = '$producto';");

	$row = $query2->fetch_assoc();
 	$producto_id = $row['idproductos'];
 	$valor = $row['valor'];
 	$canProducto = $row['cantidad'] - $cantidad;

 	$valort = $valor * $cantidad;

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) 
									VALUES ('$producto', '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '$producto_id');");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido " . $nombre . " fue agregado";
	}else{
		$msg = 'Error al agregar el cliente. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	