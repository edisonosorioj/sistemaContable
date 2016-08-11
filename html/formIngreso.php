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
<form method="post" action="../php/addIngreso.php" id='formadd'>
	<input type="date" name="fecha" value="<?php echo date('Y-m-d');?>" disabled="disabled">
	<input type="text" name="cantidad" placeholder="Cantidad">
	<input type="text" name="producto" placeholder="Producto">
	<input type="text" name="detalles" placeholder="Detalles">
	<input type="number" name="valor" placeholder="Valor"><br />
	<input type="submit" name="agregar" id="enviarform" value="Guardar">
	<input type="reset" name="reset" value="Limpiar">
	<input type="button" onclick="hideForm()" name="cancelar" value="Cancelar">
</form>
</body>
<script src='../js/acciones.js'></script>
</html>