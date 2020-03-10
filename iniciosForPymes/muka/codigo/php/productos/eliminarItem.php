<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"DELETE FROM precio_x_item WHERE idproductos = '$id'");
	
	if($query > 0){
		$msg = 'El item fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el item. Intente de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='productos.php';
	</script>";



echo $html;	