<?php

// require_once "../conexion.php";


// $conex 		= new conection();
// $conection 	= $conex->conex();

$login 		= 'admin';
$password 	= 'admin';


// $query = mysqli_query($conection,"SELECT * FROM administradores WHERE login = '" . $login . "' AND contrasena = '" . $password . "'");

// $row = $query->fetch_assoc();

/* Redirect browser */
if($_POST['login'] == $login && $_POST['password'] == $password){
	session_start();
	
	$_SESSION['login'] 	= $login;
	
	header("Location: php/index.php");
 
 	} else {
 	 
	header("Location: login2.html");
}
	 

?>