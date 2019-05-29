<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$id				=	$_POST['id'];
$nomina			=	str_replace(".","",$_POST['nomina']);
$dias			=	$_POST['dias'];
$auxilio		=	str_replace(".","",$_POST['auxilio']);
$compensacion	=	str_replace(".","",$_POST['compensacion']);
$salud			=	str_replace(".","",$_POST['salud']);
$pension		=	str_replace(".","",$_POST['pension']);
$prestamos		=	str_replace(".","",$_POST['prestamos']);

$compensacion 	= ($compensacion == '') ? 0 : $compensacion ;
$prestamos 		= ($prestamos == '') ? 0 : $prestamos ;
$salud 			= ($salud == '') ? 0 : $salud ;
$pension 		= ($pension == '') ? 0 : $pension ;

$pago_total		=	$nomina + $compensacion;
$pago_total		=	($pago_total / 30) * $dias;
$salud			=	$pago_total * 0.04;
$pension		=	$pago_total * 0.04;
$pago_total		=	$pago_total + $auxilio ;


$devengado		=	$salud + $pension + $prestamos;
$pago_total_nomina = $pago_total - $devengado;

// Consulta para actualizar el usuario de la Nomina
$query = mysqli_query($result, "UPDATE grupoNomina set auxilio = '$auxilio', compensacion = '$compensacion', salud = '$salud', pension = '$pension', prestamos = '$prestamos', pago_total = '$pago_total_nomina', dias = '$dias' where idgrupo ='$id';");

if($query > 0){
	$msg = "La nomina del usuario fue actualizada";
}else{
	$msg = 'Error al actualizar la nómina del usuario. Contacte al Administrador';
}

// Según la respuesta de la consulta se da una respuesta en una Alert
$html = "<script>
			window.alert('$msg');
			opener.location.reload();
			window.close();
		</script>";	
	
echo $html;	