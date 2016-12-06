<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];


$query = mysqli_query($result, "UPDATE estadoCuentas set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', 
								detalles = '$detalles', valor = '$valor' where idescuentas = '$id';");

$query2 = mysqli_query($result, "SELECT * FROM estadoCuentas where idescuentas = '$id' limit 1;");

$row=$query2->fetch_assoc();

$idestado = $row['idestado'];

if($query > 0){
	$msg = 'El registro fue agregado';
}else{
	$msg = 'Error al agregar el registro. Intentelo de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	self.location='estadoCuentas.php?id=" . $idestado . "';
</script>";
	
echo $html;