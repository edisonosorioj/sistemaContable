<?php

class conection{

	function conex(){

    //Cambia por los detalles de tu base datos
	  $dbserver = "localhost";
	  // $dbserver = "127.0.0.1";
	  $dbuser = "root";
	  $password = "";
	  // $password = "qwer1234";
	  $dbname = "sistema_contable";
	 
	  $conex = new mysqli($dbserver, $dbuser, $password, $dbname);

	  if($conex->connect_errno) {
	    die("No se pudo conectar a la base de datos");
	  }

	  return $conex;

	}

}

?>