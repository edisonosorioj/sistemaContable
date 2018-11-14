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
	$sede_id		=	$_POST['sede'];

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

 	$msg = "El evento ya fue realizado, no es posible hacerlo nuevamente. Si desea cambiarlo debe cancelarlo primero y despues realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

 $fecha 		= date('y-m-d');
 $detalles 		= "Evento No. " . $pedido_id . " - " . $nombre_pedido;

 $valorcredito 	= $valor;

// Se agrega el saldo al cliente
 $query6 = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor, idclientes) VALUES ('$fecha', '$detalles', CONCAT('-','$valorcredito'), '$cliente_id');");



// Inserción Datos Minuto a Minuto

 $query3 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, descripcion, cantidad, comentarios) VALUES 
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Platos Fuerte', '000', ''), 
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Plato Tortero', '000', ''), 
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Vaso Gaseosa', '000', ''), 
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Vaso Roquero', '000', ''), 
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Copa de Agua', '000', ''),  
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Copa Coctel', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Copa Champaña', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Decanter', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Tenedor Fuerte', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Tenedor Tortero', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Cuchara Fuerte', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Cuchillo Fuerte', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Bandejas', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Jarras Aluminio', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Jarras de Vidrio', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Hieleras', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Pinzas', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Charoles', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Platos Decorativos', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Servilletas Papel', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Bolsas de Basura', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Servilletas Papel', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Cocas Madera', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Platos Grandes de Cobre', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Platos Pequeños de Cobre', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Baldes Metalicos', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Salseras Cristal Grandes', '000', ''),
 		('01:00', 'Organizar menaje', '1', '$pedido_id', 'Salseras Cristal Pequeñas', '000', ''),
 		('02:00', 'Organizar Alimentacion', '1', '$pedido_id', '', '', ''),
 		('03:00', 'Organizar Sonido', '1', '$pedido_id', '', '', ''),
 		('04:00', 'Organizar Decoración', '1', '$pedido_id', '', '', ''),
 		('05:00', 'Mezcladores ilimitados, implementos de aseo y ubicación de las mesas', '1', '$pedido_id', '', '', ''),
 		('06:00', 'Llegan meseros y organizan mesas - Llega seguridad y aseo', '1', '$pedido_id', '', '', ''),
 		('07:00', 'Coctel Bienvenida', '1', '$pedido_id', '', '', ''),
 		('08:00', 'Plato Fuerte', '1', '$pedido_id', '', '', ''),
 		('09:00', 'Torta', '1', '$pedido_id', '', '', ''),
 		('10:00', 'Alimentación Personal', '1', '$pedido_id', '', '', ''),
 		('11:00', 'Inicia Fiesta', '1', '$pedido_id', '', '', ''),
 		('12:00', 'Hora Loca', '1', '$pedido_id', '', '', ''),
 		('13:00', 'Se reparte Alimentación', '1', '$pedido_id', '', '', ''),
 		('14:00', 'Fin de la Fiesta', '1', '$pedido_id', '', '', '');
 		");


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