<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$cantidad	=	$_POST['cantidad'];
	$producto	=	$_POST['producto'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result, "UPDATE ingresos set fecha = '$fecha', cantidad = '$cantidad', producto = '$producto', detalles = '$detalles', valor = '$valor' where idingresos = '$id';");
	
?>
<html>
	<head>
		<title>Ingresos</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Ingreso Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Ingreso</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="../php/ingresos.php" class="agregar">Listo!</a>
		</center>
	</body>
	</html>	