<?php

require_once "../conexion.php";


$conex = new conection();
$conection = $conex->conex();

$login = $_POST['login'];
$password = md5($_POST['password']);

$query = mysqli_query($conection,"select * from administradores where login = '" . $login . "' and password = '" . $password . "'");

$numrows = mysqli_num_rows($query);
 if($numrows > 0)
	{
/* Redirect browser */
		session_start();
		
		$_SESSION['login'] = $login;
		
		header("Location: inicio.php");
	 
	 	} else {
	 	
	 	echo '<script language="javascript">alert("Usuario o Contraseña Incorrecto. Vuelta a intentarlo.");</script>'; 
		header("Location: session.php");
	}
	 

?>