<meta charset="utf-8">
<?php 
require('../conexion/config.php');
require('../validaciones.php');
require('../limpiadores.php');
require('../consultas.php');
require('../actualizaciones.php');

if (isset($_POST['correo'])) {
	conectar();
	$correo = Limpiar::SQL_Injections($mysqli,$_POST['correo']);
	do{
		$new_cod = Consulta::Codigo(45);
		if (Consulta::Codigo_Activacion($mysqli,$new_cod) == 1) {
			$consulta_codigo_finalizado = 0;
		}elseif (Consulta::Codigo_Activacion($mysqli,$new_cod) == 2) {
			$consulta_codigo_finalizado = 2;
		}elseif (Consulta::Codigo_Activacion($mysqli,$new_cod) == 3) {
			echo "<script>alert('Error al consultar código de activación');window.location.href = '".$dominio."recuperar';</script>";
		}
	}while($consulta_codigo_finalizado < 1);
	
	if (Validar::Correo($correo) == true) {
		$Informacion_Usuario = Consulta::Informacion_Usuario($mysqli,'documento','email',$correo);
		if (Consulta::Estado_Cuenta($mysqli, 'email', $correo) == true) {
			if (Actualizar::Codigo_Activacion($mysqli, 'email', $correo, $new_cod) == true) {
				$link_conf=$dominio."recuperar?activacion=".$new_cod."&usuario=".$Informacion_Usuario;
				require('../mail/activar_cuenta.php');
			}elseif (Actualizar::Codigo_Activacion($mysqli, 'email', $correo, $new_cod) == false) {
				echo "<script>alert('Error al actualizar el código de activación');window.location.href = '".$dominio."recuperar';</script>";
			}
		}elseif (Consulta::Estado_Cuenta($mysqli, 'email', $correo) == false) {
			echo "<script>alert('Su cuenta ya se encuentra activada!');window.location.href = '".$dominio."recuperar';</script>";
		}
	}else{ echo "<script>alert('El correo proporcionado es incorrecto');window.location.href = '".$dominio."recuperar';</script>"; }
	desconectar();
}else{
	echo "<script>alert('Por favor digite el correo electrónico registrado');window.location.href = '".$dominio."recuperar';</script>";
}
?>