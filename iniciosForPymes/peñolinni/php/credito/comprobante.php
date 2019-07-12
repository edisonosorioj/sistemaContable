<?php
// Version 2.0 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}

require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select * from creditos c inner join clientes cl on c.idclientes = cl.id where idcreditos = '$id'");

$row = $query->fetch_assoc();

$nombre_cliente = $row['empresa'];
$documento_cliente = $row['documento'];
$detalles = $row['detalles'];
$valor = "$ " . number_format($row['valor'], 0, ",", ".") . "";


// Obtenemos la fecha
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$fecha = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;


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
		<div class='numero'>Comprobante de pago No. $id</div>
		<div class='encabezado'>$nombre_cliente con Identificador $documento_cliente abono o pago a $nombre_empresa con $tipo $identificacion de $lugar_expedicion, el valor de $valor por concepto de $detalles:</div>
		<div class='firma'><p>Atentamente,<br />" . strtoupper($nombre_empresa) . "<br />CEL: $cel <br />Tel: $tel</p></div>
	</div>
</body>
</html>";

echo $html;