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

// Separación de paramentros para utilizarlos en la consulta IF e ingresarlos a Ingresos
	$query1 = mysqli_query($result, "select c.fecha, c.detalles, c.valor, c.idclientes, cl.nombres from creditos c 
								inner join clientes cl on c.idclientes = cl.id where idcreditos = '$id'");
	$row=$query1->fetch_assoc();

	$fecha 		= 	$row['fecha'];
	$detalles 	=	$row['detalles'];
	$valor 		=	$row['valor'];
	$idclientes	=	$row['idclientes'];
	$nombreCliente = $row['nombres'];
	
	
	$query2 = mysqli_query($result, "SELECT * FROM ingresos");
	
	$row2=$query2->fetch_assoc();

	$fechaIng		= 	$row2['fecha'];
	$cantidadIng 	= 	$row2['cantidad'];
	$productoIng 	=	$row2['producto'];
	$detallesIng 	=	$row2['detalles'];
	$valorIng 		=	$row2['valor'];

if ($nombreCliente == $detallesIng){
	
	$query = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) 
				VALUES ('1', CONCAT('$id',' $detalles'), '$nombreCliente', '$valor', '$fecha');");

	$h1 = '<h1>Copia Guardada</h1>';

}else{

	$h1 = '<h1>Ya exite el registro</h1>';
}

$query3 = mysqli_query($result, "SELECT * FROM creditos where idcreditos = '$id' limit 1;");

$row3=$query3->fetch_assoc();

$idcliente = $row3['idclientes'];

	
$html = "<html>
	<head>
		<title>Ingresos</title>
		<meta charset='UTF-8' />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<center>	
		<center>	
			" . $h1 . "
			<a href='creditos.php?id=" . $idcliente . "' class='menu'>Volver a Cliente</a>
			<a href='ingresos.php' class='menu'>Ir a Ingresos</a>
		</center>
	</body>
	</html>";

echo $html;	