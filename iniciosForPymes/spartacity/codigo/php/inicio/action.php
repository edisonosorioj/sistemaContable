<?php

require_once "../conexion.php";


$conex = new conection();
$conection = $conex->conex();
$nomina = '';

$login = $_POST['login'];

$query0 = mysqli_query($conection,"SELECT * FROM administradores WHERE login = '" . $login . "'");
$acceso = mysqli_num_rows($query0);

if ($acceso > 0) {
	$password = md5($_POST['password']);
	$query = mysqli_query($conection,"SELECT * FROM administradores WHERE login = '" . $login . "' AND contrasena = '" . $password . "'");

	$row = $query->fetch_assoc();

	$idadmin 	= $row['idadmin'];
	$idrol		= $row['idrol'];
} else {
	$password = $_POST['password'];
	$query = mysqli_query($conection,"SELECT * FROM clientes WHERE documento = '" . $login . "' AND documento = '" . $password . "'");

	$row = $query->fetch_assoc();

	$idadmin 	= $row['id'];
	$idrol		= 2;
}



// Obtiene la ultima fecha de pago para generar alarmas en el sistema
$query2 = mysqli_query($conection,"SELECT * FROM pagos ORDER BY pago_id DESC LIMIT 1");

$row2 = $query2->fetch_assoc();

$fecha = $row2['fecha'];

// Utilizamos esta consulta para obtener el datos de las variables de configuracion
$query3 = mysqli_query($conection, "SELECT * FROM variables;");

$rows = mysqli_num_rows ($query3);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row3 = mysqli_fetch_array($query3);  
        $rows3[$i] = $row3["nombre"];  
        $datos[$rows3[$i]] = $row3["detalle"];  
    }  
              
}

$nomina = $datos['modulo_nomina'];

// Agrega datos a las variables de configuración
$numrows = mysqli_num_rows($query);
 if($numrows > 0)
	{
/* Redirect browser */
		session_start();
		
		$_SESSION['login'] 				= $login;
		$_SESSION['idadmin'] 			= $idadmin;
		$_SESSION['idrol'] 				= $idrol;
		$_SESSION['fecha_ultimo_pago'] 	= $fecha;
		$_SESSION['modulo_nomina'] 		= $nomina;
		
		header("Location: index.php");
	 
	 	} else {
	 	 
		header("Location: session2.html");
	}
	 

?>