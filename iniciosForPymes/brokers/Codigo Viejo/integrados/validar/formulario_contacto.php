<meta charset="utf-8">
<?php 
require('../conexion/config.php');
require('../validaciones.php');

if (isset($_POST["form_contactenos"])) {
	if (isset($_POST["text-titulo"])) {
		if (isset($_POST["text-nombre"])) {
			if (isset($_POST["text-apellido"])) {
				if (isset($_POST["correo"])) {
					if (Validar::Correo($_POST["correo"]) == true) {
						if (isset($_POST["texto-comentario"])) {

							if (isset($_POST["tel_contacto"])) { $tel_contacto = 'Teléfono: '.$_POST['tel_contacto']; }else{ $tel_contacto = 'Teléfono: No tiene'; }
							require('../mail/formulario_contacto.php');

						}else{echo '<script>alert("Por favor ingrese su mensaje");window.location.href = "../../contacto";</script>';  }
					}else{echo '<script>alert("Por favor ingrese un correo electrónico valido");window.location.href = "../../contacto";</script>';  }
				}else{echo '<script>alert("Por favor ingrese su correo electrónico");window.location.href = "../../contacto";</script>';  }
			}else{echo '<script>alert("Por favor ingrese sus apellidos");window.location.href = "../../contacto";</script>';  }
		}else{echo '<script>alert("Por favor ingrese sus nombres");window.location.href = "../../contacto";</script>';}
	}else{echo '<script>alert("Por favor ingrese un titulo");window.location.href = "../../contacto";</script>';  }
}else{echo '<script>alert("No se envió el formulario");window.location.href = "../../contacto";</script>';  } // boton formulario