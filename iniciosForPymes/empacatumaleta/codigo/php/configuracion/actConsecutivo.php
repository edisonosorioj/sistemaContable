<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$consecutivo	=	$_POST['consecutivo'];

	$query = mysqli_query($result, "SELECT * FROM variables WHERE variable_id = 8");
	$row=$query->fetch_assoc();

	$consecutivo_guardado = $row['detalle'];

if ($consecutivo <= $consecutivo_guardado) {

	$msg = "El consecutivo debe ser mayor a $consecutivo_guardado. Intentalo nuevamente";

	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";	

	echo $html;	

}else{

// Consulta para actualizar el cliente
	$query1 = mysqli_query($result, "UPDATE variables set detalle = '$consecutivo' WHERE variable_id = 8;");
	$query2 = mysqli_query($result, "ALTER TABLE `pedidos` AUTO_INCREMENT = $consecutivo;");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query1 > 0){
		$msg = "Los datos fueron actualizados correctamente";
	}else{
		$msg = 'Error al actualizar la información. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";	
	
echo $html;	
}