<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$pedido_id			=	$_POST['pedido_id'];
	$cliente_id			=	$_POST['cliente_id'];
	$invitados			=	$_POST['invitados'];
	$entrada			=	$_POST['entrada'];
	$platoFuerte		=	$_POST['platoFuerte'];
	$mezcladores		=	$_POST['mezcladores'];
	$menaje				=	$_POST['menaje'];
	$personalServicio	=	$_POST['personalServicio'];
	$direccionamiento	=	$_POST['direccionamiento'];
	$rustico			=	$_POST['rustico'];
	$licor				=	$_POST['licor'];
	$observaciones		=	$_POST['observaciones'];

// Realiza una primera consulta
 $query2 = mysqli_query($result,"SELECT * FROM lista_precios where id = $entrada");

 $row = $query2->fetch_array(MYSQLI_BOTH);
 $desEntrada 	= $row['descripcion'];
 $preEntrada 	= $row['precio'];


// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO cotizacion (tipo_evento, invitados, instalaciones, entrada, plato_fuerte, mezcladores, menaje, personal, direccionamiento, rustico, licor, observaciones, pedido_id, cliente_id) VALUES ('', '$invitados', '$entrada', '$platoFuerte', '$mezcladores', '$menaje', '$personalServicio', '$direccionamiento', '$rustico', '$licor', '$observaciones', '$pedido_id', '$cliente_id');");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query > 0){
		$msg = "La cotización fue agregada correctamente";
	}else{
		$msg = 'Error al agregar la cotización. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	