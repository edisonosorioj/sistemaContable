<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from ingresos where idingresos='$id'");

	$html = "<script>
		self.location='ingresos.php';
	</script>";

echo $html;	