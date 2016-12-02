<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from compras where idcompras='$id'");
	 
	if($query > 0){
		$msg = 'El usuario fue eliminado con exito';
	}else{
		$msg = 'Error al Eliminar el usuario';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";
	
echo $html;	
			