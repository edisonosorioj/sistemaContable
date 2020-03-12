<?php

// session_start();

// if (!isset($_SESSION['login'])) {

// 	header("Location: ../inicio/session.php");
// 	exit();
	
// }

require_once "../../php/conexion.php";

$conex = new conection();
$result = $conex->conex();


	$nombre_propiedad	=	isset($_POST['nombre_propiedad'])?$_POST['nombre_propiedad']:'';
	$tipo_propiedad		=	isset($_POST['tipo'])?$_POST['tipo']:'';
	$zona_propiedad		=	isset($_POST['zona'])?$_POST['zona']:'';
	$estado_propiedad 	=	isset($_POST['estado'])?$_POST['estado']:'';
	$can_habitaciones 	=	isset($_POST['habitaciones'])?$_POST['habitaciones']:'';
	$can_banos 			=	isset($_POST['banos'])?$_POST['banos']:'';
	$tamano_propiedad 	=	isset($_POST['tamano'])?$_POST['tamano']:'';
	$costo_propiedad	=	isset($_POST['costo'])?$_POST['costo']:'';
	$descripcion 		=	isset($_POST['descripcion'])?$_POST['descripcion']:'';

	$adicional_1 		=	isset($_POST['adicional_1'])?$_POST['adicional_1']:'';
	$adicional_2 		=	isset($_POST['adicional_2'])?$_POST['adicional_2']:'';
	$adicional_3 		=	isset($_POST['adicional_3'])?$_POST['adicional_3']:'';
	$adicional_4 		=	isset($_POST['adicional_4'])?$_POST['adicional_4']:'';
	$adicional_5 		=	isset($_POST['adicional_5'])?$_POST['adicional_5']:'';
	$adicional_6 		=	isset($_POST['adicional_6'])?$_POST['adicional_6']:'';
	$adicional_7 		=	isset($_POST['adicional_7'])?$_POST['adicional_7']:'';
	$adicional_8 		=	isset($_POST['adicional_8'])?$_POST['adicional_8']:'';
	$adicional_9 		=	isset($_POST['adicional_9'])?$_POST['adicional_9']:'';
	$adicional_10 		=	isset($_POST['adicional_10'])?$_POST['adicional_10']:'';
	$adicional_11 		=	isset($_POST['adicional_11'])?$_POST['adicional_11']:'';
	$adicional_12 		=	isset($_POST['adicional_12'])?$_POST['adicional_12']:'';
	$adicional_13 		=	isset($_POST['adicional_13'])?$_POST['adicional_13']:'';
	$adicional_14 		=	isset($_POST['adicional_14'])?$_POST['adicional_14']:'';
	$adicional_15 		=	isset($_POST['adicional_15'])?$_POST['adicional_15']:'';
	$adicional_16 		=	isset($_POST['adicional_16'])?$_POST['adicional_16']:'';
	$adicional_17 		=	isset($_POST['adicional_17'])?$_POST['adicional_17']:'';
	$adicional_18 		=	isset($_POST['adicional_18'])?$_POST['adicional_18']:'';

	$imagen				=	$_FILES['imagen']['name'];
	$imagen				=	str_replace(' ', '_', $imagen);
	$directorio			= 	$_POST['nombre_propiedad'];
	$directorio			=	str_replace(' ', '_', $directorio);

	mkdir("../" . $directorio . "", 0777);

	opendir("../" . $directorio);
	$destino = "../" . $directorio.'/'.$imagen;
	copy($_FILES['imagen']['tmp_name'], $destino);

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"UPDATE propiedad SET nombre = '$nombre_propiedad', tipo = '$tipo_propiedad', zona = '$zona_propiedad', estado = '$estado_propiedad', img = '$imagen', dato1 = '$can_habitaciones', dato2 = '$can_banos', dato3 = '$tamano_propiedad', costo = '$costo_propiedad', directorio = '$directorio', descripcion = '$descripcion');");

	$id = mysqli_insert_id($result);

// Agrega nuevos usuarios según el formulario recibido
	$query2 = mysqli_query($result,"UPDATE especificaciones_propiedad SET id_propiedad = '$id', dato1 = '$adicional_1', dato2 = '$adicional_2', dato3 = '$adicional_3', dato4 = '$adicional_4', dato5 = '$adicional_5', dato6 = '$adicional_6', dato7 = '$adicional_7', dato8 = '$adicional_8', dato9 = '$adicional_9', dato10 = '$adicional_10', dato11 = '$adicional_11', dato12 = '$adicional_12', dato13 = '$adicional_13', dato14 = '$adicional_14', dato15 = '$adicional_15', dato16 = '$adicional_16', dato17 = '$adicional_17', dato18 = '$adicional_18');");


//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0 && $query2 > 0){
		$msg = "La propiedad " . $nombre_propiedad . " fue actualizada.";
	}else{
		$msg = 'Error al actualizar la propiedad. Intente nuevamente.';
	}
		
	$html = "<script>
		window.alert('$msg');
		window.opener.document.location.href='mis-propiedades.php';
	</script>";
	
echo $html;	