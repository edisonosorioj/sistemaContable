<?php 

session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

$id = $_GET['id'];

$query = mysqli_query($result, "select * from contrato where pedido_id = '$id'");
$row = $query->fetch_assoc();
$contenido = urldecode($row['contenido']);

echo $contenido;



 ?>