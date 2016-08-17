<?php

if( !session_id() )
{
    session_start();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Selección de Herramientas</title>
	<meta charset="UTF-8" />
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	<script src='../js/bootstrap.min.js'></script>
	<script src='../js/bootstrap.js'></script>
	<link rel='stylesheet' href='../css/reset.css' />
	<link rel='stylesheet' href='../css/estilos.css' />
</head>
<body>
	<header>
		<h1>Acciones</h1>
	</header>
	<section>
		<div class='menu'><a href="compras.php">EGRESOS</a></div>
		<div class='menu'><a href="ingresos.php">INGRESOS</a></div>
		<div class='menu'><a href="clientes.php">CLIENTES</a></div>
	</section>
	<section>
		<div class="resultados">
			
		</div>
	</section>
	<footer>
		<p>Registros // Designed by Edison Osorio</p>
		<a href='logout.php' class='close_session'>Salir</a>
	</footer>
</body>
<script src='../js/acciones.js'></script>
</html>