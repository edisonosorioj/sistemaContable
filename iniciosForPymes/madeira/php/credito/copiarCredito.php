<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id=$_GET['id'];
	$fecha='';
	$detalles='';
	$valor='';
	$idclientes='';
	$nombreCliente='';

// Encuenta el Abono y lo separa para agregarlo al Ingreso
	$query1 = mysqli_query($result, "select c.fecha, c.detalles, c.valor, c.idclientes, cl.nombres from creditos c 
								inner join clientes cl on c.idclientes = cl.id where idcreditos = '$id'");
	$row=$query1->fetch_assoc();

	$fecha 		= 	$row['fecha'];
	$detalles 	=	$row['detalles'];
	$valor 		=	$row['valor'];
	$idclientes	=	$row['idclientes'];
	$nombreCliente = $row['nombres'];

if ($valor > 0) {

// Se hace la insercion del Abono a Ingresos
	$query = mysqli_query($result,"INSERT INTO ingresos (cantidad, producto, detalles, valor, fecha) 
				VALUES ('1', CONCAT('$id',' $detalles'), '$nombreCliente', '$valor', '$fecha');");

	if($query > 0){
		$msg = 'El registro fue agregado a Ingresos';
	}else{
		$msg = 'Error al realizar el registro. Intentalo de nuevo';
	}
}else{
 		$msg = 'Debes seleccionar un Abono y no un Credito';
}

	// Ejecuta la alerta y vuelve a Credito
	$html = "<script>
		window.alert('$msg');
		javascript:history.back();
	</script>";
		
	echo $html;