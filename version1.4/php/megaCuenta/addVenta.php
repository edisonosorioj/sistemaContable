<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad 	= 	$_POST['cantidad'];
	$producto 	= 	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

$query = mysqli_query($result,"INSERT INTO estadocuentas (fecha, cantidad, producto, detalles, valor, idestado) 
								VALUES ('$fecha', '$cantidad', '$producto', '$detalles', '$valor', '$id');");

$query2 = mysqli_query($result,"UPDATE productos SET disponible = disponible + $cantidad
									WHERE nombre = '$producto';");

$query2 = mysqli_query($result, "SELECT * FROM estadoCompras where idestado = '$id';");

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