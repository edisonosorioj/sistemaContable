<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$id=$_GET['id'];

// Realiza un conteo de la cantidad de productos por pedido antes de realizar una eliminación

// $query2 = mysqli_query($result,"select count(producto) as registros from cotizacion where pedido_id = '$id'");

// $totalregistros = $query2->fetch_array(MYSQLI_BOTH);
	
// Si el pedido no tiene productos realiza la eliminación y si tiene productos no permite eliminarlos.
	// if ($totalregistros['registros'] == 0) {
		
$query = mysqli_query($result,"delete from pedidos where pedido_id = '$id'");
$query2 = mysqli_query($result,"delete from cotizacion where pedido_id = '$id'");
$query3 = mysqli_query($result,"delete from minuto_a_minuto where pedido_id = '$id'");

if($query > 0){
	$msg = 'La cotización fue eliminada';
}else{
	$msg = 'Error al eliminar la cotización. Intentelo de nuevo';
}
	
	// }else{
	
		// $msg = 'No es posible eliminar el Pedido. Debes eliminar primero la lista de producto de este Pedido.';
		
	// }

// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
		
	$html = "<script>
		window.alert('$msg');
		self.location='cotizacion.php';
		opener.location.reload();
	</script>";
	
echo $html;	