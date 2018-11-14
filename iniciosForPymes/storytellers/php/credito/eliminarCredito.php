<?php 
// Version 1.3 of Edison Osorio
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Trae el ID seleccionado a eliminar
$id = $_GET['id'];

// Realiza la eliminacion del credito enviado. Y genera un mensaje seg[un las respuesta mySql
$query = mysqli_query($result, "delete from creditos where idcreditos = '$id'");

// Si hay algun error en la eliminación genera una alerta con un mensaje. Sino simplemente recarga la pagina
if($query == 0){
	$html = "<script>
				window.alert('Error al eliminar el registro. Intentalo de nuevo);
				javascript:history.back();
			</script>";
}else{
	$html = "<script>
				javascript:history.back();
			</script>";
}


	
echo $html;
