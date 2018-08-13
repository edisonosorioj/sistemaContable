<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id				=	$_POST['id'];
	$documento		=	$_POST['documento'];
	$empresa		=	$_POST['empresa'];
	$nombre			=	$_POST['nombre'];
	$telefono		=	$_POST['telefono'];
	$correo			=	$_POST['correo'];
	$direccion		=	$_POST['direccion'];

	$query = mysqli_query($result, "UPDATE proveedores set documento = '$documento', empresa = '$empresa', nombres = '$nombre', telefono = '$telefono', correo = '$correo', direccion = '$direccion' where proveedor_id = '$id';");

if($query > 0){
	$msg = 'El proveedor fue actualizado con exito';
}else{
	$msg = 'Error al actualizar el proveedor. Intente de nuevo!';
}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	