<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id = $_GET['id'];

// Se hace la eliminacion y dependiendo del resultado nos devuelve un mensaje
$query = mysqli_query($result, "delete from estadoCuentas where idescuentas = '$id'");

if($query > 0){
	$msg = 'El registro fue eliminado';
}else{
	$msg = 'Error al eliminar el registro. Intentalo de nuevo';
}

// Se construye el HTML
$html = "<script>
	window.alert('$msg');
	javascript:history.back();
</script>";
	
echo $html;
