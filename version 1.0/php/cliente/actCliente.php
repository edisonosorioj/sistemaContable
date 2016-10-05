<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id			=	$_POST['id'];
	$documento	=	$_POST['documento'];
	$nombres	=	$_POST['nombres'];
	$telefono 	=	$_POST['telefono'];
	$correo 	=	$_POST['correo'];

	$query = mysqli_query($result, "UPDATE clientes set documento = '$documento', nombres = '$nombres', telefono = '$telefono', correo = '$correo' where id ='$id';");
	
?>
<html>
	<head>
		<title>Clientes</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<center>	
			<?php if($query > 0){ ?>
				<h1>Cliente Guardado</h1>
				<?php }else{ ?>
				<h1>Error al Guardar Cliente</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="clientes.php" class="menu">Listo!</a>
		</center>
	</body>
	</html>	