<?php 
session_start();
?>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel='stylesheet' href='http://code.jquery.com/ui/1.11.3/themes/start/jquery-ui.css'>
	<link rel='stylesheet' href='../../css/estilos.css'>
	<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
	<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
	
	<title>Inicio</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#FF9966" vlink="#FF9966" alink="#FFCC99">
	<form id='login_form' action='action.php?rand=<?=rand(10000,900000);?>' method='POST'>
		<input type='hidden' name='action' value='do_login'>
		<h1>Inicio</h1>
		<table>
			<tr>
				<td>Login</td>
				<td><input id='login' name='login' type='text'></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input id='password' name='password' type='password'></td>
			</tr>
			<tr>
				<td></td>
				<td><input id='button_send' type='button' value="Enviar" /></td>
			</tr>
		</table>
	</form>
</body>
	<script src='../../js/acciones.js'></script>
</html>