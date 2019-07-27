<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
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
$adicion 	=	(isset($_POST['adicion']))? $_POST['adicion'] : 0 ;
$valort		= 	'';
$dtamano	= 	'';
$adiciones	=	'';

// Confirma que la cantidad exista y le asigna valores segun la necesidad
if ($adicion > 0 && !is_array($adicion)) {
	$can_adicion = $adicion;
} else if (is_array($adicion)){
	$can_adicion = count($adicion);
}else{
	$can_adicion = 0;
}


for ($i=0;$i<count($adicion);$i++)    
{     
 $adiciones .= $adicion[$i] . ' ';    
}

// Consulta para que aparezca la información de los productos disponibles
$query2 = mysqli_query($result,"SELECT * FROM precio_x_item WHERE idprecios = '$id';");

$row = $query2->fetch_assoc();

	$valor 	= $row['valor'];
	$iditems= $row['iditems'];

if ($can_adicion != 0 && $iditems <= 14){
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
} else if ($can_adicion != 0 && $iditems == 20){
	$valor_adicion = 500;
} else if ($can_adicion != 0 && $iditems == 21){
	$valor_adicion = 1000;
} else if ($can_adicion != 0 && $iditems == 23){
	if ($detalles == 'Pequeño') {
		$valor_adicion = 500;
	} elseif ($detalles == 'Grande') {
		$valor_adicion = 1000;
	}
}

if ($tamano == 1) {
	$dtamano 		= ($grupo == 1) ? "Completa" : "" ;
	$text_adicion 	= ($can_adicion >= 1) ? "Adición de " : "" ;
	$valor_adicion  = $can_adicion * $valor_adicion;
	$valort 		= $valor + $valor_adicion;
	$valort 		= $valort * $cantidad;

// Agrega producto a la tabla pedidoProductos
	$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) VALUES ( CONCAT('$producto', ' - ' ,'$detalles', ' - ', '$dtamano', ' - ', '$text_adicion','$adiciones $nota'), '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '$iditems');");

	$query = mysqli_query($result,"UPDATE pedidos set estado = '1' where pedido_id = '$pedido_id';");

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

		// Agrega producto a la tabla pedidoProductos
		$query = mysqli_query($result,"INSERT INTO pedidoProductos (producto, valoru, cantidad, valort, pedido_id, cliente_id, producto_id) VALUES ( CONCAT('$producto', ' - ' ,'$detalles', ' - ', '$dtamano', ' - ', '$nota'), '$valor', '$cantidad', '$valort', '$pedido_id', '$cliente_id', '0');");

		$query2 = mysqli_query($result,"UPDATE pedidos set estado = '0' where pedido_id = '$pedido_id';");

		$html = "<script>
			opener.location.reload();
			window.close();
		</script>";

		echo $html;
	}
}