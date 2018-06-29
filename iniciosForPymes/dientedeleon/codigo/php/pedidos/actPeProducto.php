<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$producto		=	$_POST['nuevo_producto'];
	$tipo			=	$_POST['nuevo_tipo'];
	$detalles		=	$_POST['detalles'];
	$cantidad		=	$_POST['cantidad'];

// Consulta para que aparezca la información de los productos disponibles
	$query2 = mysqli_query($result,"SELECT * FROM productos WHERE idproductos = '$producto';");

	$row = $query2->fetch_assoc();

 	$nombreProducto = $row['nombres'];

// Consulta para que aparezca la información de los tipos de productos disponibles
 	$query3 = mysqli_query($result,"SELECT * FROM tipoProducto WHERE idtipo = '$tipo';");

	$row = $query3->fetch_assoc();

	$nombreTipo = $row['nombre'];
 	$valor = $row['precio'];

// Construccion de variables antes de la actualizacion
 	$valort = $valor * $cantidad;
 	$proDetalles = $nombreProducto . ' - ' . $nombreTipo . ' - ' . $detalles;

if ($producto = ) {
	# code...
}

// Consulta para actualizar el el producto del pedido
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