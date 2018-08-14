<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from lista_precios where id='$id'");
	
	if($query > 0){
		$msg = 'El producto fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el producto. Intente de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='lista_precios.php';
	</script>";



echo $html;	