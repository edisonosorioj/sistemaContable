<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from clientes where id='$id'");
	
	if($query > 0){
		$msg = 'El cliente fue eliminado';
	}else{
		$msg = 'Error al eliminar el Cliente. Contacte al Administrador del sistema';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='compras.php';
	</script>";
	
echo $html;	