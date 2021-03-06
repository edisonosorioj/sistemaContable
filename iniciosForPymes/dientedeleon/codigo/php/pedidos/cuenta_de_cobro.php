<?php
// Version 2.0 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id 	=	$_POST['pedido_id'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select pp.peproducto_id as idproducto, pp.producto as producto, pp.valoru as valoru, pp.cantidad as cantidad, pp.valort as valort, p.fecha as pfecha from pedidos p inner join pedidoProductos pp on p.pedido_id = pp.pedido_id where p.pedido_id = '$id' order by pp.peproducto_id ASC");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['idproducto'] 	. "</td>
				<td>" 	. 	$row['producto'] 	. "</td>
				<td>" 	. 	$row['cantidad'] 	. "</td>
				<td align='right'>$ " . number_format($row['valort'], 0, ",", ".") 	. "</td>
			</tr>";

 }

// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query3 = mysqli_query($result,"select SUM(valort) as valor from pedidos c inner join pedidoProductos cr on c.pedido_id = cr.pedido_id where c.pedido_id = '$id'");

$row3 = $query3->fetch_assoc();

$valorPedido = "$ " . number_format($row3['valor'], 0, ",", ".") . "";

// Obtenemos la fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query2 = mysqli_query($result, "select nombre_pedido, nombres, empresa, documento, pedido_id, id, estado from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row2=$query2->fetch_assoc();

$nombre_cliente = $row2['nombres'];
$cliente_empresa = $row2['empresa'];
$documento_cliente = $row2['documento'];

// Utilizamos esta consulta para obtener el datos de las variables de configuracion
$query4 = mysqli_query($result, "select * from variables;");

$rows = mysqli_num_rows ($query4);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row4 = mysqli_fetch_array($query4);  
        $rows4[$i] = $row4["nombre"];  
        $datos[$rows4[$i]] = $row4["detalle"];  
    }  
              
}  

$nombre_empresa 	= $datos['empresa'];
$tipo 				= $datos['tipo_identificacion'];
$identificacion		= $datos['identificacion'];
$lugar_expedicion	= $datos['lugar_expedicion'];
$forma_de_pago		= $datos['forma_de_pago'];
$cel				= $datos['cel'];
$tel				= $datos['tel'];


$html="<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>Cuenta de Cobro</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
</head>
<body>
	<div class='hoja'>
		<div class='logo'><img src='../../images/logoInformes.png'></div>
		<div class='imprimir'><a href=javascript:window.print();>Imprimir</a></div>
		<div class='fecha'>Rionegro, $fecha</div>
		<div class='numero'>Cuenta de Cobro No. $id</div>
		<div class='encabezado'>$cliente_empresa con Identificador $documento_cliente debe a $nombre_empresa con $tipo $identificacion de $lugar_expedicion, el valor contemplado al final de la tabla por concepto de:</div>
		<div class='table'>
			<table class='table-fill'>
				<tr>
					<th></th>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>VALOR</th>
				</tr>
				" 
				. $tr . 
				"
				<tr>
					<td colspan='2'></td>
					<th>TOTAL</th>
					<td>$valorPedido</td>
				</tr>
			</table>
		</div>
		<div class='pago'>$forma_de_pago</div>
		<div class='firma'><p>Atentamente,<br />" . strtoupper($nombre_empresa) . "<br />CEL: $cel <br />Tel: $tel</p></div>
	</div>
</body>
</html>";

echo $html;