<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from clientes where id='$id'");
	
?>

<html>
	<head>
		<title>Cliente</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	
	<body>
		<center>
			<?php 
				if($query > 0){
				?>
				
				<h1>Cliente Eliminado</h1>
				
				<?php 	} else { ?>
				
				<h1>Error al Eliminar Cliente</h1>
				
			<?php 	} ?>		
			
			<a href="clientes.php" class='menu'>Listo!</a>
			
		</center>
	</body>
</html>