<?php
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id=$_GET['id'];
	$fecha='';
	$detalles='';
	$valor='';
	$idclientes='';
	$nombreCliente='';

	$query = mysqli_query($result, "select c.fecha, c.detalles, c.valor, c.idclientes, cl.nombres from creditos c inner join clientes cl on c.idclientes = cl.id where idcreditos = '$id'");

	$row=$query->fetch_assoc();

	$fecha 		= 	$row['fecha'];
	$detalles 	=	$row['detalles'];
	$valor 		=	$row['valor'];
	$idclientes	=	$row['idclientes'];
	$nombreCliente = $row['nombres'];

	$query = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) VALUES ('1', CONCAT('Abono ','$detalles'), '$nombreCliente', '$valor', '$fecha');");
	
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
				<h1>Error al Guardar el Ingreso</h1>		
			<?php	} ?>		
			
			<p></p>	
			<a href="../php/ingresos.php" class="menu">Listo!</a>
		</center>
	</body>
	</html>	