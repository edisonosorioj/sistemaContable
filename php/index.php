<?php

require_once 'conexion.php';

?>
<html>
<head>
	<title>Mi app</title>
</head>
<body>
	<form id='login_form' action='' method='POST'>
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
</html>