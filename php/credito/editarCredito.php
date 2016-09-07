<?php
	
	require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	

	$id=$_GET['id'];
	
	$query = mysqli_query($result, "select * from creditos where idcreditos='$id'");

	$row=$query->fetch_assoc();
	
?>

<html>
	<head>
		<meta charset='UTF-8' />
		<title>Creditos</title>
		<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
		<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
		<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	<body>
		<div class='form'>
			<p><h2>Editar Credito</h2></p>
			<form name="actualizar_ingreso" method="post" action="actCredito.php" autocomplete="on">
				<input type="hidden" name="id" value="<?php echo $row['idcreditos']; ?>">
				Fecha<br /><input type="date" name="fecha" value="<?php echo $row['fecha']; ?>" /><br />
				Detalles<br /><input type="text" name="detalles" value="<?php echo $row['detalles']; ?>" /><br />
				Valor<br /><input type="number" name="valor" value="<?php echo $row['valor']; ?>" /><br /><br />	
				 <input type="submit" name="send" class='menu' value="Listo">
				 <input type="button" onclick="history.back()" class='menu' name="cancelar" value="Cancelar">
			</form>
		</div>
	</body>
</html>