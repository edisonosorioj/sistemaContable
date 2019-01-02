<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$proveedor	=	$_POST['proveedor'];
	$nombre		=	$_POST['nombre'];
	$disponible	=	$_POST['disponible'];
	$costo		=	$_POST['costo'];
	$valor		=	$_POST['valor'];


	$query = mysqli_query($result,"INSERT INTO productos (fecha, nombre, disponible, costo, valor, proveedor_id) VALUES ('$fecha','$nombre', '0', '$costo', '$valor', '$proveedor');");


	$query2 = mysqli_query($result, "SELECT * FROM productos ORDER BY idproductos DESC LIMIT 1");
	
	$row = $query2->fetch_array(MYSQLI_BOTH);
 	$idproductos = $cartera['idproductos'];

	$query3 = mysqli_query($result,"INSERT INTO novedadProducto (productoId, detalles, cantidad, fecha) VALUES ('$idproductos', 'Inventario Inicial', '$disponible', '$fecha')");
	
	if($query > 0){
		$msg = 'El producto fue agregado';
	}else{
		$msg = 'Error al agregar el producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	