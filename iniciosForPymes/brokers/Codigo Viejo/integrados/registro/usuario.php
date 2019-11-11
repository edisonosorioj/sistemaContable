 <?php

require('../conexion/config.php');
require('../validaciones.php');
require('../limpiadores.php');
require('../consultas.php');
require('../registros.php');

if (isset($_POST['registrar_usuario'])) {
	if (isset($_POST['tipo_documento']) && $_POST['tipo_documento'] <> 0) {
		$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento']);
		if (isset($_POST['text-doc']) && strlen($_POST['text-doc']) <= 15) {
			$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc']);
			if (isset($_POST['fecha_expedicion_doc'])) {
				$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc']);
				if (isset($_POST['ciudad_us_doc'])) {
				    $_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc']);		
					if (isset($_POST['text-nombre']) && strlen($_POST['text-doc']) <= 30) {
						$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre']);
						if (isset($_POST['text-apellido']) && strlen($_POST['text-doc']) <= 30) {
							$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido']);
							if (isset($_POST['pass']) && strlen($_POST['pass']) <= 10) {
								$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass']);
								if (isset($_POST['pass1']) && strlen($_POST['pass1']) <= 10) {
									if ($_POST['pass'] == $_POST['pass1']) {
										$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1']);
										if (isset($_POST['correo']) && strlen($_POST['correo']) <= 50) {
											$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo']);
											if (isset($_POST['conf_correo']) && strlen($_POST['conf_correo']) <= 50) {
												if (Validar::Correo($_POST['correo']) == true && Validar::Correo($_POST['conf_correo']) == true) {
													if ($_POST['correo'] == $_POST['conf_correo']) {
														$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo'], 'conf_correo' => $_POST['conf_correo']);
														if (isset($_POST['fecha_nacimiento'])) {
															$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo'], 'conf_correo' => $_POST['conf_correo'],'fecha_nacimiento' => $_POST['fecha_nacimiento']);
															$edad = abs(strtotime(date("Y-m-d")) - strtotime($_POST['fecha_nacimiento']));
															if ($edad >= 18) {
																if ($_POST['pais_us'] != '0') {
																	$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo'], 'conf_correo' => $_POST['conf_correo'],'fecha_nacimiento' => $_POST['fecha_nacimiento'], 'pais'=>$_POST['pais_us']);
																	if ($_POST['departamento_us'] != '0') {
																		if ($_POST['ciudad'] != '0') {
																			if ($_POST['genero_us'] != '0') {
																				$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo'], 'conf_correo' => $_POST['conf_correo'], 'fecha_nacimiento' => $_POST['fecha_nacimiento'], 'pais'=>$_POST['pais_us'], 'genero_us' => $_POST['genero_us'],'direccion'=>$_POST['text-dir']);
																				if (isset($_POST['text-dir']) && strlen($_POST['correo']) <= 255) {
																					$_SESSION['temClie'] = array('tipo_documento'=>$_POST['tipo_documento'],'documento'=>$_POST['text-doc'],'fecha_expedicion_doc'=>$_POST['fecha_expedicion_doc'],'ciudad_us_doc'=>$_POST['ciudad_us_doc'],'nombres' => $_POST['text-nombre'], 'apellidos' => $_POST['text-apellido'], 'clave' => $_POST['pass'], 'conf_clave' => $_POST['pass1'], 'correo' => $_POST['correo'], 'conf_correo' => $_POST['conf_correo'], 'fecha_nacimiento' => $_POST['fecha_nacimiento'], 'pais'=>$_POST['pais_us'], 'genero_us' => $_POST['genero_us'], 'direccion'=>$_POST['text-dir']);
																					
																					conectar();
																					if (Consulta::Correo($mysqli, trim($_POST['conf_correo'])) === false) {

																						$tipo_documento = Limpiar::SQL_Injections($mysqli,$_POST['tipo_documento']);
																						$documento = Limpiar::SQL_Injections($mysqli,$_POST['text-doc']);
																						$fecha_expedicion_doc = Limpiar::SQL_Injections($mysqli,$_POST['fecha_expedicion_doc']);
																						$ciudad_us_doc = Limpiar::SQL_Injections($mysqli,$_POST['ciudad_us_doc']);
																						$nombres = Limpiar::SQL_Injections($mysqli,$_POST['text-nombre']);
																						$apellidos = Limpiar::SQL_Injections($mysqli,$_POST['text-apellido']);
																						$password = Limpiar::SQL_Injections($mysqli,$_POST['pass1']);
																						$email = Limpiar::SQL_Injections($mysqli,$_POST['conf_correo']);
																						$fecha_nacimiento = Limpiar::SQL_Injections($mysqli,$_POST['fecha_nacimiento']);
																						$ciudad_us = Limpiar::SQL_Injections($mysqli,$_POST['ciudad']);
																						$genero_us = Limpiar::SQL_Injections($mysqli,$_POST['genero_us']);
																						$direccion = Limpiar::SQL_Injections($mysqli,$_POST['text-dir']);
																						$tel_fijo = Limpiar::SQL_Injections($mysqli,$_POST['text-telFijo']);
																						$tel_movil = Limpiar::SQL_Injections($mysqli,$_POST['text-telMovil']);
																						$tel_alternativo = Limpiar::SQL_Injections($mysqli,$_POST['text-telAlter']);
																						$codigo_activacion = Consulta::Codigo(45);

																						$password = Consulta::Password($password);

																						if (Register::User($mysqli,$tipo_documento,$documento,$fecha_expedicion_doc,$ciudad_us_doc,$nombres,$apellidos,$password,$email,$fecha_nacimiento,$ciudad_us,$genero_us,$direccion,$tel_fijo,$tel_movil,$tel_alternativo,$codigo_activacion) == true) {
																							$link_conf = $dominio."recuperar?usuario=".$documento."&activacion=".$codigo_activacion;
																							require('../mail/registro.php');
																						}else{
																							echo "#".$documento."<br>";
																							echo "<br>error al registrar: ".mysqli_error($mysqli);
																						}

																					}elseif (Consulta::Correo($mysqli, trim($_POST['conf_correo'])) === true) {
																						echo '<script>alert("Este correo ya se encuentra en uso");window.location.href = "../../registro";</script>';
																					}elseif (Consulta::Correo($mysqli, trim($_POST['conf_correo'])) === 1) {
																						echo '<script>alert("No se pudo verificar el correo electronico");window.location.href = "../../registro";</script>';
																					}
																					desconectar();

																				}else{echo '<script>alert("No se envió la dirección");window.location.href = "../../registro";</script>';} // val direccion formulario
																			}else{echo '<script>alert("No selecciono su genero");window.location.href = "../../registro";</script>';} // val genero formulario
																		}else{echo '<script>alert("No se envió la ciudad");window.location.href = "../../registro";</script>';} // val ciudad formulario
																	}else{echo '<script>alert("No se envió el departamento");window.location.href = "../../registro";</script>';} // val departamento formulario
																}else{echo '<script>alert("No se envió el país");window.location.href = "../../registro";</script>';} // val pais formulario
															}else{echo '<script>alert("No eres mayor de edad");window.location.href = "../../registro";</script>';} // val edad formulario
														}else{echo '<script>alert("No se envió la fecha de nacimiento");window.location.href = "../../registro";</script>';} // fecha nacimiento formulario
													}else{echo '<script>alert("Los correos no coinciden");window.location.href = "../../registro";</script>';} // correo igual a conf correo formulario
												}else{echo '<script>alert("Los correos son incorrectos");window.location.href = "../../registro";</script>';} // val correo y conf correo formulario
											}else{echo '<script>alert("No se envió la confirmación del correo electronio");window.location.href = "../../registro";</script>';} // conf correo formulario
										}else{echo '<script>alert("No se envió el correo electrónico");window.location.href = "../../registro";</script>';} // correo formulario
									}else{echo '<script>alert("Las claves no coinciden");window.location.href = "../../registro";</script>';} // conf clave a y clave b
								}else{echo '<script>alert("No se envió la confirmación de la clave");window.location.href = "../../registro";</script>';} // conf clave formulario
							}else{echo '<script>alert("No se envió la clave");window.location.href = "../../registro";</script>';} // clave formulario
						}else{echo '<script>alert("No se envió los apellidos");window.location.href = "../../registro";</script>';} // apellidos formulario
					}else{echo '<script>alert("No se envió los nombres");window.location.href = "../../registro";</script>';} // nombres formulario
				}else{echo '<script>alert("Por favor seleccione la ciudad de expedicion del documento.");window.location.href = "../../registro";</script>';} // documento formulario
			}else{echo '<script>alert("Por favor seleccione la fecha de expedicion del documento.");window.location.href = "../../registro";</script>';} // documento formulario
		}else{echo '<script>alert("No se envió del numero de documento");window.location.href = "../../registro";</script>';} // documento formulario
	}else{echo '<script>alert("Por favor seleccione el tipo de documento.");window.location.href = "../../registro";</script>';} // tipo documento formulario
}else{echo '<script>alert("No se envió el formulario.");window.location.href = "../../registro";</script>';  } // boton formulario