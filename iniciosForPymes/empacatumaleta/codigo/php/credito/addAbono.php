<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id 		=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query1 = mysqli_query($result, "select * from clientes where id = '$id'");
	$row=$query1->fetch_assoc();

	$nombreCliente = $row['nombres'];


// Realiza la inserción de un nuevo abono en la tabla creditos sin el "-"
$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', '$valor', '$id');");


$query2 = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) VALUES ('1', CONCAT('$id',' $detalles'), '$nombreCliente', '$valor', '$fecha');");


// Acción que determina si la acción fue realizada con exito o no.
if($query > 0){
	$msg = 'El abono fue agregado con exito';
}else{
	$msg = 'Error al agregar el abono. Contacte al Administrador';
}


$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;
