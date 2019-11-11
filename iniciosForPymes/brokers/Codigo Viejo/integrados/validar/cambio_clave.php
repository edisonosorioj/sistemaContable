<meta charset="utf-8">
<?php 
require('../conexion/config.php');
require('../limpiadores.php');
require('../consultas.php');
require('../actualizaciones.php');

if (isset($_POST["form_cambio_contrasena"]) && isset($_POST['codigo']) && isset($_POST["doc"])) {
	if (isset($_POST["password_uno"]) && isset($_POST["password_dos"])) {
		if ($_POST["password_uno"] == $_POST["password_dos"]) {
			conectar();
			$documento_usuario = Limpiar::SQL_Injections($mysqli,$_POST['doc']);
			$password_dos = Limpiar::SQL_Injections($mysqli,$_POST['password_dos']);
			do{
				$new_cod = Consulta::Codigo(45);
				if (Consulta::Codigo_Activacion($mysqli,$new_cod) == 1) {
					$consulta_codigo_finalizado = 0;
				}elseif (Consulta::Codigo_Activacion($mysqli,$new_cod) == 2) {
					$consulta_codigo_finalizado = 2;
				}elseif (Consulta::Codigo_Activacion($mysqli,$new_cod) == 3) {
					echo "<script>alert('Error al consultar código de cambio de clave');window.location.href = '".$dominio."recuperar';</script>";
				}
			}while($consulta_codigo_finalizado < 1);
			desconectar();
			conectar();
			$password_dos = Consulta::Password($password_dos);
			if (Actualizar::Clave_Usuario($mysqli,$password_dos,'documento',$documento_usuario)) {
				if (Actualizar::Campo_Usuario($mysqli,'codigo_activacion',$new_cod,'documento',$documento_usuario)) {
					echo "<script>alert('Se realizo de forma satisfactoria el cambio de su contraseña');window.location.href = '".$dominio."ingreso';</script>";
				}else{
					echo "<script>alert('Error al actualizar el código de validación');window.location.href = '../../recuperar?codigo=".$_POST['codigo']."&doc=".$_POST["doc"]."';</script>";
				}
			}else{
				echo "<script>alert('Error al actualizar la contraseña');window.location.href = '../../recuperar?codigo=".$_POST['codigo']."&doc=".$_POST["doc"]."';</script>";
			}
			desconectar();
		}else{
			echo "<script>alert('Las contraseñas no coinciden, por favor verifique que sean iguales');window.location.href = '../../recuperar?codigo=".$_POST['codigo']."&doc=".$_POST["doc"]."';</script>";
		}
	}else{
		echo "<script>alert('Uno de los campos esta vació por favor complete los campos');window.location.href = '../../recuperar?codigo=".$_POST['codigo']."&doc=".$_POST["doc"]."';</script>";
	}
}else{
	echo "<script>alert('El formulario esta vació, por favor diligencie el formulario');window.location.href = '../../recuperar?codigo=".$_POST['codigo']."&doc=".$_POST["doc"]."';</script>";
}