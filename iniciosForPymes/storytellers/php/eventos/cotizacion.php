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
$query = mysqli_query($result,"select pp.peproducto_id as idproducto, pp.producto as producto, pp.valoru as valoru, pp.cantidad as cantidad, pp.valort as valort, p.start as pfecha from pedidos p inner join pedidoProductos pp on p.pedido_id = pp.pedido_id where p.pedido_id = '$id' order by pp.peproducto_id ASC");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['idproducto'] 	. "</td>
				<td>" 	. 	$row['producto'] 	. "</td>
				<td>" 	. 	$row['pfecha']		. "</td>
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
$query2 = mysqli_query($result, "select nombre_pedido, nombres, empresa, documento, correo, pedido_id, id, estado, start from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row2=$query2->fetch_assoc();

$nombre_cliente = $row2['nombres'];
$cliente_empresa = $row2['empresa'];
$documento_cliente = $row2['documento'];
$cliente_correo = $row2['correo'];
$fecha_inicio 	= $row['start'];

 // Consulta para saber el día de la semana
 $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
 $dia = $dias[date("w", strtotime($fecha_inicio))];


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
	<title>Cotización</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
</head>
<body>
	<div class='hoja'>
		<div class='logo'><img src='../../images/logoInformes.png'></div>
		<div class='imprimir'><a href=javascript:window.print();>Imprimir</a></div>
		<div class='encabezado'>Rionegro, $fecha</div>
		<div class='numero'>Cotización No. $id</div>
		<div class='encabezado'>
			<b>Señor(a):</b><br />
			$nombre_cliente<br />
			$cliente_empresa<br />
			$cliente_correo
		</div>
		<div class='encabezado'>$nombre_empresa presenta el siguiente valor para ser evaluado según los productos solicitados expresados en la siguiente tabla:</div>
		<div class='table'>
			<table class='table-fill'>
				<tr>
					<th></th>
					<th>PRODUCTO</th>
					<th>FECHA</th>
					<th>CANTIDAD</th>
					<th>VALOR</th>
				</tr>
				" 
				. $tr . 
				"
				<tr>
					<td colspan='3'></td>
					<th>TOTAL</th>
					<td>$valorPedido</td>
				</tr>
			</table>
		</div>
		<div class='pago'>En caso de ser aprobada favor confirmar enviando esta cotización firmada por correo electrónico o física al remitente. Esta propuesta tiene una validez de 30 días a partir de la fecha en que se genero.</div>
		<div class='firma'><p>Atentamente,<br />" . strtoupper($nombre_empresa) . "<br />CEL: $cel <br />Tel: $tel</p></div>
	</div>
</body>
</html>";

echo $html;