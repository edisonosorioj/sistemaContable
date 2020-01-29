<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
// Realiza un conteo de la cantidad de creditos por clientes antes de realizar cualquier acción
		
$query = mysqli_query($result,"delete from usuarios where iduser = '$id'");

if($query > 0){
	$msg = 'El Usuario fue eliminado';
}else{
	$msg = 'Error al eliminar el Usuario. Intentelo de nuevo';
}

// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
		
	$html = "<script>
		window.alert('$msg');
		self.location='usuarios.php';
		opener.location.reload();
	</script>";
	
echo $html;	