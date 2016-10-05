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

$registro = mysqli_query($result,"SELECT * FROM productos WHERE fecha BETWEEN '$desde' AND '$hasta' 
								AND idproductos != '1' ORDER BY fecha DESC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo "<table class='table_result'>
		<tr class='name_list'>
			<td width='5%'>ID</td>
			<td width='15%'>Fecha</td>
			<td width='25%'>Nombre</td>
			<td width='10%'>Disponible</td>
			<td width='8%'></td>
		</tr>";

$can = mysqli_num_rows($registro);
if($can > 0){
	while($registro2 = $registro->fetch_array(MYSQLI_BOTH)){
		echo "<tr class='rows' id='rows'>
				<td>".$registro2['idproductos']."</td>
				<td>".fechaNormal($registro2['fecha'])."</td>
				<td>".$registro2['nombre']."</td>
				<td>".$registro2['disponible']."</td>
				<td><a href='editarProductos.php?id=" . $registro2['idproductos'] . "' class='botonTab'><img src='../../img/editar.png' alt='editar'></a>
				<a href='eliminarProductos.php?id=" . $registro2['idproductos'] . "' class='botonTab' class='botonTab'><img src='../../img/eliminar.png' alt='eliminar'></a></td>
			</tr>";
	}
}else{
	echo '<tr>
			<td colspan="6">No se encontraron resultados</td>
		</tr>';
}
echo "</table>";


?>