<?php

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
require_once "../conexion.php";

// Obtiene el ID enviado desde Pedido para visualizar El Minuto a Minuto de un Evento en especial
$id = $_GET['id'];

$conex = new conection();
$result = $conex->conex();

// Agrega nuevos usuarios según el formulario recibido
	$query = mysqli_query($result,"INSERT INTO minuto_a_minuto (hora, actividad, proveedor, pedido_id, descripcion, cantidad, comentarios) VALUES ('00:00', 'Nueva Actividad', '1', '$id', 'Descripción', '', '');");
		
	$html = "<script>
		opener.location.reload();
		window.close();
	</script>";
	
echo $html;	