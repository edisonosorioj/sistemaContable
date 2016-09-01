<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$fecha		=	$_POST['fecha'];
	$nombre		=	$_POST['nombre'];
	$disponible	=	$_POST['disponible'];

	$query = mysqli_query($result, "UPDATE productos set fecha = '$fecha', nombre = '$nombre', disponible = '$disponible' where idproductos ='$id';");
	
?>
<html>
	<head>
		<title>Productos</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Producto Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Producto</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="index.php" class="boton">Listo!</a>
		</center>
	</body>
	</html>	