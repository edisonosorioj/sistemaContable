<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];

	$query2 = mysqli_query($result,"select count(detalles) as registros from creditos where idclientes='$id'");

	$totalregistros = $query2->fetch_array(MYSQLI_BOTH);
	
	
	if ($totalregistros['registros'] == 0) {
		
		$query = mysqli_query($result,"delete from clientes where id='$id'");
	
		if($query > 0){
			$msg = 'El cliente fue eliminado';
		}else{
			$msg = 'Error al eliminar el Cliente. Contacte al Administrador del sistema';
		}
	
	}else{
	
		$msg = 'No es posible Eliminar el Cliente. Debe eliminar primero su historial de credito';
		
	}

		
	$html = "<script>
		window.alert('$msg');
		self.location='clientes.php';
	</script>";
	
echo $html;	