<?php
require_once "../conexion.php";
require('funcionesEspeciales.php');

$conex = new conection();
$result = $conex->conex();


	$tipo_evento		=	$_POST['nombre_pedido'];
	$cuotas				=	$_POST['cuotas'];
	$abono				=	$_POST['abono'];
	$cotizacion_id		=	$_POST['cotizacion_id'];
	$pedido_id			=	$_POST['pedido_id'];
	$cliente_id			=	$_POST['cliente_id'];
	$invitados			=	$_POST['invitados'];
	$instalaciones		=	$_POST['instalaciones'];
	$entrada			=	$_POST['entrada'];
	$platoFuerte		=	$_POST['platoFuerte'];
	$mezcladores		=	$_POST['mezcladores'];
	$menaje				=	$_POST['menaje'];
	$personalServicio	=	$_POST['personalServicio'];
	$direccionamiento	=	$_POST['direccionamiento'];
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
 $fecha_inicial = $row9['start'];
 $fecha_final = $row9['end'];

 // Consulta para saber el día de la semana
 $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
 $dia = $dias[date("w")];

//Calcular horas del evento

$horas = date("H:i", strtotime("00:00:00") + strtotime($fecha_final) - strtotime($fecha_inicial));


// Realiza una primera consulta
 $query11 = mysqli_query($result,"SELECT lp.id, lp.descripcion as descripcion, pd.precio as precio, pd.item_id, pd.impuesto FROM lista_precios lp inner join precio_x_dia pd on lp.id = pd.item_id WHERE lp.id = '$instalaciones' AND pd.dia = '$dia' AND pd.sede_id = '$sede_id'");

 $row11 = $query11->fetch_array(MYSQLI_BOTH);
 $desInstala 	= $row11['descripcion'];
 $preInstala 	= $row11['precio'];
 $impuesto 		= $row11['impuesto'];

 $preInstala = $preInstala + $impuesto;

// Realiza una primera consulta
 $query = mysqli_query($result,"SELECT * FROM lista_precios where id = $entrada");

 $row = $query->fetch_array(MYSQLI_BOTH);
 $desEntrada 	= $row['descripcion'];
 $preEntrada 	= $row['precio'];

 $totalEntrada = $preEntrada * $invitados;
 
// Realiza una primera consulta
 $query1 = mysqli_query($result,"SELECT * FROM lista_precios where id = $platoFuerte");

 $row1 = $query1->fetch_array(MYSQLI_BOTH);
 $desPlaFuerte 	= $row1['descripcion'];
 $prePlaFuerte 	= $row1['precio'];

 $totalPlaFuerte = $prePlaFuerte * $invitados;
 
// Realiza una primera consulta
 $query2 = mysqli_query($result,"SELECT * FROM lista_precios where id = $mezcladores");

 $row2 = $query2->fetch_array(MYSQLI_BOTH);
 $desMezcla 	= $row2['descripcion'];
 $preMezcla 	= $row2['precio'];

 $totalMezcla = $preMezcla * $invitados;

// Realiza una primera consulta
 $query3 = mysqli_query($result,"SELECT * FROM lista_precios where id = $menaje");

 $row3 = $query3->fetch_array(MYSQLI_BOTH);
 $desMenaje 	= $row3['descripcion'];
 $preMenaje 	= $row3['precio'];

 $totalMenaje = $preMenaje * $invitados;

// Realiza una primera consulta
 $query4 = mysqli_query($result,"SELECT * FROM lista_precios where id = $personalServicio");

 $row4 = $query4->fetch_array(MYSQLI_BOTH);
 $desPerServicio 	= $row4['descripcion'];
 $prePerServicio 	= $row4['precio'];

 $totalPerServicio = $prePerServicio * $invitados;

// Realiza una primera consulta
 $query5 = mysqli_query($result,"SELECT * FROM lista_precios where id = $direccionamiento");

 $row5 = $query5->fetch_array(MYSQLI_BOTH);
 $desDireccion 	= $row5['descripcion'];
 $preDireccion 	= $row5['precio'];

// Realiza una primera consulta
 $query7 = mysqli_query($result,"SELECT * FROM lista_precios where id = $licor");

 $row7 = $query7->fetch_array(MYSQLI_BOTH);
 $desLicor 	= $row7['descripcion'];
 $preLicor 	= $row7['precio'];

 $totalLicor = $preLicor * $invitados;

// Calculo de precios para Pedido

 $valorCotiza = $preEntrada + $prePlaFuerte + $preMezcla + $preMenaje + $prePerServicio + $preDireccion;

 $totalCotiza = $valorCotiza * $invitados;

 $valorFinal = $preInstala + $totalEntrada + $totalPlaFuerte + $totalMezcla + $totalMenaje + $totalPerServicio + $preDireccion + $totalLicor;

$html="<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>Cotización</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
	<!-- bootstrap-css -->
	<link rel='stylesheet' href='../../css/bootstrap.css'>
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
					<th rowspan='3'>Información</th>
					<td><b>Tipo de Evento</b></td>
					<td>$tipo_evento</td>
					<td><b>Numero de Invitados</b></td>
					<td>$invitados</td>
				</tr>
				<tr>
					<td><b>Inicia Evento</b></td>
					<td>$fecha_i</td>
					<td><b>Termina Evento</b></td>
					<td>$fecha_f</td>
				</tr>
				<tr>
					<td><b>Día</b></td>
					<td>$dia</td>
					<td><b>Horas</b></td>
					<td>$horas</td>
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
					<td class='text-center'>$invitados</td>
					<td class='text-center'>" . number_format($preInstala / $invitados, 0, ",", ".") . "</td>
					<td class='text-center'>" . number_format($preInstala, 0, ",", ".") . "</td>
				</tr>
				<tr>
					<td class='text-center'>Entrada</td>
					<td class='text-center'>$desEntrada</td>
					<td class='text-center' rowspan='6'>$invitados</td>
					<td class='text-center' rowspan='6'>" . number_format($valorCotiza, 0, ",", ".") . "</td>
					<td class='text-center' rowspan='6'>" . number_format($totalCotiza, 0, ",", ".") . "</td>
				</tr>
				<tr>
					<td class='text-center'>Plato fuerte</td>
					<td class='text-center'>$desPlaFuerte</td>
				</tr>
				<tr>
					<td class='text-center'>Mezcladores</td>
					<td class='text-center'>$desMezcla</td>
				</tr>
				<tr>
					<td class='text-center'>Menaje</td>
					<td class='text-center'>$desMenaje</td>
				</tr>
				<tr>
					<td class='text-center'>Personal Servicio</td>
					<td class='text-center'>$desPerServicio</td>
				</tr>
				<tr>
					<td class='text-center'>Direccionamiento del evento</td>
					<td class='text-center'>$desDireccion</td>
				</tr>
				<tr>
					<td class='text-center'>Licor</td>
					<td class='text-center'>$desLicor</td>
					<td class='text-center'>$invitados</td>
					<td class='text-center'>" . number_format($preLicor, 0, ",", ".") . "</td>
					<td class='text-center'>" . number_format($totalLicor, 0, ",", ".") . "</td>
				</tr>
				<tr>
					<td colspan='2' rowspan='2'>Observaciones: $observaciones</td>
					<th class='text-center' colspan='2'>Total</th>
					<td class='text-center'>" . number_format($preInstala + $totalEntrada + $totalPlaFuerte + $totalMezcla + $totalMenaje + $totalPerServicio + $preDireccion + $totalLicor, 0, ",", ".") . "</td>
				</tr>
				<tr>
					<td colspan='3'>Precios Válidos por 15 días después de la fecha de elaboración.</td>
				</tr>
			</table>
		</div>
		<div class='firma'>
			<form class='form-horizontal' action='guardarCotizacion.php' method='post'>
				<input type='hidden' name='cotizacion_id' value='$cotizacion_id'>
				<input type='hidden' name='pedido_id' value='$pedido_id'>
				<input type='hidden' name='tipo_evento' value='$tipo_evento'>
				<input type='hidden' name='invitados' value='$invitados'>
				<input type='hidden' name='entrada' value='$entrada'>
				<input type='hidden' name='plato_fuerte' value='$platoFuerte'>
				<input type='hidden' name='mezcladores' value='$mezcladores'>
				<input type='hidden' name='menaje' value='$menaje'>
				<input type='hidden' name='personal' value='$personalServicio'>
				<input type='hidden' name='direccionamiento' value='$direccionamiento'>
				<input type='hidden' name='licor' value='$licor'>
				<input type='hidden' name='observaciones' value='$observaciones'>
				<input type='hidden' name='valor' value='$valorFinal'>
				<input type='hidden' name='cuotas' value='$cuotas'>
				<input type='hidden' name='abono' value='$abono'>
				<div class='imprimir'><button type='submit' class='btn btn-primary btn-block'>Guardar Cotización</button> </div>
			</form>
		</div>
	</div>
</body>
</html>";

echo $html;