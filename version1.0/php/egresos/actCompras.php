<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result, "UPDATE compras set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idcompras = '$id';");
	
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
				<h1>Compra Guardada</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Compra</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="compras.php" class="menu">Listo!</a>
		</center>
	</body>
	</html>	