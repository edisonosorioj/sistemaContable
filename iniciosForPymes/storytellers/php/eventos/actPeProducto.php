<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$producto		=	$_POST['nuevo_producto'];
	$detalles		=	$_POST['detalles'];
	$cantidad		=	$_POST['cantidad'];

// Consulta para que aparezca la información de los productos disponibles
	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE nombre = '$producto';");

	$row = $query2->fetch_assoc();

 	$producto_id = $row['idproductos'];
 	$valor = $row['valor'];

 	$valort = $valor * $cantidad;

 	$proDetalles = $producto . ' - ' . $detalles;

 	// echo $proDetalles;die();

// Consulta para actualizar el cliente
	$query = mysqli_query($result, "UPDATE pedidoproductos set producto = '$proDetalles', valoru = '$valor', cantidad = '$cantidad', valort = '$valort' where peproducto_id ='$id';");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El producto del pedido ". $producto ." fue actualizado";
	}else{
		$msg = 'Error al actualizar el producto del pedido. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	