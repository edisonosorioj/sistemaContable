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

$query = mysqli_query($result,"SELECT * FROM creditos c WHERE idcliente = '$id' AND valor < 0 AND idpago IS NULL AND idpedido IS NOT NULL;");

while ($row = $query->fetch_array(MYSQLI_BOTH)) {

	$id_credito		= $row['idcreditos'];
	$fecha_cr 		= $row['fecha'];
	$dia_cr			= substr($fecha_cr,8,2);
	$valor			= $row['valor'];
	$dia_mora		= $dia - ($dia_cr + 5);
	$por_int 		= 0.02;
	$interes_dia	= $valor * $por_int;
	$interes_total	= $interes_dia * $dia_mora;

	echo $dia_mora . ' - ' . $interes_total; die();

	if ($dia_mora > 0) {

		// Realiza la inserción de un credito agregando un signo "-" para que reste los totales
		$query3 = mysqli_query($result,"UPDATE creditos set intereses = '$interes_total' where idcreditos = '$id_credito';");

		$conteo++;
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
