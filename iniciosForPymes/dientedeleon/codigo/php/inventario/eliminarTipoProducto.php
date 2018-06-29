<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from tipoProducto where idtipo = '$id'");
	
	if($query > 0){
		$msg = 'El tipo fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el tipo. Intente de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='tipos.php';
	</script>";



echo $html;	