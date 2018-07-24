<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$tipo_evento		=	$_POST['nombre_pedido'];
	$pedido_id			=	$_POST['pedido_id'];
	$cliente_id			=	$_POST['cliente_id'];
	$invitados			=	$_POST['invitados'];
	$instalaciones		=	'Pendiente de llamar';
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

// Agrega nuevos usuarios según el formulario recibido
 
	$query8 = mysqli_query($result,"INSERT INTO cotizacion (tipo_evento, invitados, instalaciones, entrada, plato_fuerte, mezcladores, menaje, personal, direccionamiento, rustico, licor, observaciones, pedido_id, cliente_id, valor) VALUES ('$tipo_evento', '$invitados', '$instalaciones','$desEntrada', '$desPlaFuerte', '$desMezcla', '$desMenaje', '$desPerServicio', '$desDireccion', CONCAT('$canRustico'+'$desRustico'), '$desLicor', '$observaciones', '$pedido_id', '$cliente_id', '$valorCotiza');");

// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query8 > 0){
		$msg = "La cotización fue agregada correctamente";
	}else{
		$msg = 'Error al agregar la cotización. Contacte al Administrador';
	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='Cotizacion.php';
		opener.location.reload();
	</script>";
	
echo $html;