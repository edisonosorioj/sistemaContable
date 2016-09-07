<?php
	
	require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	$option = '';

	$id=$_GET['id'];
	
	$query = mysqli_query($result, "select * from ingresos where idingresos = '$id'");

	$row=$query->fetch_assoc();

	$producto = $row['producto'];

	$query2 = mysqli_query($result,"select * from productos order by idproductos DESC");

	while ($row2 = $query2->fetch_array()){

	 	$option .=	"<option value='" . $row2['nombre'] . "' selected='selected'>" . $row2['nombre'] . "</option>";

 }

$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<title>Ingresos</title>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<div class='form'>
			<p><h2>Editar Ingreso</h2></p>
			<form name='actualizar_ingreso' method='post' action='actIngreso.php' autocomplete='on'>
				<input type='hidden' name='id' value=" . $row['idingresos'] . ">
				Fecha<br /><input type='date' name='fecha' value='" . $row['fecha'] . "' /><br />
				Cantidad<br /><input type='number' name='cantidad' value='" . $row['cantidad'] . "' /><br />
				Producto<br /><input type='text' name='exproducto' value='" . $row['producto'] . "' disabled/><br />
					Cambiar:<select name='producto'>" . $option . "</select><br />
				Detalles<br /><input type='text' name='detalles' value='" . $row['detalles'] . "' /><br />
				Valor<br /><input type='number' name='valor' value='" . $row['valor'] . "' /><br /><br />	
				 <input type='submit' name='send' value='Listo'>
				 <input type='button' onclick='history.back()' name='cancelar' value='Cancelar'>
			</form>
		</div>
	</body>
</html>";

echo $html;

