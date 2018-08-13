<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from proveedores where proveedor_id ='$id'");
	
	if($query > 0){
		$msg = 'El proveedor fue eliminado con exito';
	}else{
		$msg = 'Error al eliminar el proveedor. Intente de nuevo!';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='inventario.php';
	</script>";



echo $html;	