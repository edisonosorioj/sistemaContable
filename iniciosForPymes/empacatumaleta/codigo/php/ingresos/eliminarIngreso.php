<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from ingresos where idingresos='$id'");
	
	if($query > 0){
		$msg = 'El ingreso fue eliminado';
	}else{
		$msg = 'Error al eliminar el ingreso. Intentelo de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='ingresos.php';
	</script>";

echo $html;	