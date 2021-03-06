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
	<meta name="viewport" content="width=320"/>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<script src='../../js/bootstrap.min.js'></script>
	<script src='../../js/bootstrap.js'></script>
	<link rel='stylesheet' href='../../css/reset.css' />
	<link rel='stylesheet' href='../../css/estilos.css' />
</head>
<body>
	<header>
		<h1>Acciones</h1>
	</header>
	<section>
		<div class='menu'><a href="../megaCuenta/estadoCompras.php">MEGA CUENTAS</a></div>
		<div class='menu'><a href="../inventario/index.php">INVENTARIO</a></div>

		<br />
		<div class='menu'><a href="../egresos/compras.php">EGRESOS</a></div>
		<div class='menu'><a href="../ingresos/ingresos.php">INGRESOS</a></div>
		<div class='menu'><a href="../cliente/clientes.php">CLIENTES</a></div>
	</section>
	<section id='totales'>
		<div>
			<form>
				<label>Desde: </label><input type='date' id='ini-desde' />
				<label>Hasta: </label><input type='date' id='ini-hasta' />
			</form>
		</div>
		<div class="resultado" id='tablaTotal'>
			<table class='table_result' width="100%">
				<tr>
					<th colspan="2" height="50px"><h3>REPORTE DIARIO</h3></th>
				</tr>
				<tr>
					<th class='row_result'>EGRESOS</th>
					<th class='row_result'>INGRESOS</th>
				</tr>
				<tr>
					<td>----</td>
					<td>----</td>
				</tr>				
				<tr>
					<td>$</td>
					<td>$</td>
				</tr>
			</table>
		</div>
	</section>
	<?php include("../footer.php"); ?>
</body>
<script src='../../js/acciones.js'></script>
</html>