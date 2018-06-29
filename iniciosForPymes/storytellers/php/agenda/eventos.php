<?php 
header('Content-Type: application/json');

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


$query = mysqli_query($result, "select * from pedidos p inner join clientes c on p.cliente_id = c.id");

$row = mysqli_fetch_all($query,MYSQLI_ASSOC);

echo json_encode($row);


 ?>