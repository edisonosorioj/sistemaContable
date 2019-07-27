<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 			=	$_POST['fecha'];
	$detalles 		=	$_POST['detalles'];
	$valor 			=	$_POST['valor_masivo'];


$query = mysqli_query($result,'select c.id from clientes c order by c.id');


while ($row = $query->fetch_array(MYSQLI_BOTH)) {

	$id = $row['id'];

// Realiza la inserción de un credito agregando un signo "-" para que reste los totales
	$query2 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', CONCAT('-','$valor'), '$id') WHERE estado = 1;");

}

if($query > 0){
	$msg = 'El registro fue agregado';
}else{
	$msg = 'Error al agregar el registro. Intenta de nuevo';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;
