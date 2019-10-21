<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$id 		= $_GET['id'];
$ano_mes 	= date('Y-m');
$dia 		= date('d');
$mes 		= date('m');
$ahora 		= date('Y-m-d');
$mas1mes 	= date('m',strtotime($ahora."+ 1 month"));

$query = mysqli_query($result,"SELECT * FROM creditos c WHERE idclientes = '$id' AND valor < 0 AND idpago IS NULL AND idpedido IS NOT NULL;");

while ($row = $query->fetch_array(MYSQLI_BOTH)) {

	$id_credito		= $row['idcreditos'];
	$fecha_cr 		= $row['fecha'];
	// $fecha_cr 		= '2019-09-05';
	$dia_cr			= substr($fecha_cr,8,2);
	$valor			= $row['valor'];
	$por_int 		= 0.02;
	$conteo 		= 0;

	$resta_fecha = abs(strtotime($ahora) - strtotime($fecha_cr));

	$years 	= floor($resta_fecha / (365*60*60*24));
	$months = floor(($resta_fecha - $years * 365*60*60*24) / (30*60*60*24));
	$days 	= floor(($resta_fecha - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	$days = ( $months == 1 ) ? $days + 30 : $days;
	$days = ( $months == 2 ) ? $days + 60 : $days;
	$days = ( $months == 3 ) ? $days + 90 : $days;
	$days = $days - 5;

	$interes_dia	= -1*($valor * $por_int);
	$interes_total	= -1*($interes_dia * $days);

	// echo $ahora . ' - ' . $fecha_cr . ' / ' . $days . '<br />';
	// echo $id_credito . ' - ' . $interes_dia . ' - ' . $interes_total;die();


	if ($days > 0) {

		// Realiza la inserción de un credito agregando un signo "-" para que reste los totales
		$query3 = mysqli_query($result,"UPDATE creditos set intereses = '$interes_total', dias_mora = '$days' where idcreditos = '$id_credito';");

		$conteo = $conteo + 1;
	} 

}

if($conteo > 0){
	$msg = 'Se agregaron ' . $conteo . ' registros' ;
}else{
	$msg = 'No se agrego ningún registro';
}
	
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";
	
echo $html;
