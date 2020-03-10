<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from cuadre_caja where id_cuadre = '$id'");
	 
	if($query > 0){
		$msg = 'El Cuadre fue eliminado';
	}else{
		$msg = 'Error al eliminar el cuadre. Intentelo de nuevo!';
	}

// Contruye el Alert y regresa a Egresos 
	$html = "<script>
		window.alert('$msg');
		self.location='cuadre_caja.php';
	</script>";

echo $html;	
			