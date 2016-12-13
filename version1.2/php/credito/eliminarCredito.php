<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id = $_GET['id'];
	
$query = mysqli_query($result, "delete from creditos where idcreditos = '$id'");

$query2 = mysqli_query($result, "SELECT * FROM creditos where idcreditos = '$id' limit 1;");

$row=$query2->fetch_assoc();

$idcliente = $row['idclientes'];

if($query > 0){
	$msg = 'El registro fue elimina';
}else{
	$msg = 'Error al eliminar el registro. Intentalo de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='creditos.php?id=" . $idcliente . "';
</script>";
	
echo $html;
