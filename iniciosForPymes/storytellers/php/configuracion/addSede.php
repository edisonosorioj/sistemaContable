<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$nombre		=	$_POST['nombre'];
	$estado		=	$_POST['estado'];
	$color	 	=	$_POST['color'];

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO sede (nombre, estado, color) VALUES ('$nombre', '$estado', '$color');");

// General el ID del ultimo registro ingresado
	$nueva_sede = mysqli_insert_id($result);

// Inserción de datos basicos de precios de Sede
	$query3 = mysqli_query($result,"INSERT INTO precio_x_dia (dia, precio, impuesto, sede_id, item_id) VALUES 
 		('Lunes', '0', '0', '$nueva_sede', '1'), 
 		('Martes', '0', '0', '$nueva_sede', '1'), 
 		('Miercoles', '0', '0', '$nueva_sede', '1'), 
 		('Jueves', '0', '0', '$nueva_sede', '1'), 
 		('Viernes', '0', '0', '$nueva_sede', '1'),  
 		('Sabado', '0', '0', '$nueva_sede', '1'),
 		('Domingo', '0', '0', '$nueva_sede', '1'),
 		('Domingo con Lunes festivo', '0', '0', '$nueva_sede', '1'),
 		('Lunes', '0', '0', '$nueva_sede', '2'), 
 		('Martes', '0', '0', '$nueva_sede', '2'), 
 		('Miercoles', '0', '0', '$nueva_sede', '2'), 
 		('Jueves', '0', '0', '$nueva_sede', '2'), 
 		('Viernes', '0', '0', '$nueva_sede', '2'),  
 		('Sabado', '0', '0', '$nueva_sede', '2'),
 		('Domingo', '0', '0', '$nueva_sede', '2'),
 		('Domingo con Lunes Festivo', '0', '0', '$nueva_sede', '2');
 		");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La Sede " . $nombre . " fue agregado";
	}else{
		$msg = 'Error al agregar el usuario. Intente nuevamente';
	}
		
	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";
	
echo $html;	