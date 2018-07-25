<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$tipo_evento		=	$_POST['nombre_pedido'];
	$pedido_id			=	$_POST['pedido_id'];
	$cliente_id			=	$_POST['cliente_id'];
	$invitados			=	$_POST['invitados'];
	$instalaciones		=	$_POST['instalacion'];
	$entrada			=	$_POST['entrada'];
	$platoFuerte		=	$_POST['platoFuerte'];
	$mezcladores		=	$_POST['mezcladores'];
	$menaje				=	$_POST['menaje'];
	$personalServicio	=	$_POST['personalServicio'];
	$direccionamiento	=	$_POST['direccionamiento'];
	$rustico			=	$_POST['rustico'];
	$canRustico			=	$_POST['canRustico'];
	$licor				=	$_POST['licor'];
	$observaciones		=	$_POST['observaciones'];

// Realiza una primera consulta
 $query = mysqli_query($result,"SELECT * FROM clientes where id = $cliente_id");

 $row = $query->fetch_array(MYSQLI_BOTH);
 $nombre_cliente	= $row['empresa'];
 $telefono			= $row['telefono'];
 $correo			= $row['correo'];
 $documento			= $row['documento'];
 $direccion			= $row['direccion'];
 $fecha				= date("Y-m-d");


// Realiza una primera consulta
 $query = mysqli_query($result,"SELECT * FROM pedidos where pedido_id = $pedido_id");

 $row9 = $query->fetch_array(MYSQLI_BOTH);
 $fecha_i = $row9['start'];
 $fecha_f = $row9['end'];
 $sede_id = $row9['sede_id'];

 // Consulta para saber el día de la semana
 $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
 $dia = $dias[date("w")];

// Realiza una primera consulta
 $query11 = mysqli_query($result,"SELECT lp.id, lp.descripcion as descripcion, pd.precio as precio, pd.item_id FROM lista_precios lp inner join precio_x_dia pd on lp.id = pd.item_id where id = '$instalaciones' and dia = '$dia' and sede_id = '$sede_id'");

 $row = $query11->fetch_array(MYSQLI_BOTH);
 $desInstala 	= $row['descripcion'];
 $preInstala 	= $row['precio'];

 echo $desInstala;
 echo $preInstala;
 die();

// Realiza una primera consulta
 $query = mysqli_query($result,"SELECT * FROM lista_precios where id = $entrada");

 $row = $query->fetch_array(MYSQLI_BOTH);
 $desEntrada 	= $row['descripcion'];
 $preEntrada 	= $row['precio'];
 
// Realiza una primera consulta
 $query1 = mysqli_query($result,"SELECT * FROM lista_precios where id = $platoFuerte");

 $row1 = $query1->fetch_array(MYSQLI_BOTH);
 $desPlaFuerte 	= $row1['descripcion'];
 $prePlaFuerte 	= $row1['precio'];
 
// Realiza una primera consulta
 $query2 = mysqli_query($result,"SELECT * FROM lista_precios where id = $mezcladores");

 $row2 = $query2->fetch_array(MYSQLI_BOTH);
 $desMezcla 	= $row2['descripcion'];
 $preMezcla 	= $row2['precio'];

// Realiza una primera consulta
 $query3 = mysqli_query($result,"SELECT * FROM lista_precios where id = $menaje");

 $row3 = $query3->fetch_array(MYSQLI_BOTH);
 $desMenaje 	= $row3['descripcion'];
 $preMenaje 	= $row3['precio'];

// Realiza una primera consulta
 $query4 = mysqli_query($result,"SELECT * FROM lista_precios where id = $personalServicio");

 $row4 = $query4->fetch_array(MYSQLI_BOTH);
 $desPerServicio 	= $row4['descripcion'];
 $prePerServicio 	= $row4['precio'];

// Realiza una primera consulta
 $query5 = mysqli_query($result,"SELECT * FROM lista_precios where id = $direccionamiento");

 $row5 = $query5->fetch_array(MYSQLI_BOTH);
 $desDireccion 	= $row5['descripcion'];
 $preDireccion 	= $row5['precio'];

// Realiza una primera consulta
 $query6 = mysqli_query($result,"SELECT * FROM lista_precios where id = $rustico");

 $row6 = $query6->fetch_array(MYSQLI_BOTH);
 $desRustico 	= $row6['descripcion'];
 $preRustico 	= $row6['precio'];

// Realiza una primera consulta
 $query7 = mysqli_query($result,"SELECT * FROM lista_precios where id = $licor");

 $row7 = $query7->fetch_array(MYSQLI_BOTH);
 $desLicor 	= $row7['descripcion'];
 $preLicor 	= $row7['precio'];

// Calculo de precios para Pedido

 $canRustico = ($canRustico > 0) ? $totalRustico = $preRustico * $canRustico : $totalRustico = 0 ;

 $valorCotiza = ($preEntrada + $prePlaFuerte + $preMezcla + $preMenaje + $prePerServicio + $preDireccion + $preLicor + $totalRustico) * $invitados;


$html="<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>Cotización</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
</head>
<body>
	<div class='hoja'>
		<div class='logo'><img src='../../images/logoInformes.png'></div>
		<div class='imprimir'><a href=javascript:window.print();>Imprimir</a></div>
		<div class='table_datos'>
			<table class='table-fill'>
				<tr>
					<th>Cliente</th>
					<td>$nombre_cliente</td>
					<th>Teléfono</th>
					<td>$telefono</td>
				</tr>
				<tr>
					<th>Correo</th>
					<td>$correo</td>
					<th>CC/NIT</th>
					<td>$documento</td>
				</tr>
				<tr>
					<th>Dirección</th>
					<td>$direccion</td>
					<th>Fecha</th>
					<td>$fecha</td>
				</tr>
			</table>
		</div>

		<div class='table'>
			<table class='table-fill'>
				<tr>
					<th rowspan='2'>Información</th>
					<td><b>Tipo de Evento</b></td>
					<td>$tipo_evento</td>
					<td><b>Inicia Evento</b></td>
					<td>$fecha_i</td>
				</tr>
				<tr>
					<td><b>Numero de Invitados</b></td>
					<td>$invitados</td>
					<td><b>Termina Evento</b></td>
					<td>$fecha_f</td>
				</tr>
			</table>
		</div>

		<div class='table'>
			<table class='table-fill'>
				<tr>
					<th class='text-center' colspan='5'>Cotizaci&oacute;n</th>
				</tr>
				<tr>
					<th class='text-center'>Item</th>
					<th class='text-center'>Descripción</th>
					<th class='text-center'>Cantidad</th>
					<th class='text-center'>Precio Und.</th>
					<th class='text-center'>Total</th>
				</tr>
				<tr>
					<td class='text-center'>Instalaciones</td>
					<td class='text-center'>$desInstala</td>
					<td class='text-center'>Cantidad</td>
					<td class='text-center'>Precio Und.</td>
					<td class='text-center'>Total</td>
				</tr>
			</table>
		</div>

	</div>
</body>
</html>";

echo $html;

// Agrega nuevos usuarios según el formulario recibido
 
	// $query8 = mysqli_query($result,"INSERT INTO cotizacion (tipo_evento, invitados, instalaciones, entrada, plato_fuerte, mezcladores, menaje, personal, direccionamiento, rustico, licor, observaciones, pedido_id, cliente_id, valor) VALUES ('$tipo_evento', '$invitados', '$instalaciones','$desEntrada', '$desPlaFuerte', '$desMezcla', '$desMenaje', '$desPerServicio', '$desDireccion', CONCAT('$canRustico',' - ','$desRustico'), '$desLicor', '$observaciones', '$pedido_id', '$cliente_id', '$valorCotiza');");

// Según la respuesta de la consulta se da una respuesta en una Alert
// 	if($query8 > 0){
// 		$msg = "La cotización fue agregada correctamente";
// 	}else{
// 		$msg = 'Error al agregar la cotización. Contacte al Administrador';
// 	}
		
// 	$html = "<script>
// 		window.alert('$msg');
// 		self.location='Cotizacion.php';
// 		opener.location.reload();
// 	</script>";
	
// echo $html;