<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from compras where idcompras='$id'");
	 
	if($query > 0){
		$msg = 'El egreso fue eliminado';
	}else{
		$msg = 'Error al eliminar el egreso. Intentelo de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";

echo $html;	
			