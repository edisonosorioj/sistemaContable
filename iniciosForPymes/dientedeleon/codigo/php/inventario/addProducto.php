<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$nombre		=	$_POST['nombre'];
	$familia	=	$_POST['familia'];
	$descripcion=	$_POST['descripcion'];
	$marca		=	$_POST['marca'];
	$genero		=	$_POST['genero'];


	$query = mysqli_query($result,"INSERT INTO productos (nombres, familia, descripcion, marca, genero) VALUES ('$nombre', '$familia', '$descripcion', '$marca', '$genero');");
	
	if($query > 0){
		$msg = 'El producto fue agregado';
	}else{
		$msg = 'Error al agregar el producto. Intente de nuevo o contacte al Administrador.';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	