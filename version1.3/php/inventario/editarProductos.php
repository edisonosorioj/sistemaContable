<?php
if( !session_id() )
{
    session_start();
}
require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();

	$id=$_GET['id'];
	
	$query = mysqli_query($result, "select * from productos where idproductos = '$id'");

	$row=$query->fetch_assoc();


$html = "<html>
	<head>
		<meta charset='UTF-8' />
		<meta name='viewport' content='width=device-width'/>
		<title>Ingresos</title>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<div class='form'>
			<p><h2>Editar Producto</h2></p>
			<form name='actualizar_productos' method='post' action='actProductos.php' autocomplete='on'>
				<input type='hidden' name='id' value=" . $row['idproductos'] . ">
				Fecha<br /><input type='date' name='fecha' value='" . $row['fecha'] . "' /><br />
				Nombre<br /><input type='text' name='nombre' value='" . $row['nombre'] . "' /><br />
				Disponible<br /><input type='number' name='disponible' value='" . $row['disponible'] . "' /><br /><br />	
				 <input type='submit' name='send' value='Listo'>
				 <input type='button' onclick='history.back()' name='cancelar' value='Cancelar'>
			</form>
		</div>
	</body>
</html>";

echo $html;