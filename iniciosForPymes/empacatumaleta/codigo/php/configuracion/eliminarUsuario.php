<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from administradores where idadmin='$id'");
	 
	if($query > 0){
		$msg = 'El Usuario fue eliminado';
	}else{
		$msg = 'Error al eliminar el Usuario. Intentelo de nuevo.';
	}

// Contruye el Alert y regresa a Egresos 
	$html = "<script>
		window.alert('$msg');
		self.location='verUsuarios.php';
	</script>";

echo $html;	
			