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
	<link rel='stylesheet' href='../css/estilos.css' />
</head>
<body>
	<header>
		<h1>Acciones</h1>
	</header>
	<section>
		<div><a href="compras.php">Egresos</a></div>
		<div><a href="ingresos.php">Ingresos</a></div>
		<div><a href="clientes.php">Clientes</a></div>
	</section>
	<footer>
		<p>Registros // Designed by <a href="http://edisonosorioj.com/" target="_blank" rel="nofollow">Edison Osorio</a></p>
		<a href='logout.php' class='close_session'>Salir</a>
	</footer>
</body>
</html>