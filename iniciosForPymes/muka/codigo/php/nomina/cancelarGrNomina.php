<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$idnomina	=	$_POST['idnomina'];

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query5 = mysqli_query($result,"SELECT * FROM nomina WHERE idnomina = '$idnomina';");
	$row5 	= $query5->fetch_assoc();

	$estado 		= $row5['estado'];
	$total_nomina 	= $row5['total_nomina'];
	$nombre 		= $row5['nombre'];

if ($estado == 0) {

 	$msg = "La nomina ya fue Cancelada, no es posible hacerlo nuevamente";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

	// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
	$query = mysqli_query($result,"UPDATE nomina set total_nomina = '0', estado = '0' where idnomina = '$idnomina';");

	$query2 = mysqli_query($result,"DELETE FROM compras WHERE valor = '$total_nomina' AND producto = '$nombre';");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La nomina se canceló correctamente";
	}else{

		$msg = 'Error al cancelar la nomina. Intente nuevamente';

	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='nomina.php';
		opener.location.reload();
	</script>";
	
	echo $html;	
}