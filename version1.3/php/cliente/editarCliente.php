<?php
	
	require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	

	$id=$_GET['id'];
	
	$query = mysqli_query($result, "select id,documento,nombres,telefono,correo from clientes where id='$id'");

	$row=$query->fetch_assoc();
	
?>

<html>
	<head>
		<meta charset='UTF-8' />
		<meta name='viewport' content='width=device-width'/>
		<title>Cliente</title>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
		<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
	</head>
	<body>
		<div class='form'>
			<p><h2>Editar Cliente</h2></p>
			<form name="actualizar_cliente" method="post" action="actCliente.php" autocomplete="on">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				Documento<br /><input type="text" name="documento" value="<?php echo $row['documento']; ?>" /><br />
				Nombres<br /><input type="text" name="nombres" value="<?php echo $row['nombres']; ?>" /><br />
				Teléfono<br /><input list="report" name="telefono" value="<?php echo $row['telefono']; ?>" /><br />
				Correo<br /><input type="text" name="correo" value="<?php echo $row['correo']; ?>" /><br /><br />	
				 <input type="submit" name="send" class='menu' value="Listo">
				 <input type="button" onclick="history.back()" class='menu' name="cancelar" value="Cancelar">
			</form>
		</div>
	</body>
</html>