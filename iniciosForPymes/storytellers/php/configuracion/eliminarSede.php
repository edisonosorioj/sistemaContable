<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
$id=$_GET['id'];

$query = mysqli_query($result,"SELECT count(*) AS conteo FROM pedidos WHERE sede_id = '$id';");

$row = $query->fetch_assoc();
$conteo = $row['conteo'];

if ($conteo == 0) {
	$query1 = mysqli_query($result,"DELETE FROM sede WHERE sede_id = '$id';");

	$query2 = mysqli_query($result,"DELETE FROM precio_x_dia WHERE sede_id = '$id';");
	 
	if($query1 > 0){
		$msg = 'La sede fue eliminada correctamente';
	}else{
		$msg = 'Error al eliminar. Verifique que la sede no se este utilizando en una Cotización';
	}

// Contruye el Alert y regresa a Sede 
	$html = "<script>
		window.alert('$msg');
		self.location = 'verSedes.php';
	</script>";

	echo $html;	
} else {

	$msg = 'No es posible Eliminar. La Sede está siendo utilizada en una o varias cotizaciones.';
	
	$html = "<script>
		window.alert('$msg');
		self.location = 'verSedes.php';
	</script>";

	echo $html;
}


	
	
			