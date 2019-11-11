<?php
require('./integrados/conexion/config.php');
require('./integrados/consultas.php');
session_start();
$key = 'Brokers_123456789_2018';

if (isset($_POST['acces_key'])) {
	if (!empty($_POST['key_log'])) {
		if ($_POST['key_log'] === $key) {
			$_SESSION['loguin_us'] = 'activo';
		}else{
			echo "Clave incorrecta";
		}
	}
}

if (isset($_POST['registrar_sector'])) {
	if (!empty($_POST['publicar_codigo_sector'])) {
		if (!empty($_POST['publicar_nombre_sector'])) {
			$nombre_sector = htmlentities($_POST['publicar_nombre_sector']);
			conectar();
			if (mysqli_query($mysqli,"INSERT INTO tbl_copropiedad (codigo,nombre) VALUES('".$_POST['publicar_codigo_sector']."','".$nombre_sector."') ")) {
				echo "Sector: ".$nombre_sector." Registrado";
			}else{
				echo "error al registrar el Copropiedad: ".mysqli_error($mysqli);
			}
			desconectar();
		}
	}
}

if (isset($_POST['editar_sector'])) {
	if (!empty($_POST['editar_codigo_sector'])) {
		if (!empty($_POST['editar_nombre_sector'])) {
			$nombre_sector = htmlentities($_POST['editar_nombre_sector']);
			conectar();
			if (mysqli_query($mysqli,"UPDATE tbl_copropiedad SET codigo='".$_POST['editar_codigo_sector']."', nombre = '".$nombre_sector."' WHERE codigo = '".$_POST['editar_codigo_sector']."' ")) {
			    echo "Sector: ".$nombre_sector." Actualizado";
		    }else{
		    	echo "error al actualizar el Copropiedad: ".mysqli_error($mysqli);
		    }
		    desconectar();
		}
	}
}

if (isset($_POST['eliminar_sector'])) {
	if (!empty($_POST['eliminar_codigo_sector'])) {
		conectar();
		if (mysqli_query($mysqli,"DELETE FROM tbl_copropiedad WHERE codigo = '".$_POST['eliminar_codigo_sector']."' ")) {
			echo "Sector eliminado";
		}else{
			echo "error al eliminar el Copropiedad: ".mysqli_error($mysqli);
		}
		desconectar();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Publicar Sectores</title>
</head>
<body>

	<style type="text/css" media="screen">
		#tabla_sectores{border: 1px solid black;}
		#tabla_sectores > tbody > tr{border: 1px solid black;}
		#tabla_sectores > tbody > tr > th{border: 1px solid black;}
		#tabla_sectores > tbody > tr > td{border: 1px solid black;}

		#contenedor_espacios{display: inline-flex;width: 100%;height: auto;}
		#publicar_cont{margin-left: 20px;margin-right: 20px;position: fixed;}
		#listar_cont{position: relative;left: 40%;}
		#listar_cont_sectores{position: relative;left: 45%;}
	</style>

	<?php 
	if (!isset($_SESSION['loguin_us'])) {
		?>
		<form action="publicar_copropiedades" method="POST" accept-charset="utf-8">
			<input type="text" name="key_log" placeholder="Clave">
			<input type="submit" name="acces_key" value="Entrar">
		</form>
		<?
	}else{
		?>
		<div id="contenedor_espacios">
			<div id="publicar_cont">
				<form action="publicar_copropiedades" method="POST" accept-charset="utf-8">
					<h3>Publicar Copropiedad</h3>
					<input type="number" name="publicar_codigo_sector" placeholder="Codigo Copropiedad">
					<input type="text" name="publicar_nombre_sector" placeholder="Nombre Copropiedad">
					<input type="submit" name="registrar_sector" value="Registrar Copropiedad">
				</form><br>
				<form action="publicar_copropiedades" method="POST" accept-charset="utf-8">
					<h3>Editar Copropiedad</h3>
					<input type="number" name="editar_codigo_sector" placeholder="Codigo Copropiedad">
					<input type="text" name="editar_nombre_sector" placeholder="Nombre Copropiedad">
					<input type="submit" name="editar_sector" value="Editar Copropiedad">
				</form><br>
				<form action="publicar_copropiedades" method="POST" accept-charset="utf-8">
					<h3>Eliminar Copropiedad</h3>
					<input type="number" name="eliminar_codigo_sector" placeholder="Codigo Sector">
					<input type="submit" name="eliminar_sector" value="Eliminar Copropiedad">
				</form>
			</div>
			<div id="listar_cont">
				<h1>COPROPIEDADES</h1>
				<table id="tabla_sectores">
				  <tr>
				    <th>CODIGO</th> 
				    <th>NOMBRE</th>
				  </tr>
				    <?php
				    conectar();
				    if ($consulta = mysqli_query($mysqli,"SELECT * FROM tbl_copropiedad")) {
						if ($resultado = mysqli_fetch_array($consulta)) {
							do{
								?><tr><td><?php echo $resultado['codigo']; ?></td><?
								?><td><?php echo $resultado['nombre']; ?></td></tr><?
							}while ($resultado = mysqli_fetch_array($consulta));
						}
					}
				    ?>
				</table><br>
			</div>
			
			</div>
		</div>
		<?
	}
	?>

</body>
</html>