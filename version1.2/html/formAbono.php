<?php

require_once "../php/conexion.php";

$conex = new conection();
$result = $conex->conex();

	$id = $_GET['id'];

	$query = mysqli_query($result, "select id from clientes where id='$id'");

	$row=$query->fetch_assoc();


?>
<html>
<head>
	<meta charset='UTF-8' />
	<title>Agregar Abono</title>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<link rel='stylesheet' href='../css/reset.css' />
	<link rel='stylesheet' href='../css/estilos.css' />
	<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
</head>
<body>
	<div class='form'>
		<form method="post" action="../php/credito/addAbono.php" id='formadd'>
			<h2>Agregar Abono</h2>
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			Fecha:<br /><input type="date" name="fecha" placeholder="Fecha"><br />
			Detalles:<br /><input type="text" name="detalles" placeholder="Detalles"><br />
			Valor:<br /><input type="number" name="valor" placeholder="Valor"><br /><br />
			<input type="submit" name="agregar" id="enviarform" value="Guardar">
			<input type="reset" name="reset" value="Limpiar">
			<input type="button" onclick="history.back()" name="cancelar" value="Cancelar">
		</form>
	</div>
</body>
<script src='../js/acciones.js'></script>
</html>