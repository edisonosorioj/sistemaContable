<?php


session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";


$conex = new conection();
$result = $conex->conex();


	$start			=	$_POST['start'];
	$time1			=	$_POST['hora_i'];
	$end			=	$_POST['end'];
	$time2			=	$_POST['hora_f'];
	$cliente 		=	$_POST['cliente'];
	$sede			=	$_POST['sede'];
	$evento			=	$_POST['evento'];
	$invitado		=	$_POST['invitados'];
	$instalaciones	=	$_POST['instalaciones'];

// Realiza una primera consulta que suma el total que deben todos los clientes
 $query2 = mysqli_query($result,"SELECT * FROM sede WHERE sede_id = '$sede';");

 $row = $query2->fetch_array(MYSQLI_BOTH);
 $color = $row['color'];
 $nombre_sede = $row['nombre'];


$fecha_i = $start . " " . $time1;
$fecha_f = $end . " " . $time2;


// Agrega pedido según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO pedidos (cliente_id, nombre_pedido, start, end, color, estado, sede_id, invitados, instalacion_id) VALUES ('$cliente', '$evento', '$fecha_i', '$fecha_f', '$color', '0', '$sede', '$invitado', '$instalaciones');");

// COnsulta el ultipo ID ingresado a la tabla
	$consecutivo = mysqli_insert_id($result);

// Agrega Parametros Basicos de la cotización
	$query2 = mysqli_query($result,"INSERT INTO cotizacion (tipo_evento, invitados, entrada, plato_fuerte, mezcladores, menaje, personal, direccionamiento, licor, observaciones, pedido_id, valor) VALUES ('$evento', '$invitado', '4', '15', '19', '22', '23', '28', '25', '', '$consecutivo', '0');");


// Agrega el registro para utilizar el minuto a minuto
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Dia antes', 'Organizar menaje', '$nombre_sede', '200 vasos de gaseosa<br/>160 Platos blancos de plato fuerte<br/>160 platos de torta 160 tenedores', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Dia antes', 'Organizar Alimentacion', 'Encargado', 'Detalles de Alimentacion', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Organizar Sonido', 'Encargado', '', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Organizar Decoracion', 'Encargado', '', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Mezcladores ilimitados, implementos de aseo y ubicacion de la mesas', 'Encargado', '', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Hora', 'Llegan meseros y organizan mesas - Llega seguridad y aseo', '', '200 vasos de gaseosa<br/>160 Platos blancos de plato fuerte<br/>160 platos de torta 160 tenedores', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Hora', 'Organizar menaje', '$nombre_sede', '200 vasos de gaseosa<br/>160 Platos blancos de plato fuerte<br/>160 platos de torta 160 tenedores', '');");
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor_id, pedido_id, comentarios, orden) VALUES ('Hora', 'Organizar menaje', '$nombre_sede', '200 vasos de gaseosa<br/>160 Platos blancos de plato fuerte<br/>160 platos de torta 160 tenedores', '');");

	
	
// Toma el ID y lo actualiza en la tabla de configuración para conocer el concecutivo.
	$query3 = mysqli_query($result,"UPDATE variables SET detalle = '$consecutivo' WHERE variable_id = 8;");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
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