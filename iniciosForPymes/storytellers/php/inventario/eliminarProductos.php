<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from productos where idproductos='$id'");
	
	if($query > 0){
		$html = "<script>
			self.location='inventario.php';
		</script>";
	}else{
		$msg = 'Error al eliminar el producto. Intente de nuevo!';
		$html = "<script>
			window.alert('$msg');
			self.location='inventario.php';
		</script>";
	}



echo $html;	