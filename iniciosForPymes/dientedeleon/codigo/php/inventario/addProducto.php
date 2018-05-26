<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

	$nombre		=	$_POST['nombre'];
	$tipo		=	$_POST['tipo'];
	$familia	=	$_POST['familia'];
	$descripcion=	$_POST['descripcion'];
	$marca		=	$_POST['marca'];
	$genero		=	$_POST['genero'];


	$query = mysqli_query($result,"INSERT INTO productos (idtipo, nombre, familia, descripcion, marca, genero) VALUES ('$tipo','$nombre', '$familia', '$descripcion', '$marca', '$genero');");
	
	if($query > 0){
		$msg = 'El producto fue agregado';
	}else{
		$msg = 'Error al agregar el producto. Intente de nuevo!';
	}
		
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";

echo $html;	