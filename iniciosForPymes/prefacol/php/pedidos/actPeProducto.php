<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$producto_id	=	$_POST['producto_id'];
	$producto		=	$_POST['nuevo_producto'];
	$detalles		=	$_POST['detalles'];
	$cantidad		=	$_POST['cantidad'];

	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE idproductos = '$producto_id';");

	$row = $query2->fetch_assoc();

 	$valor 	= $row['valor'];
 	$nombre = $row['nombre'];

 	$valort = $valor * $cantidad;

if ($producto_id == $producto) {

 	if ($detalles == '') {
	// Consulta para actualizar el producto del pedido
		$query = mysqli_query($result, "UPDATE pedidoProductos set valoru = '$valor', cantidad = '$cantidad', valort = '$valort' WHERE peproducto_id = '$id';");
 		
 	} else {
		
 		$proDetalles = $nombre . ' - ' . $detalles;

	// Consulta para actualizar el producto del pedido
		$query = mysqli_query($result, "UPDATE pedidoProductos set producto = '$proDetalles', valoru = '$valor', cantidad = '$cantidad', valort = '$valort' WHERE peproducto_id = '$id';");
 	}
 	

} else {
 	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE idproductos = '$producto';");

	$row = $query2->fetch_assoc();

 	$valor 	= $row['valor'];
 	$nombre = $row['nombre'];

 	$valort = $valor * $cantidad;
 	$proDetalles = $nombre . ' - ' . $detalles;

	// Consulta para actualizar el producto del pedido
	$query = mysqli_query($result, "UPDATE pedidoProductos SET producto = '$proDetalles', valoru = '$valor', cantidad = '$cantidad', valort = '$valort', producto_id = '$producto' WHERE peproducto_id = '$id';");
}


// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "El producto ". $nombre ." del pedido fue actualizado";
	}else{
		$msg = 'Error al actualizar el producto del pedido. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";	
	
echo $html;	