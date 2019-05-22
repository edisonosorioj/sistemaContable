<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$idnomina		=	$_POST['idnomina'];
	$cobrado		=	str_replace(".","",$_POST['cobrado']);
	$fecha 			= 	date('y-m-d');

// Obtiene la información del total del pedido por medio del PEDIDO ID
	$query5 = mysqli_query($result,"SELECT * FROM nomina WHERE idnomina = '$idnomina';");
	$row5 	= $query5->fetch_assoc();

	$estado 		= $row5['estado'];
	$nombre 	 	= $row5['nombre'];

if ($estado == 1) {

 	$msg = "La nomina ya fue realizada, no es posible hacerlo nuevamente. Si desea cambiarla debe cancelarla primero y despues realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{


// Actualiza la tabla de pedidos con los parametros de total de costo, total cobrado que viene por post y cambia el estado para que este como realizado
$query = mysqli_query($result,"UPDATE nomina set total_nomina = '$cobrado', estado = '1' where idnomina = '$idnomina';");

$query6 = mysqli_query($result,"INSERT INTO compras (cantidad, producto, detalles, valor, fecha) VALUES ('1', '$nombre', 'Cargo de Nomina', '$cobrado', '$fecha')");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query > 0){
		$msg = "La nomina se ejecuto correctamente";
	}else{

		$msg = 'Error al ejecutar la nómina. Intente nuevamente o contacte al administrador';

	}
		
	$html = "<script>
		window.alert('$msg');
		self.location='nomina.php';
		opener.location.reload();
	</script>";
	
	echo $html;	
}