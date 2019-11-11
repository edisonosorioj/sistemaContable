<?php

require('./integrados/validaciones.php');
require('./integrados/consultas.php');
require('./integrados/mensajes.php');

if (isset($_POST['correo_ingresar']) && isset($_POST['password_ingresar'])) {
	if (Validar::Correo($_POST['correo_ingresar']) == true) {
		conectar();
		$msn = Consulta::Ingresar($mysqli, trim($_POST['correo_ingresar']), trim($_POST['password_ingresar']));
		header('Location: '.$dominio.'validando_ingreso?'.$msn.' ');
		desconectar();
	}else{header('Location: '.$dominio.'validando_ingreso?msn=6');}
}