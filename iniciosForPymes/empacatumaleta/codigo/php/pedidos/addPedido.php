<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$cliente 	=	$_POST['cliente'];
	$nombre		=	$_POST['nombre'];
	$fecha		=	$_POST['fecha'];
	$f_viaje	=	$_POST['f_viaje'];
	$idadmin	=	$_POST['idadmin'];
	$proveedor	=	$_POST['proveedor'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO pedidos (cliente_id, nombre_pedido, fecha, estado, usuario_id, fecha_viaje, proveedor_id) VALUES ('$cliente', '$nombre', '$fecha', '0', '$idadmin', '$f_viaje', '$proveedor');");
	
	$consecutivo = mysqli_insert_id($result);

	$query3 = mysqli_query($result,"UPDATE variables SET detalle = '$consecutivo' WHERE variable_id = 8;");

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

	mysql_close($result);
	
echo $html;	