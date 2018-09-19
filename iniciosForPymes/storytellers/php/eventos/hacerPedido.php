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

 	$msg = "El evento ya fue realizado, no es posible hacerlo nuevamente. Si desea cambiarlo debe cancelarlo primero y despues realizar de nuevo el procedimiento";

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
	$query3 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('01:00', 'Organizar menaje', '$nombre_sede', '$pedido_id','- 000 Platos Fuerte - 000 Plato Tortero - 000 Vaso Gaseosa - 000 Vaso Roquero - 000 Copa de Agua - 000 Copa Coctel - 000 Copa Champaña - 000 Decanter - 000 Tenedor Fuerte - 000 Tenedor Tortero - 000 Cuchara Fuerte - 000 Cuchillo Fuerte - 000 Bandejas - 000 Jarras Aluminio - 000 Jarras de Vidrio - 000 Hieleras - 000 Pinzas - 000 Charoles - 000 Platos Decorativos - 000 Servilletas Papel - 000 Bolsas de Basura - 000 Bandejas - 000 Cocas Madera - 000 Platos Grandes de Cobre - 000 Platos Pequeños de Cobre - 000 Baldes Metalicos - 000 Salseras Cristal Grandes - 000 Salseras Cristal Pequeñas');");

	$query4 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('02:00', 'Organizar Alimentacion', 'Encargado', '$pedido_id','Detalles de Alimentacion');");

	$query5 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('03:00', 'Organizar Sonido', 'Encargado', '$pedido_id', '');");

	$query6 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('04:00', 'Organizar Decoracion', 'Encargado', '$pedido_id', '');");

	$query7 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('05:00', 'Mezcladores ilimitados, implementos de aseo y ubicacion de la mesas', 'Encargado', '$pedido_id', '');");

	$query8 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('06:00', 'Llegan meseros y organizan mesas - Llega seguridad y aseo', 'Encargado', $pedido_id, '');");

	$query9 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('07:00', 'Coctel de Bienvenida ', 'Encargado', '$pedido_id', '');");

	$query10 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('08:00', 'Plato Fuerte', 'Encargado', '$pedido_id', '');");

	$query11 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('09:00', 'Torta', '$Encargado', '$pedido_id', '');");

	$query12 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('10:00', 'Alimentación personal', 'Encargado', '$pedido_id', '');");

	$query13 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('11:00', 'Inicia Fiesta', 'Encargado', '$pedido_id', '');");

	$query14 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('11:30', 'Hora Loca', 'Encargado', '$pedido_id', '');");

	$query15 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('12:00', 'Se reparten las alimento', 'Encargado', '$pedido_id', '');");

	$query16 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('13:00', 'Fin de la fiesta', 'Encargado', '$pedido_id', '');");

	$query17 = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, comentarios) VALUES ('14:00', 'Organizar Menaje', '$nombre_sede', '$pedido_id', '- 000 Platos Fuerte - 000 Plato Tortero - 000 Vaso Gaseosa - 000 Vaso Roquero - 000 Copa de Agua - 000 Copa Coctel - 000 Copa Champaña - 000 Decanter - 000 Tenedor Fuerte - 000 Tenedor Tortero - 000 Cuchara Fuerte - 000 Cuchillo Fuerte - 000 Bandejas - 000 Jarras Aluminio - 000 Jarras de Vidrio - 000 Hieleras - 000 Pinzas - 000 Charoles - 000 Platos Decorativos - 000 Servilletas Papel - 000 Bolsas de Basura - 000 Bandejas - 000 Cocas Madera - 000 Platos Grandes de Cobre - 000 Platos Pequeños de Cobre - 000 Baldes Metalicos - 000 Salseras Cristal Grandes - 000 Salseras Cristal Pequeñas');");


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