<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', CONCAT('-','$valor'), '$id');");

$query2 = mysqli_query($result, "SELECT * FROM clientes where id = '$id';");

$row=$query2->fetch_assoc();

$idcliente = $row['id'];


if($query > 0){
	$msg = 'El registro fue agregado';
}else{
	$msg = 'Error al agregar el registro. Intenta de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='creditos.php?id=" . $idcliente . "';
</script>";
	
echo $html;
