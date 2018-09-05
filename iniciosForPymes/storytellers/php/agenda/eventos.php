<?php 

header('Content-Type: application/json');

require_once('../conexion.php');

$conex = new conection();
$result = $conex->conex();


// $query = mysqli_query($result, "select pedido_id as id, empresa, nombre_pedido as title, start, end, color, estado from pedidos p inner join clientes c on p.cliente_id = c.id");

$query = mysqli_query($result, 'select tipo_evento as descripcion, start, end, color, cl.empresa as title from pedidos p 
								inner join cotizacion c 
								inner join clientes cl 
								on p.pedido_id = c.pedido_id 
								and p.cliente_id = cl.id');


$row = mysqli_fetch_array($query,MYSQLI_ASSOC);

echo "[".json_encode($row)."]";


 ?>