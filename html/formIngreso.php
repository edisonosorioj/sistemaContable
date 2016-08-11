<html>
<head>
	<meta charset='UTF-8' />
	<title>Agregar Ingreso</title>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<link rel='stylesheet' href='../css/reset.css' />
	<link rel='stylesheet' href='../css/estilos.css' />
</head>
<body>
<div class='form'>
	<h1>Agrega Ingreso</h1>
	<form method="post" action="../php/addIngreso.php" id='formadd'>
		<input type="date" name="fecha" placeholder="Fecha"><br />
		<input type="text" name="detalles" placeholder="Detalles"><br />
		<input type="number" name="valor" placeholder="Valor"><br />
		<input type="submit" name="agregar" id="enviarform" value="Guardar"><br />
		<input type="reset" name="reset" value="Limpiar"><br />
		<input type="button" onclick="hideForm()" name="cancelar" value="Cancelar">
	</form>
</div>
</body>
<script src='../js/acciones.js'></script>
</html>