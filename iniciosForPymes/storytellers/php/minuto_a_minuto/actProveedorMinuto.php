<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$minuto_id	=	$_POST['minuto_id'];
$proveedor 	= 	$_POST['proveedor'];


// Actualiza el registro de la compra por medio de la consulta siguiente
$query = mysqli_query($result, "UPDATE minuto_a_minuto set proveedor = '$proveedor' where minuto_id = '$minuto_id';");


// Genera la alerta según el resultado del QUERY
$html = "<script>
	opener.location.reload();
	window.close();
</script>";
	
echo $html;	