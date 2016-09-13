<?php   
session_start();
4	unset ($SESSION['username']);
5	session_destroy();
6	 
7	header('Location: session.php');
?>