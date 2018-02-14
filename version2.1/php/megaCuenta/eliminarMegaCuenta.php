<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from estadoCompras where idestado = '$id'");
	
if($query > 0){
	$msg = 'La cuenta fue eliminada';
}else{
	$msg = 'Error al eliminar la cuenta. Intente de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='estadoCompras.php';
</script>";
	
echo $html;