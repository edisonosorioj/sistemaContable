<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$start		=	$_POST['start'];
	$time1		=	$_POST['hora_i'];
	$end		=	$_POST['end'];
	$time2		=	$_POST['hora_f'];
	$cliente 	=	$_POST['cliente'];
	$empresa 	=	$_POST['empresa'];
	$documento 	=	$_POST['documento'];
	$telefono 	=	$_POST['telefono'];
	$direccion 	=	$_POST['direccion'];
	$ciudad 	=	$_POST['ciudad'];
	$correo 	=	$_POST['correo'];
	$sede		=	$_POST['sede'];
	$evento		=	$_POST['evento'];
	$invitado	=	$_POST['invitados'];

// Realiza una primera consulta para sacar el color de la sede
 $query2 = mysqli_query($result,"SELECT * FROM sede WHERE sede_id = '$sede';");

 $row = $query2->fetch_array(MYSQLI_BOTH);
 $color = $row['color'];


$fecha_i = $start . " " . $time1;
$fecha_f = $end . " " . $time2;

// Agrega nuevos usuarios según el formulario recibido
	$query4 = mysqli_query($result,"INSERT INTO clientes (documento, nombres, telefono, correo, empresa, direccion, ciudad) VALUES ('$documento', '$cliente', '$telefono', '$correo', '$empresa', '$direccion', '$ciudad');");

// COnsulta el ultipo ID ingresado a la tabla
	$cliente = mysqli_insert_id($result);

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO pedidos (cliente_id, nombre_pedido, start, end, color, estado, sede_id, invitados) VALUES ('$cliente', '$evento', '$fecha_i', '$fecha_f', '$color', '0', '$sede', '$invitado');");

	
// COnsulta el ultipo ID ingresado a la tabla
	$consecutivo = mysqli_insert_id($result);
	
// Toma el ID y lo actualiza en la tabla de configuración para conocer el concecutivo.
	$query3 = mysqli_query($result,"UPDATE variables SET detalle = '$consecutivo' WHERE variable_id = 8;");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if(($query > 0)){
		$msg = "El pedido " . $evento . " fue agregado";
	}else{
		$msg = 'Error al agregar el cliente. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	