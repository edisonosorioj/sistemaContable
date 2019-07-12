<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$nomina		=	$_POST['nomina'];
$nuevoValor = '';

$query 	= mysqli_query($result, "SELECT * FROM variables WHERE variable_id = 12;");
$row 	= $query->fetch_assoc();

$activo = $row['detalle'];

$query2 = mysqli_query($result, "SELECT * FROM variables WHERE variable_id = 9;");
$row2 	= $query2->fetch_assoc();

$valor 	= $row2['detalle'];

if ($activo == $nomina) {
	$msg = "Configuración realizada.";
} else {
	if ($nomina == 1) {
		$nuevoValor = $valor + 10000;
	} else {
		if ($valor <= 30000) {
			$nuevoValor = $valor;
		} else {
			$nuevoValor = $valor - 10000;
		}
		
	}

	echo $nuevoValor; die();
	
	$query3 = mysqli_query($result, "UPDATE variables set detalle = '$nuevoValor' WHERE variable_id = 9;");
	$query1 = mysqli_query($result, "UPDATE variables set detalle = '$nomina' WHERE variable_id = 12;");
	// Según la respuesta de la consulta se da una respuesta en una Alert
	if($query1 > 0){
		$msg = "Configuración realizada.";
	}else{
		$msg = 'Error al actualizar la información. Contacte al Administrador';
	}
}


// Se almacena un script en una variable HTML para despues imprimirla con php. 
$html = "<script>
	window.alert('$msg');
	opener.location.reload();
	window.close();
</script>";	
	
echo $html;