<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$id 		=	$_POST['id'];
$fecha 		= 	$_POST['fecha'];
$detalles 	=	$_POST['detalles'];
$valor 		=	$_POST['valor'];
$idpago 	=	$_POST['idpago'];

$query0 = mysqli_query($result, "SELECT * FROM clientes WHERE id = '$id'");
$row0=$query0->fetch_assoc();

$nombreCliente = $row0['nombres'];

// Realiza la inserción de un nuevo abono en la tabla creditos sin el "-"
$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', '$valor', '$id');");

$idcreditos = mysqli_insert_id($result);

// Realiza la inserción de un nuevo abono en la tabla creditos sin el "-"
$query2 = mysqli_query($result,"UPDATE creditos SET idpago = '$idcreditos' where idcreditos = '$idpago';");

$query3 = mysqli_query($result,"INSERT INTO ingresos (fecha, cantidad, producto, detalles, valor) VALUES ('$fecha', '1', CONCAT('$id',' $detalles'), '$nombreCliente', '$valor');");

// Acción que determina si la acción fue realizada con exito o no.
if($query > 0){
	$msg = 'El abono fue agregado con exito';
}else{
	$msg = 'Error al agregar el abono. Contácte al Administrador';
}

$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;
