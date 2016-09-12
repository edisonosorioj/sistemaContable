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

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}
// DATE(NOW()) - Hoy en base de datos.
//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($result,"SELECT * FROM ingresos WHERE fecha BETWEEN '$desde' AND '$hasta' ORDER BY fecha DESC");

$query2 = mysqli_query($result,"SELECT SUM(valor) AS total FROM ingresos WHERE fecha BETWEEN '$desde' AND '$hasta'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo "<table class='table_result'>
		<tr class='name_list'>
			<td width='10%'>Fecha</td>
			<td width='10%'>Cantidad</td>
			<td width='15%'>Producto</td>
			<td width='25%'>Detalles</td>
			<td width='10%'>Valor</td>
			<td width='10%'>Acciones</td>
		</tr>";

$can = mysqli_num_rows($registro);
if($can > 0){
	while($registro2 = $registro->fetch_array(MYSQLI_BOTH)){
		echo "<tr>
				<td>".fechaNormal($registro2['fecha'])."</td>
				<td>".$registro2['cantidad']."</td>
				<td>".$registro2['producto']."</td>
				<td align='left'>".$registro2['detalles']."</td>
				<td align='right'>".$registro2['valor']."</td>
				<td><a href='editarIngreso.php?id=" . $registro2['idingresos'] . "' class='botonTab'><img src='../../img/editar.png' alt='editar'></a>
				<a href='eliminarIngreso.php?id=" . $registro2['idingresos'] . "' class='botonTab' class='botonTab'><img src='../../img/eliminar.png' alt='eliminar'></a></td>
			</tr>";
	}
}else{
	echo '<tr>
			<td colspan="6">No se encontraron resultados</td>
		</tr>';
}
echo "</table>";

echo "<div id='espacio'></div>
		<table class='table_result' width='65%'>";

if($can > 0){
	 $row2 = $query2->fetch_assoc();{
		echo "<tr>
				<td width='30%'></td>
				<td width='20%' align='right'><b>TOTAL</b></td>
				<td width='10%'>".$row2['total']."</td>
			</tr>";
	}
}else{
	echo "<tr>
			<td width='30%'></td>
			<td width='20%' align='right'><b>TOTAL</b></td>
			<td width='10%'>0</td>
		</tr>";
}
echo '</table>';


?>