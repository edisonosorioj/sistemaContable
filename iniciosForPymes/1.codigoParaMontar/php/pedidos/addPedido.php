<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$nombre		=	$_POST['nombre'];
	$cliente 	=	$_POST['cliente'];
	$fecha		=	$_POST['fecha'];



// Agrega nuevos usuarios según el formulario recibido
	$query2 = mysqli_query($result,"SELECT * FROM clientes WHERE nombres = '$cliente';");

	$row = $query2->fetch_assoc();
 	$cliente_id = $row['id'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO pedidos (cliente_id, nombre_pedido, fecha, estado) VALUES ('$cliente_id', '$nombre', '$fecha', '0');");
	
	$consecutivo = mysqli_insert_id($result);

	$query3 = mysqli_query($result,"UPDATE variables SET detalle = '$consecutivo' WHERE variable_id = 8;");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido " . $nombre . " fue agregado";
	}else{
		$msg = 'Error al agregar el pedido. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";

	mysql_close($result);
	
echo $html;	