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
	<title>Agregar Valor</title>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<link rel='stylesheet' href='../css/reset.css' />
	<link rel='stylesheet' href='../css/estilos.css' />
</head>
<body>
<div class='form'>
	<h1 align="center">___Agrega Valor___</h1>
	<form method="post" action="../php/addcredito.php" id='formadd'>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="date" name="fecha" placeholder="Fecha">
		<input type="text" name="detalles" placeholder="Detalles">
		<input type="number" name="valor" placeholder="Valor">
		<input type="submit" name="agregar" id="enviarform" value="Guardar">
		<input type="reset" name="reset" value="Limpiar">
		<input type="button" onclick="hideForm()" name="cancelar" value="Cancelar">
	</form>
</div>
</body>
<script src='../js/acciones.js'></script>
</html>