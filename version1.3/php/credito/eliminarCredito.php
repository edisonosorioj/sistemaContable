<?php 
// Version 1.3 of Edison Osorio
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Trae el ID seleccionado a eliminar
$id = $_GET['id'];

// Realiza la eliminacion del credito enviado. Y genera un mensaje seg[un las respuesta mySql
$query = mysqli_query($result, "delete from creditos where idcreditos = '$id'");

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
