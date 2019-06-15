<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$id			=	$_POST['id'];
	$producto	=	$_POST['producto'];
	$cantidad 	=	$_POST['cantidad'];
	$detalles 	=	$_POST['detalles'];
	$pedido_id 	=	$_POST['pedido_id'];
	$cliente_id =	$_POST['cliente_id'];
	$tamano 	=	$_POST['tamano'];
	$nota 		=	$_POST['nota'];
	$grupo 		=	$_POST['grupo'];
	$can_adicion=	$_POST['can_adicion'];
	$valort		= 	'';
	$dtamano	= 	'';

	if ($detalles == 'Junior') {
		$valor_adicion = 500;
	} elseif ($detalles == 'Personal') {
		$valor_adicion = 1000;
	} elseif ($detalles == 'Ejecutiva') {
		$valor_adicion = 2000;
	} elseif ($detalles == 'Mediana') {
		$valor_adicion = 3000;
	} elseif ($detalles == 'Familiar') {
		$valor_adicion = 3500;
	} else {
		$valor_adicion = 0;
	}

// Consulta para que aparezca la información de los productos disponibles
	$query2 = mysqli_query($result,"SELECT * FROM precio_x_item WHERE idprecios = '$id';");

	$row = $query2->fetch_assoc();

 	$valor 	= $row['valor'];

	if ($tamano == 1) {
		$dtamano 		= ($grupo == 1) ? "Completa" : "" ;
		$text_adicion 	= ($can_adicion >= 1) ? "Adición de " : "" ;
		$valort 		= $valor + $valor_adicion;
		$valort 		= $valort * $cantidad;

	// Agrega producto a la tabla pedidoProductos
		$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) VALUES ( CONCAT('$producto', ' - ' ,'$detalles', ' - ', '$dtamano', ' - ', '$text_adicion',' $nota'), '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '0');");

		$html = "<script>
			opener.location.reload();
			window.close();
		</script>";

		echo $html;
	} else {
		if (($detalles == 'Junior')||($detalles == 'Personal')) {
			$msg = "Para Media Pizza debe ser despúes de Ejecutiva";

			$html = "<script>
				window.alert('$msg');
				javascript:history.back();
			</script>";

			echo $html;	

		} else {
			$dtamano = "Media";
			$valort = $valor + $valor_adicion;
			$valort = ($valor/2) * $cantidad;
			// $valort = (substr($valort, -3) == 500 ) ? $valort + 500 : $valort ;

			// Agrega producto a la tabla pedidoProductos
			$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) VALUES ( CONCAT('$producto', ' - ' ,'$detalles', ' - ', '$dtamano', ' - ', '$nota'), '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '0');");

			$html = "<script>
				opener.location.reload();
				window.close();
			</script>";

			echo $html;
		}
	}

