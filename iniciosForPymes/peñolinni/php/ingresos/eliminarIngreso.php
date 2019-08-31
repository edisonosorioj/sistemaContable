<?php 
require_once "../conexion.php";

session_start();
if (!isset($_SESSION['login'])) {
	header("Location: ../inicio/session.html");
	exit();
}

if (isset($_SESSION['idadmin'])){
	$idadmin = $_SESSION['idadmin'];
}

$conex = new conection();
$result = $conex->conex();
	
$id=$_GET['id'];
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'EGRESOS';
$acc 	=	'ELIMINAR INGRESO CON ID = ' . $id;
	
$query = mysqli_query($result,"delete from ingresos where idingresos='$id'");

if($query > 0){
	$msg = 'El ingreso fue eliminado';
	$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
}else{
	$msg = 'Error al eliminar el ingreso. Intentelo de nuevo!';
}

// Contruye el Alert y regresa a Egresos 
$html = "<script>
	window.alert('$msg');
	self.location='ingresos.php';
</script>";

echo $html;	