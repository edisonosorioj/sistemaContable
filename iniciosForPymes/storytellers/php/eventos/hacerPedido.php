<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$pedido_id		=	$_POST['pedido_id'];
	$nombre_sede	=	$_POST['sede'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query5 = mysqli_query($result,"SELECT * FROM pedidos WHERE pedido_id = '$pedido_id';");
	$row5 	= $query5->fetch_assoc();

	$estado 		= $row5['estado'];
	$nombre_pedido 	= $row5['nombre_pedido'];
	$cliente_id		= $row5['cliente_id'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query2 = mysqli_query($result,"SELECT valor FROM cotizacion WHERE pedido_id = '$pedido_id';");

	$row 	= $query2->fetch_assoc();
 	$valor 	= $row['valor'];

if ($estado == 1) {

 	$msg = "El pedido ya fue realizado, no es posible hacerlo nuevamente. Si desea cambiarlo debe cancelarlo primero y despues realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

 $fecha 		= date('y-m-d');
 $detalles 		= "Pedido No. " . $pedido_id . " - " . $nombre_pedido;

 $valorcredito 	= $valor;

// Se agrega el saldo al cliente
 $query6 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', CONCAT('-','$valorcredito'), '$cliente_id');");



// Agrega el registro para utilizar el minuto a minuto
	$query3 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Dia antes', 'Organizar menaje', '$nombre_sede', '$pedido_id','200 vasos de gaseosa<br/>160 Platos blancos de plato fuerte<br/>160 platos de torta 160 tenedores', '1');");

	$query4 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Dia antes', 'Organizar Alimentacion', 'Encargado', '$pedido_id','Detalles de Alimentacion', '2');");

	$query5 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Organizar Sonido', 'Encargado', '$pedido_id', '', '3');");

	$query6 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Organizar Decoracion', 'Encargado', '$pedido_id', '', '4');");

	$query7 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Antes del Evento', 'Mezcladores ilimitados, implementos de aseo y ubicacion de la mesas', 'Encargado', '$pedido_id', '', '5');");

	$query8 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Llegan meseros y organizan mesas - Llega seguridad y aseo', 'Encargado', $pedido_id, '', '6');");

	$query9 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Coctel de Bienvenida ', 'Encargado', '$pedido_id', '', '7');");

	$query10 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Plato Fuerte', 'Encargado', '$pedido_id', '', '8');");

	$query11 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Torta', '$Encargado', '$pedido_id', '', '9');");

	$query12 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Alimentación personal', 'Encargado', '$pedido_id', '', '10');");

	$query13 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Inicia Fiesta', 'Encargado', '$pedido_id', '', '11');");

	$query14 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('11:30', 'Hora Loca', 'Encargado', '$pedido_id', '', '12');");

	$query15 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Se reparten las alimento', 'Encargado', '$pedido_id', '', '13');");

	$query16 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Fin de la fiesta', 'Encargado', '$pedido_id', '', '14');");

	$query17 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios, orden) VALUES ('Hora', 'Organizar Menaje', '$nombre_sede', '$pedido_id', '', '15');");


// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query = mysqli_query($result,"UPDATE pedidos set t_costo = '$valor', estado = '1' where pedido_id = '$pedido_id';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "El pedido se hizo correctamente";
	}else{

		$msg = 'Error al agregar el pedido. Intente nuevamente';

	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='eventos.php';
		opener.location.reload();
	</script>";
	
	echo $html;	
}