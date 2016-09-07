<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha 		= 	date("Y-m-d");
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO compras (cantidad, producto, detalles, valor, fecha) VALUES ('$cantidad', '$producto', '$detalles', '$valor', '$fecha');");
	
?>
<html>
	<head>
		<title>Compras</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Gasto Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Gasto</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="../php/compras.php" class="boton">Listo!</a>
		</center>
	</body>
	</html>	