<?php 
header('Content-Type: application/json');

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


$query = mysqli_query($result, "select pedido_id as id, empresa, nombre_pedido as title, start, end, color, estado from pedidos p inner join clientes c on p.cliente_id = c.id where estado = '1'");

$row = mysqli_fetch_all($query,MYSQLI_ASSOC);

echo json_encode($row);


 ?>