<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$pedido_id	=	$_POST['pedido_id'];

// 
$query = mysqli_query($result,"SELECT count(*) AS conteos FROM pedidoProductos WHERE pedido_id = '$pedido_id' AND registro_id IS NULL;");

$row = $query->fetch_assoc();

$conteos = $row['conteos'];

if ($conteos != 0) {

	// Confirmar que tengan pizza completa.
	$query = mysqli_query($result,"SELECT count(*) AS conteo FROM pedidoProductos WHERE pedido_id = '$pedido_id' AND producto LIKE '%Media -%' AND registro_id IS NULL ;");

	$row = $query->fetch_assoc();

	$conteo = $row['conteo'];

	if (($conteo == 0) || ($conteo == 2) || ($conteo == 4) || ($conteo == 6)) {
	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
		$query = mysqli_query($result,"UPDATE pedidos set estado = '1' where pedido_id = '$pedido_id';");

	//Según la respuesta de la inserción se da una respuesta en un alert 
		if($query > 0){
			$msg = "El pedido se hizo correctamente";
		}else{
			$msg = 'Error al agregar el pedido. Intente nuevamente';
		}
			
		$html = "<script>
			window.alert('$msg');
			self.location='pedidos_mesas.php';
			opener.location.reload();
		</script>";
		
		echo $html;	
	} else {
		//Según la respuesta de la inserción se da una respuesta en un alert 
		$msg = "Debe seleccionar la otra mitad de la pizza para realizar la Orden.";

		$html = "<script>
			window.alert('$msg');
			javascript:history.back();
			opener.location.reload();
		</script>";
		
		echo $html;	
	}
} else {
	$msg = "El Pedido no tiene ningun producto seleccionado. Por favor seleccionelo.";

		$html = "<script>
			window.alert('$msg');
			opener.location.reload();
		</script>";
		
		echo $html;	
}


