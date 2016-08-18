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
		<p><h2>Agregar Valor</h2></p>
		<form method="post" action="../php/addcredito.php" id='formadd'>
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