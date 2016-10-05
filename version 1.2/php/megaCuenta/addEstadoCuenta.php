<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$fecha		=	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO estadoCompras (fecha, cantidad, producto, detalles, valor) VALUES ('$fecha', '$cantidad', '$producto', '$detalles', '$valor');");
	
?>
<html>
	<head>
		<title>Mega Compras</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Información Guardada</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Información</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="estadoCompras.php" class="menu">Listo!</a>
		</center>
	</body>
	</html>	