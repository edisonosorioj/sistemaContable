<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();

	$idcreditos =	
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result,"INSERT INTO creditos (fecha, detalles, valor) VALUES ('$fecha', '$detalles', '$valor');");
	$query2 = mysqli_query($result,"INSERT INTO clientesxcreditos (idclientes, idcreditos) VALUES ('$idclientes', '$idcreditos');");
	
?>
<html>
	<head>
		<title>Creditos</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Valor Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar el Valor</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="../php/compras.php" class="boton">Listo!</a>
		</center>
	</body>
	</html>	