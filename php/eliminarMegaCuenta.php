<?php 
require_once "conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from estadoCompras where idestado = '$id'");
	
?>

<html>
	<head>
		<title>Eliminar Mega Cuenta</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../css/reset.css' />
		<link rel='stylesheet' href='../css/estilos.css' />
	</head>
	
	<body>
		<center>
			<?php 
				if($query > 0){
				?>
				
				<h1>Mega Cuenta Eliminada</h1>
				
				<?php 	} else { ?>
				
				<h1>Error al Eliminar La Mega Cuenta</h1>
				
			<?php 	} ?>		
			
			<a href="../php/estadoCompras.php" class='menu'>Listo!</a>
			
		</center>
	</body>
</html>