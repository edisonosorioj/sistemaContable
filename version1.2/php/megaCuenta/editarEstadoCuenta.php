<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	

	$id=$_GET['id'];
	
	$query = mysqli_query($result, "select * from estadoCuentas where idescuentas='$id'");

	$row=$query->fetch_assoc();
	
?>

<html>
	<head>
		<meta charset='UTF-8' />
		<title>Estado Cuentas</title>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	<body>
		<div class='form'>
			<p><h2>Editar Cuenta</h2></p>
			<form name="actualizar_ingreso" method="post" action="actEstadoCuenta.php" autocomplete="on">
				<input type="hidden" name="id" value="<?php echo $row['idescuentas']; ?>">
				Fecha<br /><input type="date" name="fecha" value="<?php echo $row['fecha']; ?>" /><br />
				Producto<br /><input type="text" name="producto" value="<?php echo $row['producto']; ?>" /><br />
				Detalles<br /><input type="text" name="detalles" value="<?php echo $row['detalles']; ?>" /><br />
				Valor<br /><input type="number" name="valor" value="<?php echo $row['valor']; ?>" /><br /><br />	
				 <input type="submit" name="send" value="Listo">
				 <input type="button" onclick="history.back()" name="cancelar" value="Cancelar">
			</form>
		</div>
	</body>
</html>