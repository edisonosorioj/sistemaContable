<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$id=$_GET['id'];

// Obtiene la información del productopedido por medio del PEPRODUCTO ID
	$query3 = mysqli_query($result,"SELECT * FROM pedidoProductos WHERE peproducto_id = '$id';");
	$row3 	= $query3->fetch_assoc();

	$pedido_id = $row3['pedido_id'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query2 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
	$row2 	= $query2->fetch_assoc();

	$estado = $row2['estado'];
	
// Realiza la eliminación del producto.


if ($estado == 1) {

 	$msg = "El producto no puede ser eliminado, debes cancelar primero el registro";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{
		
	$query = mysqli_query($result,"delete from pedidoProductos where peproducto_id = '$id'");

	if($query > 0){
		$msg = 'El producto del Pedido fue eliminado';
	}else{
		$msg = 'Error al eliminar producto Pedido. Intentelo de nuevo';
	}
		
	// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
			
		$html = "<script>
			window.alert('$msg');
			history.back(1);
			opener.location.reload();
		</script>";
		
	echo $html;	
}