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
$tr 	= '';
$varIva = '';

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
$query3 = mysqli_query($result,"select SUM(valort) as valor, c.t_cobrado as cobrado from pedidos c inner join pedidoProductos cr on c.pedido_id = cr.pedido_id where c.pedido_id = '$id'");

$row3 = $query3->fetch_assoc();

$subTotal 		= $row3['valor'];
$valorIva 		= $row3['valor'] * 0.19;
$valorPedido 	= $subTotal + $valorIva;
// $cobraPedido 	= "$ " . number_format($row3['cobrado'], 0, ",", ".") . "";

// Obtenemos la fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query2 = mysqli_query($result, "select nombre_pedido, nombres, empresa, documento, pedido_id, id, estado, fecha, direccion, correo, telefono from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row2=$query2->fetch_assoc();

$nombre_cliente 	= $row2['nombres'];
$cliente_empresa 	= $row2['empresa'];
$documento_cliente 	= $row2['documento'];
$fecha_pedido 		= $row2['fecha'];
$direccion 			= $row2['direccion'];
$correo 			= $row2['correo'];
$telefono 			= $row2['telefono'];

$fecha_pedido = explode('-', $fecha_pedido);

$mes = $meses[$fecha_pedido[1]-1];

$fecha_pedido = $fecha_pedido[2] . " de " . $mes . " del " . $fecha_pedido[0];

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
$varIva				= $datos['iva'];

if ($varIva == 1) {
	$iva = "<tr>
				<td colspan='2'></td>
				<th>SubTotal</th>
				<td>$ " . number_format($subTotal, 0, ",", ".") . "</td>
			</tr>
			<tr>
				<td colspan='2'></td>
				<th>Iva 19%</th>
				<td>$ " . number_format($valorIva, 0, ",", ".") . "</td>
			</tr>";
}


$html="<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>Cuenta de Cobro</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen, print' />
	<link rel='stylesheet' type='text/css' href='../../css/bootstrap.css' media='screen, print' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
</head>
<body>
	<div class='container'>
		<div class='col-sm-12 text-right space'><a href=javascript:window.print(); class='imprimir'>Imprimir</a></div>
	</div>
	<div class='container'>
		<div class='col-xs-3'><img src='../../images/logoInformes.png'></div>
		<div class='col-xs-6 text-center'>
			<h3>" . strtoupper($nombre_empresa) . "</h3>
			<h4>NIT $identificacion</h4>
			<p>Autorizacion Dian N° 18762005044482<br />
			Del 29 septiembre de 2017<br />
			Rango: OPT 0001 - OPT 9999<br />
			REGIMEN COMUN<br />
			Act. Econ. 8110
			</p>
		</div>
		<div class='col-xs-3'>
			<h1>&nbsp</h1>
			<table width='100%'>
				<tr>
					<th text-align='center'>
						FACTURA
					</th>
				</tr>
				<tr>
					<td text-align='center'>
						OPT $id
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class='container'>
		<div class='col-sm-12'>
			<h1>&nbsp</h1>
			<table width='100%'>
				<tr>
					<th>
						NIT
					</th>
					<th>
						CLIENTE
					</th>
					<th>
						CONTACTO
					</th>
					<th>
						FECHA
					</th>
					<th>
						CIUDAD
					</th>
				</tr>

				<tr>
					<td>
						$documento_cliente
					</td>
					<td>
						$cliente_empresa
					</td>
					<td>
						$nombre_cliente
					</td>
					<td>
						$fecha_pedido
					</td>
					<td>
						Ciudad
					</td>
				</tr>
				<tr>
					<td colspan='5'>&nbsp
					</td>
				</tr>
				<tr>
					<th>
						TELEFONO
					</th>
					<th>
						DIRECCION
					</th>
					<th>
						E-MAIL
					</th>
					<th>
						ORDEN DE COMPRA
					</th>
					<th>
						PAGO
					</th>
				</tr>

				<tr>
					<td>
						$telefono
					</td>
					<td>
						$direccion
					</td>
					<td>
						$correo
					</td>
					<td>
						Orden de Compra
					</td>
					<td>
						$ " . number_format($valorPedido, 0, ",", ".") . "
					</td>
				</tr>
				<tr>
					<td colspan='5'>&nbsp
					</td>
				</tr>
			</table>
		</div>
		<div class='table'>
			<div class='col-sm-12'>
				<table class='table-fill'>
					<tr>
						<th width='10'>ITEM</th>
						<th width='60%'>PRODUCTO</th>
						<th width='20'>CANTIDAD</th>
						<th width='30'>VALOR</th>
					</tr>
					" .
					$tr .
					$iva
					. "
					<tr>
						<td colspan='2'></td>
						<th>TOTAL</th>
						<td>$ " . number_format($valorPedido, 0, ",", ".") . "</td>
					</tr>
				</table>
			</div>
		</div>
		<p>&nbsp</p>
		<div class='table'>
			<div class='col-sm-12'>
				<table class='table-fill' border='2'>
					<tr>
						<td>
							<p><b>Observaciones: *</b>$forma_de_pago</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class='text-center'><img src='../../images/firma_optimo.png' width='50%'></img></div>
	</div>
</body>
</html>";

echo $html;