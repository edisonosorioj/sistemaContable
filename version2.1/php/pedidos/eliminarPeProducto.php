<?php 
// Version 1.3 of Edison Osorio
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Trae el ID seleccionado a eliminar
$id = $_GET['id'];

// Realiza la eliminacion del Producto del Pedido. Y genera un mensaje segun las respuesta MySQL
$query = mysqli_query($result, "delete from pedidoProductos where peproducto_id = '$id'");

//Según la respuesta de la inserción se da una respuesta en un alert 
	if($query < 0){
		$html .= "window.alert('Error al ingresar la información')";
	}
		
	$html = "<script>
		javascript:history.back();
	</script>";
	
echo $html;	
