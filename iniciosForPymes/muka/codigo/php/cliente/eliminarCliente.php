<?php 
require_once "../conexion.php";

session_start();
if (!isset($_SESSION['login'])) {
	header("Location: ../inicio/session.html");
	exit();
}

if (isset($_SESSION['idadmin'])){
	$idadmin = $_SESSION['idadmin'];
}else{
	$idadmin = 'Usuario sin registro';
}

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

$id 	=	$_GET['id'];
$fecha 	=	date('Y-m-d H:i:s');
$u_id 	=	$idadmin;
$mod 	=	'MESAS';
$acc 	=	'ELIMINO MESA CON ID ' . $id;

// Realiza un conteo de la cantidad de creditos por clientes antes de realizar cualquier acción
$query2 = mysqli_query($result,"SELECT count(detalles) AS registros FROM creditos WHERE idclientes = '$id'");

$totalregistros = $query2->fetch_array(MYSQLI_BOTH);

// Si el cliente no tiene registros realiza la eliminación y su tiene registros no permite eliminarlos.
if ($totalregistros['registros'] == 0) {
	
	$query = mysqli_query($result,"DELETE FROM clientes WHERE id = '$id'");

	if($query > 0){
		$msg = 'El cliente fue eliminado';
		$query2 = mysqli_query($result,"INSERT INTO acciones_ejecutadas (fecha, usuario_id, modulo, accion) VALUES ('$fecha', '$u_id', '$mod', '$acc');");
	}else{
		$msg = 'Error al eliminar el Cliente. Intentelo de nuevo';
	}

}else{

	$msg = 'No es posible Eliminar el Cliente. Debe eliminar primero su historial de credito';
	
}
// Este alert se muestra con el mensaje correspondiente a la acción realizada en el IF
	
$html = "<script>
	window.alert('$msg');
	self.location='cliente.php';
	opener.location.reload();
</script>";
	
echo $html;	