<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$iva	=	$_POST['iva'];

// Consulta para actualizar el cliente
$query1 = mysqli_query($result, "UPDATE variables set detalle = '$iva' WHERE variable_id = 11;");

// Según la respuesta de la consulta se da una respuesta en una Alert
if($query1 > 0){
	$msg = "Los datos fueron actualizados correctamente";
}else{
	$msg = 'Error al actualizar la información. Contacte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";	
	
echo $html;