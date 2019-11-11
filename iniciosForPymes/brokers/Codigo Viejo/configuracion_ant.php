<?php 
require './integrados/conexion/config.php';
require('./libreria/xajax/xajax.inc.php'); 
require('./libreria/xajax/xajax_cargar_xajax.php');
require('./libreria/xajax/formulario/configuracion/onload.php');
require('./libreria/xajax/formulario/configuracion/desplegar_departamento.php');
require('./libreria/xajax/formulario/configuracion/desplegar_ciudad.php');
require('./libreria/xajax/formulario/configuracion/funciones.php');

require('./integrados/funciones/cargar_pais.php');
require './integrados/funciones/cargar_informacion_profesional_laboral.php';
require('./integrados/funciones/cargar_tipo_documento.php');
require('./integrados/funciones/funciones_configuracion.php');
session_start();
conectar_bd();
$consulta_cod_empresa=mysql_query("SELECT * FROM tbl_usuario WHERE documento = '".$_SESSION['doc']."'");
if ($resultado_cod_empresa=mysql_fetch_array($consulta_cod_empresa)) {
	$consulta_empresa=mysql_query("SELECT * FROM tbl_empresa_trabajo WHERE codigo='".$resultado_cod_empresa['empresa_trabajo']."'");
	if ($resultado_empresa=mysql_fetch_array($consulta_empresa)) {
		$nombre_empresa = $resultado_empresa['nombre'];
		$descripcion_empresa = $resultado_empresa['descripcion'];
		$direccion_empresa = $resultado_empresa['direccion'];
		$tel_empresa = $resultado_empresa['telefono'];
		$cargo_empresa = $resultado_empresa['cargo'];
		$fecha_ingreso_empresa = $resultado_empresa['fecha_ingreso'];
		$ciudad_empresa = $resultado_empresa['ciudad'];
		$actividad_economica=$resultado_empresa['actividad_economica'];
	}else{
		$nombre_empresa = '';
		
	}
}else{
}
$sql_nombre_campos="select COLUMN_NAME from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = 'tbl_usuario'";
$sql_usuario="SELECT * FROM tbl_usuario WHERE documento = '".$_SESSION['doc']."'";
if (!isset($_SESSION['tmp_usuario_config'])) {
	$consulta_usuario=mysql_query($sql_usuario);
	$resultado_usuario=mysql_fetch_array($consulta_usuario);
}

$datos_conyuge=mysql_query("select * from tbl_conyuge where usuario_relacion = '".$_SESSION['doc']."'");
if ($resultado_datos_conyuge=mysql_fetch_array($datos_conyuge)) {
	$disabled="readonly";
	$nombre_empresa_conyuge=mysql_query("select * from tbl_empresa_trabajo where codigo='".$resultado_datos_conyuge['empresa_trabajo']."'");
	$resultado_empresa_trabajo=mysql_fetch_array($nombre_empresa_conyuge);
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Configuración | Brokers</title>
	<meta charset="utf-8">
	<link href="./estilos/style.css" rel="stylesheet">
	<link href="./estilos/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="./estilos/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="shortcut icon" href="./imagenes/logo.ico">
	<script> $( function() { $( "#accordion" ).accordion({ heightStyle: "content" }); } ); </script>
</head>
<body>

	<div onclick="ocultar_barra_lateral_menu()" class="row">
		<div id="colm_index_a" class="colm_index col-md-2 col-lg-3"></div>
		<div id="colm_index_a" class="colm_index col-md-2 col-lg-6">
			<div class="contenedor_global">
				<div class="contenedor_cabecera_forms_titulo sombra_caja"><div><img src="./imagenes/iconos/settings.png"/></div><h3>Configuración de la cuenta</h3></div>

				<div class="style_forms sombra_caja">

					<div id="contenedor_info_config_perf_us" class="caja_titulos_a">
						<a href="<?php echo $url_perf_us_ingr; ?>"><div class="contenedor_mensajes_sis_brks_img"><img src="./imagenes/usuario/<?php echo $_SESSION["imagen_perfil"]; ?>"></div></a>
						<p id="nombre_configuracion">Bienvenido <?php echo $_SESSION['nombres']; ?></p>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="tipo_doc">Tipo documento</label>
							<input id="tipo_doc" type="text" class="form-control" value="<?php echo $_SESSION['tipo_documento'];   ?>" disabled>
						</div>
						<div class="form-group col-md-6">
							<label for="num_doc">Numero documento</label>
							<input id="num_doc" type="number" class="form-control" value="<?php echo $_SESSION['doc']; ?>" disabled>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="nombres_usuario">Nombres</label>
							<input id="nombres_usuario" type="text" class="form-control" value="<?php echo $_SESSION['nombres']; ?>" disabled>
						</div>
						<div class="form-group col-md-6">
							<label for="apellidos_us">Apellidos</label>
							<input id="apellidos_us" type="text" class="form-control" value="<?php echo $_SESSION['apellidos']; ?>" disabled>
						</div>
					</div>
					<p>&nbsp</p>
					<form id="formulario_configuracion_cuenta_us" action="integrados/registros/registro_actualiza_config.php" method="POST" action="./integrados/edicion/guardar_configuracion_cuenta.php">
						<div id="accordion">
							<h3>Información personal</h3>
							<div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="email_registrado">Correo electrónico</label>
										<input id="email_registrado" type="email" name="correo_config" class="form-control" value="<?php echo $_SESSION['correo'] , $_SESSION['tmp_usuario_config'][0] ?>" required placeholder="Ingrese aquí su correo electrónico">
									</div>
									<div class="form-group col-md-6">
										<label for="fecha_nacimiento">Fecha nacimiento</label>
										<input id="fecha_nacimiento" type="date" name="fecha_config" class="form-control" value="<?php echo $_SESSION['fecha_nacimiento'] , $_SESSION['tmp_usuario_config'][1] ?>" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="pais_inf_personal">País</label>
										<select id="pais_inf_personal" name="pais_inf_personal" class="form-control" onchange='xajax_selector_departamento_informacion_personal(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
											<option value="0" selected>Seleccione una opción</option>
											<?php if (!isset($_SESSION['cod_pais_res_us'])){ echo desplegar_paises(); } ?>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label for="departamento_us_inf_personal">Departamento</label>
										<select id='departamento_us_inf_personal' name="departamento_us_inf_personal" class="form-control" onchange='xajax_selector_ciudad_informacion_personal(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
											<option value="0" selected>Seleccione una opción</option>
										</select>
									</div>				              
								</div>
								<div class="form-group col-md-6">
									<label for="ciudad_us_inf_personal">Ciudad</label>
									<select id='ciudad_us_inf_personal' name="ciudad_us_inf_personal" class="form-control" onchange='ocultar_burbujas()'>
										<option value="11" selected>Seleccione una opción</option>
									</select>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="tel_movil">Teléfono móvil</label>
										<input id="tel_movil" type="number" name="tel_movil_config" class="form-control" value="<?php echo $_SESSION['tel_movil'], $_SESSION['tmp_usuario_config'][3] ?>" required placeholder="Ingrese aquí su Teléfono móvil">
									</div>
									<div class="form-group col-md-6">
										<label for="tel_fijo">Teléfono fijo</label>
										<input id="tel_fijo" type="number" name="tel_fijo_config" class="form-control" value="<?php echo $_SESSION['tel_fijo'] , $_SESSION['tmp_usuario_config'][4] ?>" required placeholder="Ingrese aquí su Teléfono fijo">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="tel_alternativo">Teléfono alternativo</label>
										<input id="tel_alternativo" type="number" name="tel_alternativo_config" class="form-control" value="<?php echo $_SESSION['tel_alternativo'], $_SESSION['tmp_usuario_config'][5] ?>" required placeholder="Ingrese aquí su Teléfono móvil">
									</div>
									<div class="form-group col-md-6">
										<label for="direccion_us_conf">Dirección</label>
										<input id="direccion_us_conf" type="text" name="direccion_config" class="form-control" value="<?php echo $_SESSION['direccion'] ,$_SESSION['tmp_usuario_config'][6] ?>" required placeholder="Ingrese aquí su dirección de residencia">
									</div>
								</div>
							</div>

							<h3>Información Profesional y Laboral</h3>
							<div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="profesion_us_config">Profesión</label>
										<?php 
										conectar_bd();
										$consutla_profesion=mysql_query("SELECT * FROM tbl_profesion WHERE codigo='".$resultado_usuario["profesion"]."'");
										
										?>
										<select id='profesion_us_config' name="profesion_us_config" class="form-control" onchange="ocultar_burbujas()">
											<option value="0">Seleccione una opcion</option>
											<?php if($resultado_profesion_solicitante=mysql_fetch_row($consutla_profesion)) {
												?>
												<option value="<?php echo $resultado_profesion_solicitante[0]?>" selected><?php echo $resultado_profesion_solicitante[1] ?></option><?php } ?>
												<?php $consultar_profesion_opt=mysql_query("select * from tbl_profesion where codigo<>'".$resultado_profesion_solicitante[0]."' ");while ($resultado_consulta_profesion_opt=mysql_fetch_row($consultar_profesion_opt)) {?>
													<option value="<?php echo $resultado_consulta_profesion_opt["0"]?>"><?php echo $resultado_consulta_profesion_opt[1] ?></option><?php
												} ?>


											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="situacion_us_laboral">Situación Laboral</label>
											<select id='situacion_us_laboral' name="situacion_us_laboral" class="form-control" onchange="desplegar_campos_situacion_laboral()">
												<?php if(empty($_SESSION["situacion_laboral"])){ echo consultar_situacion_laboral($_SESSION['doc']); }else{echo consultar_situacion_laboral($_SESSION['doc']);} ?>
											</select>
											<input type="hidden" name="codigo_empresa" value="<?php echo $resultado_cod_empresa['empresa_trabajo']; ?>">
										</div>
									</div>
									<div id="contenedor_campos_empleado">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="nombre_empresa_us">Empresa donde labora</label>
												<input id="nombre_empresa_us" type="text" name="nombre_empresa_us" class="form-control" value="<?php  echo $nombre_empresa, $_SESSION['tmp_situacion_config'][2]; ?>" placeholder="Ingrese aquí el nombre de la empresa domde labora">
											</div>
											<div class="form-group col-md-6">
												<label for="sueldo_empresa_us">Sueldo</label>
												<input id="sueldo_empresa_us" type="number" name="sueldo_empresa_us" class="form-control"  value="<?php echo $resultado_usuario['salario'], $_SESSION['tmp_situacion_config'][3]; ?>" placeholder="Ingrese aquí su sueldo">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="cargo_empresa">Cargo que desempeña</label>
												<input id="cargo_empresa" type="text" name="cargo_empresa" class="form-control" value="<?php echo $resultado_usuario['cargo'], $_SESSION['tmp_situacion_config'][4];?>" placeholder="Ingrese aquí el cargo ejercido en la empresa">
											</div>
											<div class="form-group col-md-6">
												<label for="fecha_ingreso_empresa">Fecha de ingreso</label>
												<input id="fecha_ingreso_empresa" type="date" name="fecha_ingreso_empresa" class="form-control" value="<?php echo $resultado_usuario['fecha_ingreso'], $_SESSION['tmp_situacion_config'][5]; ?>" >
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="pais_us_empresa">País</label>
												<select id="pais_us_empresa" name="pais_us_empresa" class="form-control" onchange='xajax_selector_departamento_informacion_empresa(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
													<?php if (!isset($_SESSION['empresa_trabajo']) || empty($_SESSION['empresa_trabajo'])){ echo desplegar_paises(); } ?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="departamento_us_empresa">Departamento</label>
												<select id='departamento_us_empresa' name="departamento_us_empresa" class="form-control" onchange='xajax_selector_ciudad_informacion_empresa(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
												</select>
											</div>				              
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="ciudad_us_empresa">Ciudad</label>
												<select id='ciudad_us_empresa' name="ciudad_us_empresa" class="form-control" onchange="ocultar_burbujas()">
													<option value="10" selected>Seleccione una opción</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="otros_ingresos_us_config">Otros ingresos</label>
												<input id="otros_ingresos_us_config" type="number" name="otros_ingresos_us_config" class="form-control" value="<?php echo $resultado_usuario['otros_ingresos'], $_SESSION['tmp_situacion_config'][7]; ?>" placeholder="Ingrese aquí su sueldo">
											</div>				              
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="direccion_empresa_us_config">Dirección del lugar de trabajo</label>
												<input id="direccion_empresa_us_config" type="text" name="direccion_empresa_us_config" value="<?php echo $direccion_empresa, $_SESSION['tmp_situacion_config'][8] ?>" class="form-control"  placeholder="Dirección del lugar donde trabaja">
											</div>
											<div class="form-group col-md-6">
												<label for="tel_empresa_us_config">Teléfono del lugar de trabajo</label>
												<input id="tel_empresa_us_config" type="number" name="tel_empresa_us_config" value="<?php echo $tel_empresa, $_SESSION['tmp_situacion_config'][9] ?>" class="form-control" placeholder="Teléfono del lugar donde trabaja">
											</div>				              
										</div>
									</div>

									<div id="contenedor_campos_independiente">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="descripcion_negocio_independiente">Descripción del negocio</label>
												<input id="descripcion_negocio_independiente" type="text" name="descripcion_negocio_independiente" class="form-control" value="<?php echo $descripcion_empresa, $_SESSION['tmp_situacion_config'][2]; ?>"  placeholder="Ingrese aquí el nombre de la empresa domde labora">
											</div>
											<div class="form-group col-md-6">
												<label for="tel_empresa_us_independiente_config">Teléfono</label>
												<input id="tel_empresa_us_independiente_config" type="number" value="<?php echo $tel_empresa, $_SESSION['tmp_situacion_config'][2] ?>" name="tel_empresa_us_independiente_config" class="form-control" placeholder="Teléfono del lugar donde trabaja">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="pais_us_independiente">País</label>
												<select id="pais_us_independiente" name="pais_us_independiente" class="form-control" onchange='xajax_selector_departamento_informacion_independiente(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
													<?php if (!isset($_SESSION['empresa_trabajo']) || empty($_SESSION['empresa_trabajo'])){ echo desplegar_paises(); }else{echo desplegar_paises();} ?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="departamento_us_independiente">Departamento</label>
												<select id='departamento_us_independiente' name="departamento_us_independiente" class="form-control" onchange='xajax_selector_ciudad_informacion_independiente(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_pais_dep(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
												</select>
											</div>				              
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="ciudad_us_independiente">Ciudad</label>
												<select id='ciudad_us_independiente' name="ciudad_us_independiente" class="form-control" onchange="ocultar_burbujas()">
													<option value="0" selected>Seleccione una opción</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="registro_doc_independiente">Registro</label>
												<button class="btn btn-success col-md-12" onclick="abrir_pg('subir_archivos.php')">Adjuntar documentación</button>
											</div>				              
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="ingresos_mensuales_us_independiente">Ingresos mensuales</label>
												<input id="ingresos_mensuales_us_independiente" type="number" value="<?php echo $resultado_usuario['salario'],  $_SESSION['tmp_situacion_config'][5]?>" name="ingresos_mensuales_us_independiente" class="form-control" placeholder="Ingresos mensuales">
											</div>
											<div class="form-group col-md-6">
												<label for="egreso_mensuales_us_independiente">Egresos mensuales</label>
												<input id="egreso_mensuales_us_independiente" value="<?php echo $resultado_usuario['egreso'], $_SESSION['tmp_situacion_config'][6]?>" type="number" name="egreso_mensuales_us_independiente" class="form-control" placeholder="Egresos mensuales">
											</div>				              
										</div>
									</div>

									<div id="contenedor_campos_empleo_otro">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="select_actividad_economica_us_config">Actividad económica</label>
												<select id="select_actividad_economica_us_config" name="select_actividad_economica_us_config" class="form-control">

													<option value="0" selected>Seleccione una opción</option>
													<?php
													conectar_bd();
													$consulta_actividad_economica=mysql_query("SELECT * FROM tbl_actividad_economica WHERE codigo='".$actividad_economica."'");
													if ($resultado_actividad_economica=mysql_fetch_row($consulta_actividad_economica)) {
														?>
														<option value="<?php echo $resultado_actividad_economica[0]?>" selected><?php echo $resultado_actividad_economica[1]; ?></option>
														<?php 
														$consulta_actividad=mysql_query("SELECT * FROM tbl_actividad_economica where codigo<>'".$actividad_economica."'");
														while ($resultado_actividad=mysql_fetch_row($consulta_actividad)) {
															?>
															<option value="<?php echo $resultado_actividad[0] ?>"><?php echo $resultado_actividad[1] ?></option>
															<?php 
														}
													}
													desconectar_bd();
													?>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="descripcion_actividad_economica_otro">Descripción actividad económica</label>
												<input id="descripcion_actividad_economica_otro" type="text" name="descripcion_actividad_economica_otro" value="<?php echo $descripcion_empresa, $_SESSION['tmp_situacion_config'][3] ?>" class="form-control" placeholder="Breve descripcion del trabajo">
											</div>
										</div>
									</div>
								</div>
								<h3>Estado Civil</h3>
								<div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="estado_civil_config">Estado Civil</label>
											<select id="estado_civil_config" onchange="desplegar_campos_estado_civil()" name="estado_civil_config" class="form-control">
												<option value="0">Seleccione una opción</option>
												<?php 
												conectar_bd();
												$cosnutla_estado_civil=mysql_query("select * FROM tbl_estado_civil where codigo='".$resultado_usuario['estado_civil']."'");
												if ($resultado_estado_civil=mysql_fetch_row($cosnutla_estado_civil)) {
													?><option value="<?php echo $resultado_estado_civil[0]?>" selected><?php echo $resultado_estado_civil[1]; ?></option>
												<?php }
												$estado_civil=mysql_query("select * from tbl_estado_civil where codigo<>'".$resultado_usuario['estado_civil']."' ");
												while ($resultado_estado_civil_glo=mysql_fetch_row($estado_civil)){
													?>
													<option value="<?php echo $resultado_estado_civil_glo[0]?>"><?php echo $resultado_estado_civil_glo[1]; ?></option>
												<?php } 
												desconectar_bd();
												?>
											</select>
										</div>
									</div>

									<div id="campos_config_estado_civil">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="tipo_documento_conyuge">Tipo documento</label>
												<select id="tipo_documento_conyuge" <?php echo $disabled ?> onchange="ocultar_burbujas()" name="tipo_documento_conyuge" class="form-control">
													<?php 
													conectar_bd();
													$consutla_tipo_doc=mysql_query("select * FROM tbl_tipo_documento where codigo='".$resultado_datos_conyuge['tipo_documento']."'");
													if ($resultado_tipo_doc=mysql_fetch_row($consutla_tipo_doc)) {
														?><option value="<?php echo $resultado_tipo_doc[0]?>" selected><?php echo $resultado_tipo_doc[1] ?></option>
													<?php }
													$tipo_doc=mysql_query("select * from tbl_tipo_documento where codigo<>'".$resultado_datos_conyuge['tipo_documento']."' ");
													while ($resultado_tipo_doc_glo=mysql_fetch_row($tipo_doc)){
														?>
														<option value="<?php echo $resultado_tipo_doc_glo[0]?>"><?php echo $resultado_tipo_doc_glo[1]; ?></option>
													<?php } 
													desconectar_bd();?>
													<option value="0">Seleccione una opción</option>
												</select>
												<input type="hidden" name="tipo_doc_conyuge" value="<?php echo $resultado_datos_conyuge['tipo_documento'] ?>">
											</div>
											<div class="form-group col-md-6">
												<label id="num_documento_conyugee" for="documento_us">Documento de identidad</label>
												<input id="num_documento_conyuge" type="number" <?php echo $disabled ?> class="form-control" name="num_documento_conyuge" value="<?php echo $resultado_datos_conyuge['documento'] ?>" pattern="[0-9]*{15}" maxlength="15" minlength="7" min="0000000" max="999999999999999" placeholder="Ingrese aquí su documento de identidad" title="Solo se puede llenar con numeros" onkeypress="ocultar_burbujas()" >
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="fecha_expedicion_doc_cony">Fecha expedición</label>
												<input id="fecha_expedicion_doc_conyuge" type="date" <?php echo $disabled ?> class="form-control" value="<?php echo $resultado_datos_conyuge['fecha_expedicion']?>" name="fecha_expedicion_doc_conyuge" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()">
											</div>
											<div class="form-group col-md-6">
												<label for="pais_us_doc_expedicion_doc_conyugee">País expedición</label>
												<select id="pais_us_doc_expedicion_doc_conyuge" name="pais_us_doc_expedicion_doc_conyuge" class="form-control" onchange='xajax_selector_departamento_informacion_conyuge(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_doc(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
													<?php if (!isset($_SESSION['estado_civil']) || empty($_SESSION['estado_civil'])){ echo desplegar_paises(); }else{echo desplegar_paises();} ?>
												</select>
											</div> 
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="departamento_us_expedicion_doc_conyugee">Departamento expedición</label>
												<select id='departamento_us_expedicion_doc_conyuge' name="departamento_us_expedicion_doc_conyuge" class="form-control" onchange='xajax_selector_ciudad_informacion_conyuge(xajax.getFormValues("formulario_configuracion_cuenta_us")); estado_select_doc(); ocultar_burbujas()'>
													<option value="0" selected>Seleccione una opción</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label for="ciudad_us_expedicion_doc_conyugee">Ciudad expedición</label>
												<select id='ciudad_us_expedicion_doc_conyuge' name="ciudad_us_expedicion_doc_conyuge" class="form-control" onchange="ocultar_burbujas()" value="<?php echo  $_SESSION['temClie']['ciudad_us_doc']; ?>">
													<option value="0" selected>Seleccione una opción</option>
												</select>
											</div>             
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="nombres_us_conyuge">Nombres</label>
												<input id="nombres_us_conyuge" type="text" <?php echo $disabled ?> class="form-control" name="nombres_us_conyuge"  onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true" value="<?php echo $resultado_datos_conyuge['nombres'] ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="apellidos_us_conyuge">Apellidos</label>
												<input id="apellidos_us_conyuge" type="text" <?php echo $disabled ?> class="form-control" name="apellidos_us_conyuge" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true" value="<?php echo $resultado_datos_conyuge['apellidos'] ?>">
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="numero_tel_conyuge">Teléfono personal</label>
												<input id="numero_tel_conyuge" type="number" class="form-control" name="numero_tel_conyuge" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí si tiene número fijo" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()" value="<?php echo $resultado_datos_conyuge['tel_personal']?>">
											</div>
											<div class="form-group col-md-6">
												<label for="situacion_laboral_conyuge_configg">¿Trabaja?</label>
												<select id="situacion_laboral_conyuge_config" onchange="desplegar_campos_situacion_laboral_conyuge()" name="situacion_laboral_conyuge_config" class="form-control">
													<option value="0" selected="">Seleccione una opción</option>
													<option value="1">Si</option>
													<option value="2">No</option>
												</select>
											</div>
										</div>

									</div>

									<div id="situacion_us_laboral_conyuge">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="nombre_empresa_conyuge">Empresa donde labora</label>
												<input id="nombre_empresa_conyuge" type="text" name="nombre_empresa_conyuge" class="form-control" value="<?php echo $resultado_empresa_trabajo['nombre']; ?>"  placeholder="Ingrese aquí el nombre de la empresa domde labora">
											</div>
											<div class="form-group col-md-6">
												<label for="sueldo_empresa_us">Sueldo</label>
												<input id="sueldo_empresa_us" type="number" name="sueldo_empresa_us" class="form-control" value="<?php echo $resultado_datos_conyuge['sueldo'] ?>"  placeholder="Ingrese aquí su sueldo">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="direccion_empresa_us_config">Dirección del lugar de trabajo</label>
												<input type="text" name="direccion_empresa_us_config" class="form-control" placeholder="Dirección del lugar donde trabaja" value="<?php echo $resultado_empresa_trabajo['direccion'] ?>">
											</div>
											<div class="form-group col-md-6">
												<label for="profesion_us_config_conyuge">Profesión</label>
												<select id='profesion_us_config_conyuge' name="profesion_us_config_conyuge" class="form-control" onchange="ocultar_burbujas()">
													<?php
													conectar_bd();
													$profesion_conyuge=mysql_query("select * from tbl_profesion where codigo='".$resultado_datos_conyuge['profesion']."'");
													if($resultado_profesion_conyuge=mysql_fetch_row($profesion_conyuge)){
														?><option value="<?php echo $resultado_profesion_conyuge[0] ?>" selected><?php echo $resultado_profesion_conyuge[1]; ?></option>
													<?php }
													$consulta_profesion_conyuge=mysql_query("select * from tbl_profesion where codigo<>'".$resultado_datos_conyuge['profesion']."'");
													while($resultado_conyuge_profesion=mysql_fetch_row($consulta_profesion_conyuge)){
														?>
														<option value="<?php echo $resultado_conyuge_profesion[0] ?>"><?php echo $resultado_conyuge_profesion[1] ?></option>
													<?php }
													echo mysql_error(); 
													desconectar_bd();
													?>
												</select>
											</div>				              
										</div>
									</div>

								</div>

								<h3>Bienes adquiridos</h3>
								<div>
									<div style="margin-bottom: 40px;" class="form-row">
										<div class="form-group col-md-6">
											<label for="propiedad_adquirida_select">Propiedades adquiridas</label>
											<select id="propiedad_adquirida_select" onchange="desplegar_campos_bien_propiedad()" name="propiedad_adquirida_select" class="form-control">
												<option value="0">Seleccione una opción</option>
												<option value="1">Si</option>
												<option value="2">No</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="vehiculo_adquirido_us_config">Vehiculos adquiridos</label>
											<select id="vehiculo_adquirido_us_config" onchange="desplegar_campos_bien_vehiculo()" name="vehiculo_adquirido_us_config" class="form-control">
												<option value="0">Seleccione una opción</option>
												<option value="1">Si</option>
												<option value="2">No</option>
											</select>
										</div>
									</div>
									<div id="propiedades_adquiridas_us_config">
										<div class="form-row">
											<div class="form-group col-md-12">
												<table class="table">
													<thead>
														<th>Dirección</th>
														<th>Ciudad</th>
														<th>N° matricula inmobiliaria</th>
														<th></th>
													</thead>
													<tbody id="tr_propiedades_adquiridas"></tbody>
												</table>
											</div>
										</div>
									</div>
									<div id="vehiculos_adquiridos_us_config">
										<div class="form-row">
											<div class="form-group col-md-12">
												<table class="table">
													<thead>
														<th>Marca</th>
														<th>Modelo</th>
														<th>Placa</th>
													</thead>
													<tbody id="tr_vehiculos_adquiridos"></tbody>
												</table>
											</div>
										</div>
									</div>
									<br><br><br>
									<a id="enlace_agregar_bienes_adquiridos" href=""><img src="./imagenes/iconos/plus.png" />&nbsp&nbspAgregar bienes adquiridos</a>
								</div>

								<h3>Actividades Internacionales</h3>
								<div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="operaciones_internacionales_us_config">¿Realiza Operaciones Internacionales?</label>
											<select id="operaciones_internacionales_us_config" onchange="desplegar_campos_operacion_internacional()" name="operaciones_internacionales_us_config" class="form-control">
												<option value="0">Seleccione una opción</option>
												<option value="1">Si</option>
												<option value="2">No</option>
											</select>
										</div>
									</div>
									<div id="campos_operaciones_internacionales">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="tipo_producto_operacion_internacionall">Tipo de operación que realiza</label>
												<select id="tipo_producto_operacion_internacional" name="tipo_producto_operacion_internacional" class="form-control">
													<option value="0" selected="">Seleccione una opción</option>
													<option value="1">ventas por interenet</option>
													<option value="2">venta de divisas</option>
													<option value="3">creador de contenido</option>
													<option value="4">apuestas</option>
													<option value="5">remesas</option>
												</select>
												</div><!--
												<div class="form-group col-md-6">
													<label for="tipo_producto_config_opera_interr">Tipo producto</label>
													<select id="tipo_producto_config_opera_inter" name="tipo_producto_config_opera_inter" class="form-control">
														<option value="0" selected="">Seleccione una opción</option>
														<?php 
															// conectar_bd();
															// $select_tipo_producto=mysql_query("select * from tbl_tipo_producto");
															// while ($resultado_tipo_producto=mysql_fetch_row($select_tipo_producto)) {
															// ?><option value="<?php echo $resultado_tipo_producto[0] ?>"><?php echo $resultado_tipo_producto[1] ?></option>
															// <?php 
															// desconectar_bd();
															// }
														 ?>
														
													</select>
												</div>-->
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="cantidad_producto_operacion_internacionall">Cantidad</label>
													<input id="cantidad_producto_operacion_internacional" type="number" class="form-control" name="cantidad_producto_operacion_internacional" placeholder="Cantidad">
												</div>
												<div class="form-group col-md-6">
													<label for="pais_us_bien_adquirido_propiedad">País</label>
													<select id="pais_us_bien_adquirido_propiedad" name="pais_us_bien_adquirido_propiedad" class="form-control" onchange='ocultar_burbujas()'>	<option value="0" selected>Seleccione una opción</option>
														<?php 
														conectar_bd();
														$select_pais=mysql_query("select * from tbl_pais");
														while ($resultado_pais=mysql_fetch_row($select_pais)) {
															?><option value="<?php echo $resultado_pais["0"] ?>"><?php echo $resultado_pais["1"]; ?></option><?php
															desconectar_bd();
														}

														?>
														
													</select>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="tipo_moneda_operacion_internacionall">Moneda</label>
													<select id="tipo_moneda_operacion_internacional" name="tipo_moneda_operacion_internacional" class="form-control">
														<option value="0" selected>Seleccione una opción</option>
														<?php 
														conectar_bd();
														$select_moneda=mysql_query("select * from tbl_moneda");
														while ($resultado_moneda=mysql_fetch_row($select_moneda)) {
															?><option value="<?php echo $resultado_moneda["0"] ?>"><?php echo $resultado_moneda["1"] ?></option><?php
															desconectar_bd();
														}
														?>

													</select>
												</div>
											</div>
										</div>
										<div class="col-md-11">
											<table class="table table-success">
												<thead>
													<th>Tipo de operacion</th>
													<th>Cantidad</th>
													<th>Moneda</th>
													<th>Pais</th>
													<th>Eliminar</th>
												</thead>
												<tbody>
													<?php
													conectar_bd();
													$datos_actividad_internacional=mysql_query("select tbl_operacion_internacional.codigo as 'codigo', tbl_tipo_operacion_internacional.nombre as 'tipo_operacion', tbl_operacion_internacional.cantidad as 'cantidad', tbl_moneda.nombre as 'moneda',tbl_pais.nombre as 'pais',tbl_operacion_internacional.usuario from tbl_operacion_internacional INNER JOIN tbl_tipo_operacion_internacional ON tbl_operacion_internacional.tipo_operacion = tbl_tipo_operacion_internacional.codigo INNER JOIN tbl_moneda on tbl_moneda.codigo = tbl_operacion_internacional.moneda INNER JOIN tbl_pais on tbl_pais.codigo = tbl_operacion_internacional.pais where tbl_operacion_internacional.usuario='1036424544'");
														
													while ($resultado_actividad_inter=mysql_fetch_array($datos_actividad_internacional)) {
														?><tr>
															<td><?php echo $resultado_actividad_inter["tipo_operacion"]; ?></td>
															<td><?php echo $resultado_actividad_inter["cantidad"] ?></td>
															<td><?php echo $resultado_actividad_inter["moneda"] ?></td>
															<td><?php echo $resultado_actividad_inter["pais"] ?></td>
															<?php $url="integrados/consulta/eliminar_actividad.php?c=".$resultado_actividad_inter['codigo']; ?>
															<td><a class="btn btn-warning text-white" href="<?php echo $url ?>">Eliminar</a></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div> 
									</div>
								</div>



								<input type="submit" name="guardar_configuracion_cuenta_us" class="buttton_enviar" value="Guardar cambios"/>        	
							</form>


						</div>
					</div>
				</div>
				<div id="colm_index_a" class="colm_index col-md-2 col-lg-3"></div>
			</div>

		</body>
		</html>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<?php $xajax->printJavascript('./libreria/xajax/') ?>
		<script type="text/javascript" src="./java/menu.js"></script>
		<script type="text/javascript" src="./java/burbuja_error.js"></script>
		<script type="text/javascript" src="./java/validar_formulario_configuracion.js"></script> 
		<script>
			function abrir_pg(url) {

				var myWindow = window.open(url, "google", "width=750,height=750");
			}
		</script>