<?php
if( !session_id() )
{
    session_start();
}
require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$td='';
$td1='';

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}
// DATE(NOW()) - Hoy en base de datos.
//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$query = mysqli_query($result,"SELECT SUM(valor) AS total FROM compras WHERE fecha BETWEEN '$desde' AND '$hasta'");

$query1 = mysqli_query($result,"SELECT SUM(valor) AS total1 FROM ingresos WHERE fecha BETWEEN '$desde' AND '$hasta'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX


$row = $query->fetch_assoc();
 	$td .= "<td width='10%'>" . $row['total'] . "</td>";

$row1 = $query1->fetch_assoc();
 	$td1 .= "<td width='10%'>" . $row1['total1'] . "</td>";

$html = "<table class='table_result' width='100%'>
			<tr>
				<th colspan='2' height='50px'><h3>REPORTE DIARIO</h3></th>
			</tr>
			<tr>
				<th class='row_result'>EGRESOS</th>
				<th class='row_result'>INGRESOS</th>
			</tr>
			<tr>
				<td>----</td>
				<td>----</td>
			</tr>
			<tr class='row' id='rows'>"
				. $td .
				 $td1 .
			"</tr>
		</table>";

echo $html;


?>