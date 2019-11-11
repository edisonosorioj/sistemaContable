<?php 

require('./integrados/conexion/config.php');
conectar_bd();
if (isset($_POST['profesion_codigo'])) {
	if (!empty($_POST['profesion']) && !empty($_POST['codigo'])) {
		$profesion = htmlentities($_POST['profesion']);
		if (mysql_query("INSERT INTO tbl_profesion VALUES ('".$_POST['codigo']."', '".$profesion."') ")) {
			echo "Registro completado: codigo:".$_POST['codigo']." // nombre:".$profesion;
		}else{echo mysql_error();}
	}else{ echo 'ingrese la profesion';}
}
desconectar_bd();
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Registro de profesion</title>
 </head>
 <body>
 	<form action="#" method="post">
 		<label for="">Codigo</label><br>
 		<input type="number" name="codigo" placeholder="Codigo" required><br>
 		<input type="text" name="profesion" placeholder="profesiones"><br>
 		<input type="submit" name="profesion_codigo">
 	</form>

 </body>
 </html>