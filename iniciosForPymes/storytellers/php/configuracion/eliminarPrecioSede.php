<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from precio_x_dia where pxd_id='$id'");
	 
	if($query > 0){
		$msg = 'El Precio de la sede para el día fue eliminado';
	}else{
		$msg = 'Error al eliminar. Intentelo de nuevo.';
	}

// Contruye el Alert y regresa a Egresos 
	$html = "<script>
		window.alert('$msg');
		self.location='verSedes.php';
	</script>";

echo $html;	
			