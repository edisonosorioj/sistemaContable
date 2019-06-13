<?php
require_once "../conexion.php";

$conex 	= new conection();
$result = $conex->conex();

$id =	$_GET['id'];


$query1 = mysqli_query($result, "select * from creditos where idcreditos = '$id'");
$row=$query1->fetch_assoc();

$fecha 		= date("Y-m-d");
$valor 		= str_replace('-', '', $row['valor']);
$detalles 	= $row['detalles'];
$idclientes = $row['idclientes'];

$query2 = mysqli_query($result, "select * from clientes where id = '$idclientes'");
$row2 = $query2->fetch_assoc();

$nombreCliente = $row2['nombres'];

// Realiza la inserción de un nuevo abono en la tabla creditos sin el "-"
$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', '$valor', '$idclientes');");

$query2 = mysqli_query($result,"INSERT INTO ingresos (fecha, cantidad, producto, detalles, valor) VALUES ('$fecha', '1', CONCAT('$idclientes',' $detalles'), '$nombreCliente', '$valor');");


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
