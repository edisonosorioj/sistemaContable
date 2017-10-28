<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) 
				VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha');");
	
?>
<html>
	<head>
		<title>Ingresos</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Ingreso Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar el Ingreso</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="ingresos.php" class="menu">Listo!</a>
		</center>
	</body>
	</html>	