<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: session.php");
	exit();
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Selección de Herramientas</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=500"/>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<script src='../../js/bootstrap.min.js'></script>
	<script src='../../js/bootstrap.js'></script>
	<link rel='stylesheet' href='../../css/reset.css' />
	<link rel='stylesheet' href='../../css/estilos.css' />
	<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
</head>
<body>
	<header>
		<?php include("../menu.php"); ?>
		<h1>Bienvenido <?echo $_SESSION['login']; ?></h1>
	</header>
	<section id='totales'>
		<div>
			<form>
				<label>Desde: </label><input type='date' id='ini-desde' />
				<label>Hasta: </label><input type='date' id='ini-hasta' />
			</form>
		</div>
		<div class="resultado" id='tablaTotal'>
			<h3>REPORTE DIARIO</h3>
			<p><b>EGRESOS: $</b></p>
			<p><b>INGRESOS: $</b></p>
		</div>
	</section>
	<?php include("../footer.php"); ?>
</body>
<script src='../../js/acciones.js'></script>
</html>