<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$id		=	$_POST['id'];
$nombre	=	$_POST['nombre'];
$valor 	=	$_POST['valor'];

echo $id . ' - ' . $nombre . ' - ' . $valor;

// Consulta para actualizar el cliente
$query = mysqli_query($result, "UPDATE precio_x_item set nombre = '$nombre', valor = '$valor' where idprecios = '$id';");

// Según la respuesta de la consulta se da una respuesta en una Alert
if($query > 0){
	$msg = "El producto " . $nombre . " fue actualizado";
}else{
	$msg = 'Error al actualizar el Producto. Contacte al Administrador';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";	
	
echo $html;	