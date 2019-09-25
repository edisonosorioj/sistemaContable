<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$ano_mes 	= date('Y-m');
$dia 		= date('d');
$mes 		= date('m');
$ahora 		= date('Y-m-d');
$mas1mes 	= date('m',strtotime($ahora."+ 1 month"));

$query = mysqli_query($result,"SELECT p.cliente_id as cliente_id, p.t_cobrado, p.nombre_pedido as detalles, c.fecha as fecha_cr, p.pedido_id FROM pedidos p INNER JOIN creditos c ON p.pedido_id = c.idpedido WHERE p.recurrente = 1;");

while ($row = $query->fetch_array(MYSQLI_BOTH)) {

	$idcliente 		= $row['cliente_id'];
	$idpedido 		= $row['pedido_id'];
	$valor 			= $row['t_cobrado'];
	$detalles 		= $row['detalles'];
	$fecha_cr 		= $row['fecha_cr'];
	$nuevo_mes		= substr($fecha_cr,5,2) + 1;
	$nuevo_mes		= ($nuevo_mes < 10)?'0'.$nuevo_mes:$nuevo_mes;
	$nueva_fecha 	= substr($fecha_cr,0,4) . '-' . $nuevo_mes . '-' . substr($fecha_cr,8,2);
	$conteo 		= 0;

	// echo substr($fecha_cr,5,2) . ' - ' . $mes . " / " . substr($fecha_cr,8,2) . " - " . $dia; die();

	if (substr($fecha_cr,5,2) < $mes && substr($fecha_cr,8,2) <= $dia) {

		// Realiza la inserción de un credito agregando un signo "-" para que reste los totales
		$query3 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes, idpedido) VALUES ('$nueva_fecha', '$detalles', CONCAT('-','$valor'), '$idcliente', '$idpedido');");

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
