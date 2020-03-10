<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$nomina	=	$_POST['nomina'];

// Consulta para actualizar el cliente
$query1 = mysqli_query($result, "UPDATE variables set detalle = '$nomina' WHERE variable_id = 12;");

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