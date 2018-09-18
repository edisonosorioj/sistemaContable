<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$cotizacion_id		=	$_POST['cotizacion_id'];
	$pedido_id			=	$_POST['pedido_id'];
	$evento				=	$_POST['tipo_evento'];
	$invitado			=	$_POST['invitados'];
	$entrada			=	$_POST['entrada'];
	$plato_fuerte		=	$_POST['plato_fuerte'];
	$mezcladores		=	$_POST['mezcladores'];
	$menaje				=	$_POST['menaje'];
	$personal 			=	$_POST['personal'];
	$direccionamiento	=	$_POST['direccionamiento'];
	$licor				=	$_POST['licor'];
	$observaciones		=	$_POST['observaciones'];
	$valor				=	$_POST['valor'];
	$cuotas				=	$_POST['cuotas'];
	$abono				=	$_POST['abono'];


// Agrega Parametros Basicos de la cotización
	$query = mysqli_query($result,"UPDATE cotizacion SET tipo_evento = '$evento', invitados = '$invitado', entrada = '$entrada', plato_fuerte = '$plato_fuerte', mezcladores = '$mezcladores', menaje = '$menaje', personal = '$personal', direccionamiento = '$direccionamiento', licor = '$licor', observaciones = '$observaciones', pedido_id = '$pedido_id', valor = '$valor', abono = '$abono', cuotas = '$cuotas' WHERE cotizacion_id = '$cotizacion_id'");
	

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