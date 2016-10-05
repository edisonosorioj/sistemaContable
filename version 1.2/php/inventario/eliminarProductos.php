<?php 
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
	$id=$_GET['id'];
	
	$query = mysqli_query($result,"delete from productos where idproductos='$id'");
	
?>

<html>
	<head>
		<title>Productos</title>
		<meta charset="UTF-8" />
		<link rel='stylesheet' href='../../css/reset.css' />
		<link rel='stylesheet' href='../../css/estilos.css' />
	</head>
	
	<body>
		<center>
			<?php 
				if($query > 0){
				?>
				
				<h1>Producto Eliminado</h1>
				
				<?php 	} else { ?>
				
				<h1>Error al Eliminar Producto</h1>
				
			<?php 	} ?>		
			
			<a href="../inventario/index.php" class='menu'>Listo!</a>
			
		</center>
	</body>
</html>