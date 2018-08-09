<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$evento			=	$_POST['tipo_evento'];
	$start			=	$_POST['start'];
	$time1			=	$_POST['hora_i'];
	$end			=	$_POST['end'];
	$time2			=	$_POST['hora_f'];
	$cliente 		=	$_POST['cliente'];
	$sede			=	$_POST['sede'];
	$invitado		=	$_POST['invitados'];
	$instalaciones	=	$_POST['instalaciones'];


// Agrega Parametros Basicos de la cotización
	$query2 = mysqli_query($result,"UPDATE cotizacion SET tipo_evento = '$evento', invitados = '$invitado', entrada = '$entrada', plato_fuerte = '$plato_fuerte', mezcladores = '$mezcladores', menaje = '$menaje', personal = '$personal', direccionamiento = '$direccionamiento', licor = '$licor', observaciones = 'observaciones', pedido_id = '$pedido_id', valor = '$valor'");
	

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La cotización fue guardada";
	}else{
		$msg = 'Error guardar la cotización. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	