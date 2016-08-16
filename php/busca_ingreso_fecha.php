<?php
if( !session_id() )
{
    session_start();
}
require_once 'conexion.php';

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

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($result,"SELECT * FROM ingresos WHERE fecha BETWEEN '$desde' AND '$hasta' ORDER BY id_prod ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo "<table class='table table-striped table-condensed table-hover'>
		<tr class='name_list'>
			<td width='10%'>Fecha</td>
			<td width='10%'>Cantidad</td>
			<td width='15%'>Producto</td>
			<td width='25%'>Detalles</td>
			<td width='10%'>Valor</td>
			<td width='10%'>Acciones</td>
		</tr>";
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo "<tr>
				<td>'.fechaNormal($registro2['fecha']).'</td>
				<td>'.$registro2['cantidad'].'</td>
				<td>S/. '.$registro2['producto'].'</td>
				<td>S/. '.$registro2['detalles'].'</td>
				<td>'.$registro2['valor'].'</td>
				<td><a href='editarIngreso.php?id=" . $row['idingresos'] . "' class='botonTab'><img src='../img/editar.png' alt='editar'></a>
				<a href='eliminarIngreso.php?id=" . $row['idingresos'] . "' class='botonTab' class='botonTab'><img src='../img/eliminar.png' alt='eliminar'></a></td>
			</tr>";
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>