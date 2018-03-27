<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
// Realiza un conteo de la cantidad de creditos por clientes antes de realizar cualquier acción
	$query2 = mysqli_query($result,"select count(detalles) as registros from creditos where idclientes='$id'");

	$totalregistros = $query2->fetch_array(MYSQLI_BOTH);
	
// Si el cliente no tiene registros realiza la eliminación y su tiene registros no permite eliminarlos.
	if ($totalregistros['registros'] == 0) {
		
		$query = mysqli_query($result,"delete from clientes where id='$id'");
	
		if($query > 0){
			$msg = 'El cliente fue eliminado';
		}else{
			$msg = 'Error al eliminar el Cliente. Intentelo de nuevo';
		}
	
	}else{
	
		$msg = 'No es posible Eliminar el Cliente. Debe eliminar primero su historial de credito';
		
	}
// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
		
	$html = "<script>
		window.alert('$msg');
		self.location='cliente.php';
		opener.location.reload();
	</script>";
	
echo $html;	