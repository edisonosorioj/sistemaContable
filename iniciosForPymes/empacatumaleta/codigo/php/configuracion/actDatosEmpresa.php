<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$nombre_empresa			=	$_POST['n_empresa'];
	$tipo_identificacion	=	$_POST['t_identificacion'];
	$identificacion			=	$_POST['identificacion'];
	$lugar_expedicion		=	$_POST['l_expedicion'];
	$forma_pago 			=	$_POST['forma_pago'];
	$fijo 					=	$_POST['fijo'];
	$celular 				=	$_POST['celular'];

// Consulta para actualizar el cliente
	$query1 = mysqli_query($result, "UPDATE variables set detalle = '$nombre_empresa' where variable_id = 1;");
	$query2 = mysqli_query($result, "UPDATE variables set detalle = '$tipo_identificacion' where variable_id = 2;");
	$query3 = mysqli_query($result, "UPDATE variables set detalle = '$identificacion' where variable_id = 3;");
	$query4 = mysqli_query($result, "UPDATE variables set detalle = '$lugar_expedicion' where variable_id = 4;");
	$query5 = mysqli_query($result, "UPDATE variables set detalle = '$forma_pago' where variable_id = 5;");
	$query6 = mysqli_query($result, "UPDATE variables set detalle = '$fijo' where variable_id = 6;");
	$query7 = mysqli_query($result, "UPDATE variables set detalle = '$celular' where variable_id = 7;");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if(($query1 > 0)&&($query2 > 0)&&($query3 > 0)&&($query4 > 0)&&($query5 > 0)&&($query6 > 0)&&($query7 > 0)){
		$msg = "Los datos fueron actualizados correctamente";
	}else{
		$msg = 'Error al actualizar la información. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";	
	
echo $html;	