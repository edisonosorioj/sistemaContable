<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


	$idnomina 	=	$_POST['idnomina'];
	$idusuario	=	$_POST['usuario'];

$query3 = mysqli_query($result, "select * from nomina where idnomina = '$idnomina'");

$row3 = $query3->fetch_assoc();

$estado = $row3['estado'];

if ($estado == 1) {

 	$msg = "La nomina ya fue realizada, no es posible hacerlo nuevamente. Si desea cambiarlo debe cancelarla primero y despues realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		history.back(1);
	</script>";

	echo $html;	


}else{

// Consulta para que aparezca la información de los productos disponibles
$query2 = mysqli_query($result,"SELECT * FROM usuarios WHERE iduser = '$idusuario';");

$row = $query2->fetch_assoc();

	$valor_nomina 	= $row['valor_nomina'];

	$auxilio 		= 97032;
	$compensacion 	= 0;
	$salud 			= $valor_nomina * 0.04;
	$pension 		= $valor_nomina * 0.04;
	$prestamos 		= 0;
	$devengado		= $valor_nomina + $auxilio + $compensacion;
	$deducciones 	= $salud + $pension + $prestamos;
	$pago_total		= $devengado - $deducciones;
	$dias 			= 30;

// Agrega producto a la tabla GrupoNomina

$query = mysqli_query($result,"INSERT INTO grupoNomina (idnomina, idusuario, auxilio, compensacion, salud, pension, prestamos, pago_total, dias) VALUES ('$idnomina', '$idusuario', '$auxilio', '$compensacion', '$salud', '$pension', '$prestamos', '$pago_total', '$dias');");

$html = "<script>
	javascript:history.back();
</script>";

echo $html;

}
