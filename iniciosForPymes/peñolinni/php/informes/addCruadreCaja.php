<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$fecha		=	date('Y-m-d');
$balance	=	$_POST['balance'];
$cuadre		=	$_POST['cuadre'];
$usuario 	=	$_SESSION['login'];

$cuadre_caja = $balance - $cuadre;

if ($cuadre_caja > 2000 || $cuadre_caja < -2000){

	$msg = 'Descuadre. Desface de ' . $cuadre_caja;

}else{

	$msg = 'Cuadre Correcto. Desface de ' . $cuadre_caja;

}

$query = mysqli_query($result,"INSERT INTO cuadre_caja (fecha, valor_ventas, cuadre_caja, balance, estado, realizado_por) VALUES ('$fecha', '$cuadre', '$balance', '$cuadre_caja', 0, '$usuario');");
// Obtiene la información del total del pedido por medio del PEDIDO ID

if($query > 0){
	$msg .= "<br />El cuadre fue agregado.";
}else{
	$msg .= "<br />Error al agregar el cuadre. Intente nuevamente";
}	
	
$html = "<script>
	window.alert('$msg');
	window.opener.document.location='cuadre_caja.php';
	window.close();
</script>";

echo $html;	