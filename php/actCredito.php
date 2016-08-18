<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id			=	$_POST['id'];
	$fecha 		= 	$_POST['fecha'];
	$detalles 	=	$_POST['detalles'];
	$valor 		=	$_POST['valor'];

	$query = mysqli_query($result, "UPDATE creditos set fecha = '$fecha', detalles = '$detalles', valor = '$valor' where idcreditos = '$id';");
	
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
				<h1>Credito Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Credito</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="creditos.php?id="<? $id ?>"" class="menu">Listo!</a>
		</center>
	</body>
	</html>	