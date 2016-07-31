<?php

require_once "conexion.php";

session_start();

$conex = new conection();
$conection = $conex->conex();

// $resultado = $conection->query($query);

$login = $_POST['login'];
$password = md5($_POST['password']);

$query = mysqli_query($conection,"select * from administradores where login = '" . $login . "' and password = '" . $password . "'");

$numrows=mysqli_num_rows($query);
 if($numrows!=0)
	{
/* Redirect browser */
		 header("Location: ../html/inicio.php");
	 
	 	} else {
	 	
		header("Location: session.php");
	}
	 

session_destroy();

?>