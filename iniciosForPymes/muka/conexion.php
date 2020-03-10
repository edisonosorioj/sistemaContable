<?php

class conection{

	function conex(){

    //Cambia por los detalles de tu base datos
	  $dbserver = "localhost";
	  $dbuser = "root";
	  $password = "qwer1234";
	  $dbname = "penolinni_muka";
	 
	  $conex = new mysqli($dbserver, $dbuser, $password, $dbname);

	  if($conex->connect_errno) {
	    die("No se pudo conectar a la base de datos");
	  }

	  return $conex;

	}

}

?>