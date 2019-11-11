<?php 
require('../integrados/conexion/config.php');
session_start(); 
if (!isset($_SESSION['doc'])) {redirigir_sesion($_SESSION['doc']);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../logo.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Formulario de Arrendamiento Natural
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="../libreria/theme/css/material-kit.css" rel="stylesheet" />
	<link href="../libreria/theme/demo/demo.css" rel="stylesheet" />
	<link href="../estilos/general.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

	<script> $( function() { $( "#accordion" ).accordion({ heightStyle: "content" }); } ); </script>
</head>

<body class="login-page sidebar-collapse">
	<?php require('../integrados/internas/menu.php'); ?>
	<div class="header-filter" style=" background-image: url('../libreria/theme/img/city-profile_b.jpg'); background-size: cover; background-position: top center;position: fixed;top: 0px;left: 0px;height: 100%;width: 100%;"></div>
	<div id="contenedor_publicar_propiedad" class="page-header header-filter">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-10 ml-auto mr-auto">
					<div id="contenedor_publicar_form_propiedad" class="card card-login">
						<form id="form_publicar_propiedad" class="form" action="?" method="POST">
							<div class="card-header card-header-primary text-center">
								<h4 class="card-title">Formulario de Arrendamiento Persona Natural</h4>
								<?php require('../integrados/internas/social_line.php'); ?>
							</div>
							<p class="description text-center">Por favor ingrese toda la información correctamente</p>
							<div style="margin-bottom: 60px;" class="card-body">

								<div class="title">
									<h2 class="titulos_formularios_h2">Información de la Propiedad</h2>
								</div>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">fiber_pin</i>
										</span>
									</div>
									<input id="codigo_propiedad_arrendar" type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="A0001" disabled spellcheck="true" placeholder="Titulo de la propiedad...">
								</div>

								<div class="form-row">

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">location_city</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="ciudad_inmueble_arrendar" class="bmd-label-floating">Ciudad de ubicación del inmueble</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Medellin" id="ciudad_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">location_on</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="direccion_inmueble_arrendar" class="bmd-label-floating">Dirección del inmueble</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Calle 32b N° 25-37" id="direccion_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">domain_disabled</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="tipo_inmueble_arrendar" class="bmd-label-floating">Tipo de inmueble</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Finca" id="tipo_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">list_alt</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="uso_inmueble_arrendar" class="bmd-label-floating">Destino que le va ha dar al inmueble</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Solo Recidencial" id="uso_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

								</div>

								<div class="form-row">

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">access_time</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="tiempo_inmueble_arrendar" class="bmd-label-floating">El tiempo mínimo de arrendamiento</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="6 meses" id="tiempo_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

									<div class="form-group col-md-6">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">attach_money</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad">
												<label for="cuota_inmueble_arrendar" class="bmd-label-floating">Cuota de administración</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="$50.000" id="cuota_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

								</div>


								<div class="form-row">

									<div class="form-group col-md-12">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">attach_money</i>
												</span>
											</div>
											<div class="form-group reset_cont_form_arrendar_propiedad_b">
												<label for="val_arriendo_inmueble_arrendar" class="bmd-label-floating">Valor del arriendo del inmueble</label>
												<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="$400.000" id="val_arriendo_inmueble_arrendar" disabled>
											</div>
										</div>
									</div>

								</div>								

								<div class="section section-tabs">
									<div class="container">
										<div id="nav-tabs">
											<div class="row">
												<div class="col-md-12">
													<div class="card card-nav-tabs">
														<div class="card-header card-header-primary">
															<div class="nav-tabs-navigation">
																<div class="nav-tabs-wrapper">
																	<ul class="nav nav-tabs" data-tabs="tabs">
																		<li class="nav-item">
																			<a class="nav-link active" href="#datos_solicitante" data-toggle="tab">
																				<i class="material-icons">contacts</i> Datos solicitante
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" href="#datos_codeudores" data-toggle="tab">
																				<i class="material-icons">how_to_reg</i> Datos de los codeudores
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" href="#datos_referencia" data-toggle="tab">
																				<i class="material-icons">ballot</i> Referencias
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
														<div class="card-body ">
															<div class="tab-content text-center">
																<div class="tab-pane active" id="datos_solicitante">
																	<h2>Información Personal</h2>
																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">face</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="tipo_doc_us_inmueble_arrendar" class="bmd-label-floating">Tipo de documento</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['tipo_documento'] ?>" id="tipo_doc_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">fiber_pin</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="num_doc_inmueble_arrendar" class="bmd-label-floating">Número de documento</label>
																					<input type="number" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['doc'] ?>" id="num_doc_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">location_on</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="lugar_exp_doc_us_inmueble_arrendar" class="bmd-label-floating">Lugar de expedición</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['ciudad_doc'] ?>" id="lugar_exp_doc_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">date_range</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="num_doc_inmueble_arrendar" class="bmd-label-floating">Fecha de expedición</label>
																					<input type="date" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['fecha_expedicion'] ?>" id="num_doc_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">assignment_ind</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="nombre_us_inmueble_arrendar" class="bmd-label-floating">Nombres</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['nombres'] ?>" id="nombre_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">assignment_ind</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="ape_us_inmueble_arrendar" class="bmd-label-floating">Apellidos</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['apellidos'] ?>" id="ape_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">date_range</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="fecha_nac_us_inmueble_arrendar" class="bmd-label-floating">Fecha de nacimiento</label>
																					<input type="date" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['fecha_nacimiento'] ?>" id="fecha_nac_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">wc</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="genero_us_inmueble_arrendar" class="bmd-label-floating">Genero</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['genero'] ?>" id="genero_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">mood</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="estado_civil_us_inmueble_arrendar" class="bmd-label-floating">Estado civil</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['estado_civil']; ?>" id="estado_civil_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">group_add</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="personas_acargo_us_inmueble_arrendar" class="bmd-label-floating">Número de personas a cargo</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['numero_personas_acargo']; ?>" id="personas_acargo_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">business_center</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="profesion_us_inmueble_arrendar" class="bmd-label-floating">Profesión</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Programador" id="profesion_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">phone_android</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="tel_personal_us_inmueble_arrendar" class="bmd-label-floating">Teléfono personal</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="3207220876" id="tel_personal_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																	<div class="form-row">

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">alternate_email</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="email_us_inmueble_arrendar" class="bmd-label-floating">Correo electrónico</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="<?php echo $_SESSION['correo']; ?>" id="email_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																		<div class="form-group col-md-6">
																			<div class="input-group">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="material-icons">email</i>
																					</span>
																				</div>
																				<div class="form-group reset_inputs_form_accordion_arrendar_propiedad">
																					<label for="dir_correspondencia_us_inmueble_arrendar" class="bmd-label-floating">Dirección de envió de correspondencia</label>
																					<input type="text" class="form-control reset_inputs_form_arrendar_propiedad" value="Cra 56 #25-45" id="dir_correspondencia_us_inmueble_arrendar" disabled>
																				</div>
																			</div>
																		</div>

																	</div>

																</div><!-- FIN DATOS SOLICITANTE -->
																<div class="tab-pane" id="datos_codeudores">
																	<div class="card card-nav-tabs">
																		<div class="card-header card-header-primary">
																			<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
																			<div class="nav-tabs-navigation">
																				<div class="nav-tabs-wrapper">
																					<ul class="nav nav-tabs" data-tabs="tabs">
																						<li class="nav-item">
																							<a class="nav-link active" href="#codeudor_uno" data-toggle="tab">
																								<i class="material-icons">face</i> Codeudor Uno
																							</a>
																						</li>
																						<li class="nav-item">
																							<a class="nav-link" href="#codeudor_dos" data-toggle="tab">
																								<i class="material-icons">face</i> Codeudor Dos
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																		<div class="card-body ">
																			<div class="tab-content text-center">
																				<div class="tab-pane active" id="codeudor_uno">
																					<div class="tab-pane active" id="codeudor_uno">
																						<h2>Codeudor Uno</h2>
																						<div class="form-row">

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div id="icon_tipo_doc_reg" class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">face</i>
																										</span>
																									</div>
																									<select id="tipo_documento_codeudor_uno" onchange="ocultar_burbujas()" name="tipo_documento_codeudor_uno" class="form-control">
																										<option value="0" selected>Seleccione el tipo documento</option>
																										<option value="1">...</option>
																									</select>
																								</div>
																							</div>

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">fiber_pin</i>
																										</span>
																									</div>
																									<input id="num_doc_codeudor_uno" type="number" class="form-control" name="num_doc_codeudor_uno"  pattern="[0-9]*{15}" maxlength="15" minlength="7" min="0000000" max="999999999999999" placeholder="Ingrese aquí el número de documento de identidad" title="Solo se puede llenar con números" onkeypress="ocultar_burbujas()">
																								</div>
																							</div>

																						</div>

																						<div class="form-row">

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend reset_display_icon">
																										<span class="input-group-text">
																											<i class="material-icons">date_range</i>
																										</span>
																									</div>
																									<div class="form-group reset_display">
																										<label for="fecha_expedicion_doc_codeudor_uno">Fecha expedición</label>
																										<input id="fecha_expedicion_doc_codeudor_uno" type="date" class="form-control" name="fecha_expedicion_doc_codeudor_uno" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()">
																									</div>
																								</div>
																							</div>

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span id="icon_pais_reg" class="input-group-text">
																											<i class="material-icons">public</i>
																										</span>
																									</div>
																									<select id="pais_doc_codeudor_uno" name="pais_doc_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																										<option value="0" selected>Seleccione país de expedición</option>
																										<option>...</option>
																									</select>
																								</div>
																							</div>

																						</div>

																						<div class="form-row">

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">business</i>
																										</span>
																									</div>
																									<select id='departamento_us_doc_codeudor_uno' name="departamento_us_doc_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																										<option value="0" selected>Seleccione el departamento de expedición</option>
																										<option>...</option>
																									</select>
																								</div>
																							</div>

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">home</i>
																										</span>
																									</div>
																									<select id='ciudad_us_doc_codeudor_uno' name="ciudad_us_doc_codeudor_uno" class="form-control" onchange="ocultar_burbujas()">
																										<option value="0" selected>Seleccione la ciudad de expedición</option>
																										<option>...</option>
																									</select>
																								</div>
																							</div> 

																						</div>

																						<div class="form-row">

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">person</i>
																										</span>
																									</div>
																									<input id="nombres_codeudor_uno" type="text" class="form-control" name="nombres_codeudor_uno" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true">
																								</div>
																							</div>

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">create</i>
																										</span>
																									</div>
																									<input id="apellidos_codeudor_uno" type="text" class="form-control" name="apellidos_codeudor_uno" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true">
																								</div>
																							</div> 

																						</div>

																						<div class="form-row">

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">phone</i>
																										</span>
																									</div>
																									<input id="numero_movil_codeudor_uno" type="number" class="form-control" name="numero_movil_codeudor_uno" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí si tiene número fijo" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																								</div>
																							</div>

																							<div class="form-group col-md-6">
																								<div class="input-group">
																									<div id="icon_trabajo_codeudor_uno" class="input-group-prepend">
																										<span class="input-group-text">
																											<i class="material-icons">work</i>
																										</span>
																									</div>
																									<select id='trabajo_codeudor_uno' name="trabajo_codeudor_uno" class="form-control" onchange="ocultar_burbujas(); desplegar_form_trabajo(1);">
																										<option value="0" selected>¿Trabaja?</option>
																										<option value="1">Empleado</option>
																										<option value="2">Independiente</option>
																										<option value="3">Otro</option>
																									</select>
																								</div>
																							</div> 

																						</div>

																						<div id="informacion_empresa_codeudor_uno" class="card card-nav-tabs">
																							<div class="card-header card-header-primary">
																								<div class="nav-tabs-navigation">
																									<div class="nav-tabs-wrapper">
																										<ul class="nav nav-tabs" data-tabs="tabs">
																											<li class="nav-item">
																												<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																													<i class="material-icons">face</i> Información Empresa
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							<div class="card-body ">
																								<div class="tab-content text-center">
																									<div class="tab-pane active" id="info_empresa_codeudor_uno">

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">business</i>
																														</span>
																													</div>
																													<input id="nombre_empresa_codeudor_uno" type="text" class="form-control" name="nombre_empresa_codeudor_uno" placeholder="Nombre de la empresa o negocio" onkeypress="ocultar_burbujas()">
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">phone</i>
																														</span>
																													</div>
																													<input id="tel_empresa_codeudor_uno" type="number" class="form-control" name="tel_empresa_codeudor_uno" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí el número telefónico de la empresa" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div> 

																										</div>

																										<div class="input-group">
																											<div class="correcion_input_forms">
																												<label for="descripcion_empresa_codeudor_uno">Descripción de Empresa</label>
																												<textarea id="descripcion_empresa_codeudor_uno" class="form-control" name="descripcion_empresa_codeudor_uno" spellcheck="true"></textarea>
																											</div>
																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">location_on</i>
																														</span>
																													</div>
																													<input id="direccion_empresa_codeudor_uno" type="text" class="form-control" name="direccion_empresa_codeudor_uno" placeholder="Dirección de la empresa" onkeypress="ocultar_burbujas()">
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span id="icon_pais_empresa_codeudor_uno" class="input-group-text">
																															<i class="material-icons">public</i>
																														</span>
																													</div>
																													<select id="pais_empresa_codeudor_uno" name="pais_empresa_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Seleccione país</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">business</i>
																														</span>
																													</div>
																													<select id='departamento_empresa_codeudor_uno' name="departamento_empresa_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Seleccione el departamento</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">home</i>
																														</span>
																													</div>
																													<select id='ciudad_empresa_codeudor_uno' name="ciudad_empresa_codeudor_uno" class="form-control" onchange="ocultar_burbujas()">
																														<option value="0" selected>Seleccione la ciudad</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div id="icon_profesion_empresa_codeudor_uno" class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">work</i>
																														</span>
																													</div>
																													<select id='profesion_empresa_codeudor_uno' name="profesion_empresa_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Profesion</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">attach_money</i>
																														</span>
																													</div>
																													<input id="salario_mensuales_codeudor_uno" type="number" class="form-control" name="salario_mensuales_codeudor_uno" pattern="[0-9]*{10}" placeholder="Salario" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">attach_money</i>
																														</span>
																													</div>
																													<input id="egresos_mensuales_codeudor_uno" type="number" class="form-control" name="egresos_mensuales_codeudor_uno" pattern="[0-9]*{10}" placeholder="Egresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend reset_display_icon">
																														<span class="input-group-text">
																															<i class="material-icons">date_range</i>
																														</span>
																													</div>
																													<div class="form-group reset_display">
																														<label for="fecha_ingreso_codeudor_uno">Fecha ingreso</label>
																														<input id="fecha_ingreso_codeudor_uno" type="date" class="form-control" name="fecha_ingreso_codeudor_uno" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()">
																													</div>
																												</div>
																											</div> 

																										</div>

																									</div>
																								</div>
																							</div>
																						</div>

																						<div id="informacion_empresa_independiente_codeudor_uno" class="card card-nav-tabs">
																							<div class="card-header card-header-primary">
																								<div class="nav-tabs-navigation">
																									<div class="nav-tabs-wrapper">
																										<ul class="nav nav-tabs" data-tabs="tabs">
																											<li class="nav-item">
																												<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																													<i class="material-icons">face</i> Información Trabajo Independiente
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							<div class="card-body ">
																								<div class="tab-content text-center">
																									<div class="tab-pane active" id="info_empresa_codeudor_uno">

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">business</i>
																														</span>
																													</div>
																													<input id="nombre_empresa_independiente_codeudor_uno" type="text" class="form-control" name="nombre_empresa_independiente_codeudor_uno" placeholder="Nombre de la empresa o negocio" onkeypress="ocultar_burbujas()">
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">phone</i>
																														</span>
																													</div>
																													<input id="tel_empresa_independiente_codeudor_uno" type="number" class="form-control" name="tel_empresa_independiente_codeudor_uno" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí el número telfonico de la empresa" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div> 

																										</div>

																										<div class="input-group">
																											<div class="correcion_input_forms">
																												<label for="descripcion_empresa_independiente_codeudor_uno">Descripción de Empresa</label>
																												<textarea id="descripcion_empresa_independiente_codeudor_uno" class="form-control" name="descripcion_empresa_independiente_codeudor_uno" spellcheck="true"></textarea>
																											</div>
																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">location_on</i>
																														</span>
																													</div>
																													<input id="direccion_empresa_independiente_codeudor_uno" type="text" class="form-control" name="direccion_empresa_independiente_codeudor_uno" placeholder="Dirección de la empresa" onkeypress="ocultar_burbujas()">
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span id="icon_pais_empresa_codeudor_uno" class="input-group-text">
																															<i class="material-icons">public</i>
																														</span>
																													</div>
																													<select id="pais_empresa_independiente_codeudor_uno" name="pais_empresa_independiente_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Seleccione país</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">business</i>
																														</span>
																													</div>
																													<select id='departamento_empresa_independiente_codeudor_uno' name="departamento_empresa_independiente_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Seleccione el departamento</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">home</i>
																														</span>
																													</div>
																													<select id='ciudad_empresa_independiente_codeudor_uno' name="ciudad_empresa_independiente_codeudor_uno" class="form-control" onchange="ocultar_burbujas()">
																														<option value="0" selected>Seleccione la ciudad</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div id="icon_registro_empresa_codeudor_uno" class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">attach_file</i>
																														</span>
																													</div>
																													<select id='registro_empresa_independiente_codeudor_uno' name="registro_empresa_independiente_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Registro</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div>

																											<div class="form-group col-md-6">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">attach_money</i>
																														</span>
																													</div>
																													<input id="ingresos_mensuales_independiente_codeudor_uno" type="number" class="form-control" name="ingresos_mensuales_independiente_codeudor_uno" pattern="[0-9]*{10}" placeholder="Ingresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div> 

																										</div>

																										<div class="form-row">

																											<div class="form-group col-md-12">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">attach_money</i>
																														</span>
																													</div>
																													<input id="egresos_mensuales_independiente_codeudor_uno" type="number" class="form-control" name="egresos_mensuales_independiente_codeudor_uno" pattern="[0-9]*{10}" placeholder="Egresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																												</div>
																											</div> 

																										</div>

																									</div>
																								</div>
																							</div>
																						</div>

																						<div id="informacion_empresa_otro_codeudor_uno" class="card card-nav-tabs">
																							<div class="card-header card-header-primary">
																								<div class="nav-tabs-navigation">
																									<div class="nav-tabs-wrapper">
																										<ul class="nav nav-tabs" data-tabs="tabs">
																											<li class="nav-item">
																												<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																													<i class="material-icons">face</i> Información Trabajo
																												</a>
																											</li>
																										</ul>
																									</div>
																								</div>
																							</div>
																							<div class="card-body ">
																								<div class="tab-content text-center">
																									<div class="tab-pane active" id="info_empresa_codeudor_uno">

																										<div class="form-row">

																											<div class="form-group col-md-12">
																												<div class="input-group">
																													<div class="input-group-prepend">
																														<span class="input-group-text">
																															<i class="material-icons">bar_chart</i>
																														</span>
																													</div>
																													<select id='actividad_economica_codeudor_uno' name="actividad_economica_codeudor_uno" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																														<option value="0" selected>Selecciona la Actividad Económica</option>
																														<option value="1">...</option>
																													</select>
																												</div>
																											</div>

																										</div>

																										<div class="input-group">
																											<div class="correcion_input_forms">
																												<label for="descripcion_actividad_economica_codeudor_uno">Descripción de la Actividad Económica</label>
																												<textarea id="descripcion_actividad_economica_codeudor_uno" class="form-control" name="descripcion_actividad_economica_codeudor_uno" spellcheck="true"></textarea>
																											</div>
																										</div>

																									</div>
																								</div>
																							</div>
																						</div>


																					</div>
																				</div>
																				<div class="tab-pane" id="codeudor_dos">
																					<h2>Codeudor Dos</h2>
																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div id="icon_tipo_doc_reg" class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">face</i>
																									</span>
																								</div>
																								<select id="tipo_documento_codeudor_dos" onchange="ocultar_burbujas()" name="tipo_documento_codeudor_dos" class="form-control">
																									<option value="0" selected>Seleccione el tipo documento</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">fiber_pin</i>
																									</span>
																								</div>
																								<input id="num_doc_codeudor_dos" type="number" class="form-control" name="num_doc_codeudor_dos"  pattern="[0-9]*{15}" maxlength="15" minlength="7" min="0000000" max="999999999999999" placeholder="Ingrese aquí el número de documento de identidad" title="Solo se puede llenar con números" onkeypress="ocultar_burbujas()">
																							</div>
																						</div>

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend reset_display_icon">
																									<span class="input-group-text">
																										<i class="material-icons">date_range</i>
																									</span>
																								</div>
																								<div class="form-group reset_display">
																									<label for="fecha_expedicion_doc_codeudor_dos">Fecha expedición</label>
																									<input id="fecha_expedicion_doc_codeudor_dos" type="date" class="form-control" name="fecha_expedicion_doc_codeudor_dos" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()">
																								</div>
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span id="icon_pais_reg" class="input-group-text">
																										<i class="material-icons">public</i>
																									</span>
																								</div>
																								<select id="pais_doc_codeudor_dos" name="pais_doc_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione país de expedición</option>
																									<option>...</option>
																								</select>
																							</div>
																						</div>

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">business</i>
																									</span>
																								</div>
																								<select id='departamento_us_doc_codeudor_dos' name="departamento_us_doc_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione el departamento de expedición</option>
																									<option>...</option>
																								</select>
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">home</i>
																									</span>
																								</div>
																								<select id='ciudad_us_doc_codeudor_dos' name="ciudad_us_doc_codeudor_dos" class="form-control" onchange="ocultar_burbujas()">
																									<option value="0" selected>Seleccione la ciudad de expedición</option>
																									<option>...</option>
																								</select>
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">person</i>
																									</span>
																								</div>
																								<input id="nombres_codeudor_dos" type="text" class="form-control" name="nombres_codeudor_dos" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">create</i>
																									</span>
																								</div>
																								<input id="apellidos_codeudor_dos" type="text" class="form-control" name="apellidos_codeudor_dos" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true">
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">phone</i>
																									</span>
																								</div>
																								<input id="numero_movil_codeudor_dos" type="number" class="form-control" name="numero_movil_codeudor_dos" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí si tiene número fijo" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div id="icon_trabajo_codeudor_uno" class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">work</i>
																									</span>
																								</div>
																								<select id='trabajo_codeudor_dos' name="trabajo_codeudor_dos" class="form-control" onchange="ocultar_burbujas(); desplegar_form_trabajo(2);">
																									<option value="0" selected>¿Trabaja?</option>
																									<option value="1">Empleado</option>
																									<option value="2">Independiente</option>
																									<option value="3">Otro</option>
																								</select>
																							</div>
																						</div> 

																					</div>

																					<div id="informacion_empresa_codeudor_dos" class="card card-nav-tabs">
																						<div class="card-header card-header-primary">
																							<div class="nav-tabs-navigation">
																								<div class="nav-tabs-wrapper">
																									<ul class="nav nav-tabs" data-tabs="tabs">
																										<li class="nav-item">
																											<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																												<i class="material-icons">face</i> Información Empresa
																											</a>
																										</li>
																									</ul>
																								</div>
																							</div>
																						</div>
																						<div class="card-body ">
																							<div class="tab-content text-center">
																								<div class="tab-pane active" id="info_empresa_codeudor_uno">

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">business</i>
																													</span>
																												</div>
																												<input id="nombre_empresa_codeudor_dos" type="text" class="form-control" name="nombre_empresa_codeudor_dos" placeholder="Nombre de la empresa o negocio" onkeypress="ocultar_burbujas()">
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">phone</i>
																													</span>
																												</div>
																												<input id="tel_empresa_codeudor_dos" type="number" class="form-control" name="tel_empresa_codeudor_dos" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí el número telefónico de la empresa" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div> 

																									</div>

																									<div class="input-group">
																										<div class="correcion_input_forms">
																											<label for="descripcion_empresa_codeudor_dos">Descripción de Empresa</label>
																											<textarea id="descripcion_empresa_codeudor_dos" class="form-control" name="descripcion_empresa_codeudor_dos" spellcheck="true"></textarea>
																										</div>
																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">location_on</i>
																													</span>
																												</div>
																												<input id="direccion_empresa_codeudor_dos" type="text" class="form-control" name="direccion_empresa_codeudor_dos" placeholder="Dirección de la empresa" onkeypress="ocultar_burbujas()">
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span id="icon_pais_empresa_codeudor_uno" class="input-group-text">
																														<i class="material-icons">public</i>
																													</span>
																												</div>
																												<select id="pais_empresa_codeudor_dos" name="pais_empresa_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Seleccione país</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">business</i>
																													</span>
																												</div>
																												<select id='departamento_empresa_codeudor_dos' name="departamento_empresa_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Seleccione el departamento</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">home</i>
																													</span>
																												</div>
																												<select id='ciudad_empresa_codeudor_dos' name="ciudad_empresa_codeudor_dos" class="form-control" onchange="ocultar_burbujas()">
																													<option value="0" selected>Seleccione la ciudad</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div id="icon_profesion_empresa_codeudor_uno" class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">work</i>
																													</span>
																												</div>
																												<select id='profesion_empresa_codeudor_dos' name="profesion_empresa_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Profesion</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">attach_money</i>
																													</span>
																												</div>
																												<input id="salario_mensuales_codeudor_dos" type="number" class="form-control" name="salario_mensuales_codeudor_dos" pattern="[0-9]*{10}" placeholder="Salario" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">attach_money</i>
																													</span>
																												</div>
																												<input id="egresos_mensuales_codeudor_dos" type="number" class="form-control" name="egresos_mensuales_codeudor_dos" pattern="[0-9]*{10}" placeholder="Egresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend reset_display_icon">
																													<span class="input-group-text">
																														<i class="material-icons">date_range</i>
																													</span>
																												</div>
																												<div class="form-group reset_display">
																													<label for="fecha_ingreso_codeudor_dos">Fecha ingreso</label>
																													<input id="fecha_ingreso_codeudor_dos" type="date" class="form-control" name="fecha_ingreso_codeudor_dos" onkeypress="ocultar_burbujas()" onclick="ocultar_burbujas()">
																												</div>
																											</div>
																										</div> 

																									</div>

																								</div>
																							</div>
																						</div>
																					</div>

																					<div id="informacion_empresa_independiente_codeudor_dos" class="card card-nav-tabs">
																						<div class="card-header card-header-primary">
																							<div class="nav-tabs-navigation">
																								<div class="nav-tabs-wrapper">
																									<ul class="nav nav-tabs" data-tabs="tabs">
																										<li class="nav-item">
																											<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																												<i class="material-icons">face</i> Información Trabajo Independiente
																											</a>
																										</li>
																									</ul>
																								</div>
																							</div>
																						</div>
																						<div class="card-body ">
																							<div class="tab-content text-center">
																								<div class="tab-pane active" id="info_empresa_codeudor_uno">

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">business</i>
																													</span>
																												</div>
																												<input id="nombre_empresa_independiente_codeudor_dos" type="text" class="form-control" name="nombre_empresa_independiente_codeudor_dos" placeholder="Nombre de la empresa o negocio" onkeypress="ocultar_burbujas()">
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">phone</i>
																													</span>
																												</div>
																												<input id="tel_empresa_independiente_codeudor_dos" type="number" class="form-control" name="tel_empresa_independiente_codeudor_dos" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí el número telfonico de la empresa" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div> 

																									</div>

																									<div class="input-group">
																										<div class="correcion_input_forms">
																											<label for="descripcion_empresa_independiente_codeudor_dos">Descripción de Empresa</label>
																											<textarea id="descripcion_empresa_independiente_codeudor_dos" class="form-control" name="descripcion_empresa_independiente_codeudor_dos" spellcheck="true"></textarea>
																										</div>
																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">location_on</i>
																													</span>
																												</div>
																												<input id="direccion_empresa_independiente_codeudor_dos" type="text" class="form-control" name="direccion_empresa_independiente_codeudor_dos" placeholder="Dirección de la empresa" onkeypress="ocultar_burbujas()">
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span id="icon_pais_empresa_codeudor_uno" class="input-group-text">
																														<i class="material-icons">public</i>
																													</span>
																												</div>
																												<select id="pais_empresa_independiente_codeudor_dos" name="pais_empresa_independiente_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Seleccione país</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">business</i>
																													</span>
																												</div>
																												<select id='departamento_empresa_independiente_codeudor_dos' name="departamento_empresa_independiente_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Seleccione el departamento</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">home</i>
																													</span>
																												</div>
																												<select id='ciudad_empresa_independiente_codeudor_dos' name="ciudad_empresa_independiente_codeudor_dos" class="form-control" onchange="ocultar_burbujas()">
																													<option value="0" selected>Seleccione la ciudad</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div id="icon_registro_empresa_codeudor_uno" class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">attach_file</i>
																													</span>
																												</div>
																												<select id='registro_empresa_independiente_codeudor_dos' name="registro_empresa_independiente_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Registro</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div>

																										<div class="form-group col-md-6">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">attach_money</i>
																													</span>
																												</div>
																												<input id="ingresos_mensuales_independiente_codeudor_dos" type="number" class="form-control" name="ingresos_mensuales_independiente_codeudor_dos" pattern="[0-9]*{10}" placeholder="Ingresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div> 

																									</div>

																									<div class="form-row">

																										<div class="form-group col-md-12">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">attach_money</i>
																													</span>
																												</div>
																												<input id="egresos_mensuales_independiente_codeudor_dos" type="number" class="form-control" name="egresos_mensuales_independiente_codeudor_dos" pattern="[0-9]*{10}" placeholder="Egresos mensuales" title="Solo se puede llenar con números." onkeypress="ocultar_burbujas()">
																											</div>
																										</div> 

																									</div>

																								</div>
																							</div>
																						</div>
																					</div>

																					<div id="informacion_empresa_otro_codeudor_dos" class="card card-nav-tabs">
																						<div class="card-header card-header-primary">
																							<div class="nav-tabs-navigation">
																								<div class="nav-tabs-wrapper">
																									<ul class="nav nav-tabs" data-tabs="tabs">
																										<li class="nav-item">
																											<a class="nav-link active" href="#info_empresa_codeudor_uno" data-toggle="tab">
																												<i class="material-icons">face</i> Información Trabajo
																											</a>
																										</li>
																									</ul>
																								</div>
																							</div>
																						</div>
																						<div class="card-body ">
																							<div class="tab-content text-center">
																								<div class="tab-pane active" id="info_empresa_codeudor_uno">

																									<div class="form-row">

																										<div class="form-group col-md-12">
																											<div class="input-group">
																												<div class="input-group-prepend">
																													<span class="input-group-text">
																														<i class="material-icons">bar_chart</i>
																													</span>
																												</div>
																												<select id='actividad_economica_codeudor_dos' name="actividad_economica_codeudor_dos" class="form-control" onchange='estado_select_doc(); ocultar_burbujas()'>
																													<option value="0" selected>Selecciona la Actividad Económica</option>
																													<option value="1">...</option>
																												</select>
																											</div>
																										</div>

																									</div>

																									<div class="input-group">
																										<div class="correcion_input_forms">
																											<label for="descripcion_actividad_economica_codeudor_dos">Descripción de la Actividad Económica</label>
																											<textarea id="descripcion_actividad_economica_codeudor_dos" class="form-control" name="descripcion_actividad_economica_codeudor_dos" spellcheck="true"></textarea>
																										</div>
																									</div>

																								</div>
																							</div>
																						</div>
																					</div>


																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="datos_referencia">
																	<div class="card card-nav-tabs">
																		<div class="card-header card-header-primary">
																			<div class="nav-tabs-navigation">
																				<div class="nav-tabs-wrapper">
																					<ul class="nav nav-tabs" data-tabs="tabs">
																						<li class="nav-item">
																							<a class="nav-link active" href="#referencia_familiar" data-toggle="tab">
																								<i class="material-icons">group_add</i> Referencia Familiar
																							</a>
																						</li>
																						<li class="nav-item">
																							<a class="nav-link" href="#referencia_particular" data-toggle="tab">
																								<i class="material-icons">people</i> Referencia Particular
																							</a>
																						</li>
																					</ul>
																				</div>
																			</div>
																		</div>
																		<div class="card-body ">
																			<div class="tab-content text-center">
																				<div class="tab-pane active" id="referencia_familiar">
																					<h2>Referencia Familiar</h2>
																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">person</i>
																									</span>
																								</div>
																								<input id="nombres_referencia_familiar" type="text" class="form-control" name="nombres_referencia_familiar" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">create</i>
																									</span>
																								</div>
																								<input id="apellidos_referencia_familiar" type="text" class="form-control" name="apellidos_referencia_familiar" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true">
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">contact_phone</i>
																									</span>
																								</div>
																								<input id='tel_referencia_familiar' type="number" class="form-control" name="tel_referencia_familiar" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí un número alternativo" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">location_on</i>
																									</span>
																								</div>
																								<input id='dir_referencia_familiar' type="text" class="form-control" name="dir_referencia_familiar" placeholder="Ingrese aquí su dirección de residencia" onkeypress="ocultar_burbujas()">
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">public</i>
																									</span>
																								</div>
																								<select id="pais_referencia_familiar" name="pais_referencia_familiar" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione país de residencia</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div> 

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">domain</i>
																									</span>
																								</div>
																								<select id='departamento_referencia_familiar' name="departamento_referencia_familiar" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione departamento de residencia</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div>

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">home</i>
																									</span>
																								</div>
																								<select id='ciudad_referencia_familiar' name="ciudad_referencia_familiar" class="form-control" onchange="ocultar_burbujas()" >
																									<option value="0" selected>Seleccione la ciudad donde reside</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div> 

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">people</i>
																									</span>
																								</div>
																								<select id='parentesto_referencia_familiar' name="parentesto_referencia_familiar" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione su parentesco</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div>

																					</div>


																				</div>
																				<div class="tab-pane" id="referencia_particular">
																					<h2>Referencia Particular</h2>
																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">person</i>
																									</span>
																								</div>
																								<input id="nombres_referencia_particular" type="text" class="form-control" name="nombres_referencia_particular" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Nombres" spellcheck="true">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">create</i>
																									</span>
																								</div>
																								<input id="apellidos_referencia_particular" type="text" class="form-control" name="apellidos_referencia_particular" onkeypress="ocultar_burbujas()" placeholder="Ingrese aquí sus Apellidos" spellcheck="true">
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">contact_phone</i>
																									</span>
																								</div>
																								<input id='tel_referencia_particular' type="number" class="form-control" name="tel_referencia_particular" maxlength="15" minlength="7" min="0000000" max="999999999999999" pattern="[0-9]*{10}" placeholder="Ingrese aquí un número alternativo" title="Solo se puede llenar con numeros." onkeypress="ocultar_burbujas()">
																							</div>
																						</div>

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">location_on</i>
																									</span>
																								</div>
																								<input id='dir_referencia_particular' type="text" class="form-control" name="dir_referencia_particular" placeholder="Ingrese aquí su dirección de residencia" onkeypress="ocultar_burbujas()">
																							</div>
																						</div> 

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">public</i>
																									</span>
																								</div>
																								<select id="pais_referencia_particular" name="pais_referencia_particular" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione país de residencia</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div> 

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">domain</i>
																									</span>
																								</div>
																								<select id='departamento_referencia_particular' name="departamento_referencia_particular" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione departamento de residencia</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div>

																					</div>

																					<div class="form-row">

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">home</i>
																									</span>
																								</div>
																								<select id='ciudad_referencia_particular' name="ciudad_referencia_particular" class="form-control" onchange="ocultar_burbujas()" >
																									<option value="0" selected>Seleccione la ciudad donde reside</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div> 

																						<div class="form-group col-md-6">
																							<div class="input-group">
																								<div class="input-group-prepend">
																									<span class="input-group-text">
																										<i class="material-icons">people</i>
																									</span>
																								</div>
																								<select id='parentesto_referencia_particular' name="parentesto_referencia_particular" class="form-control" onchange='estado_select_pais_dep(); ocultar_burbujas()'>
																									<option value="0" selected>Seleccione su parentesco</option>
																									<option value="1">...</option>
																								</select>
																							</div>
																						</div>

																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>

															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="footer text-center">
									<input type="submit" class="btn btn-primary btn-link btn-wd btn-lg" name="ingreso_brokers" value="PUBLICAR PROPIEDAD">
								</div>

							</div>
							
						</div>

					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<script src="../libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
<script src="../libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="../libreria/theme/js/plugins/moment.min.js"></script>
<script src="../libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="../libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<script src="../libreria/theme/js/material-kit.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript" src="../java/burbuja_error.js"></script>
<script type="text/javascript" src="../java/validar_formulario_publicar_propiedad.js"></script>
<script type="text/javascript" src="../java/summernote_formulario_arrendamiento_natural.js"></script>
<script type="text/javascript" src="../java/validar_video.js"></script>
<script type="text/javascript">


	function desplegar_form_trabajo(codeudor){
		if (codeudor==1) {
			var val_select = $('#trabajo_codeudor_uno').val();
			if (val_select==1) {
				$('#informacion_empresa_codeudor_uno').fadeIn(600);
				$('#informacion_empresa_independiente_codeudor_uno').fadeOut(600);
				$('#informacion_empresa_otro_codeudor_uno').fadeOut(600);
			}else{
				if (val_select==2) {
					$('#informacion_empresa_independiente_codeudor_uno').fadeIn(600);
					$('#informacion_empresa_codeudor_uno').fadeOut(600);
					$('#informacion_empresa_otro_codeudor_uno').fadeOut(600);

				}else{
					if (val_select==3) {
						$('#informacion_empresa_otro_codeudor_uno').fadeIn(600);
						$('#informacion_empresa_codeudor_uno').fadeOut(600);
						$('#informacion_empresa_independiente_codeudor_uno').fadeOut(600);
					}else{
						$('#informacion_empresa_codeudor_uno').fadeOut(600);
						$('#informacion_empresa_independiente_codeudor_uno').fadeOut(600);
						$('#informacion_empresa_otro_codeudor_uno').fadeOut(600);
					}
				}
			}
		}else{
			if (codeudor==2) {
				var val_select = $('#trabajo_codeudor_dos').val();
				if (val_select==1) {
					$('#informacion_empresa_codeudor_dos').fadeIn(600);
					$('#informacion_empresa_independiente_codeudor_dos').fadeOut(600);
					$('#informacion_empresa_otro_codeudor_dos').fadeOut(600);
				}else{
					if (val_select==2) {
						$('#informacion_empresa_independiente_codeudor_dos').fadeIn(600);
						$('#informacion_empresa_codeudor_dos').fadeOut(600);
						$('#informacion_empresa_otro_codeudor_dos').fadeOut(600);

					}else{
						if (val_select==3) {
							$('#informacion_empresa_otro_codeudor_dos').fadeIn(600);
							$('#informacion_empresa_codeudor_dos').fadeOut(600);
							$('#informacion_empresa_independiente_codeudor_dos').fadeOut(600);
						}else{
							$('#informacion_empresa_codeudor_dos').fadeOut(600);
							$('#informacion_empresa_independiente_codeudor_dos').fadeOut(600);
							$('#informacion_empresa_otro_codeudor_dos').fadeOut(600);
						}
					}
				}
			}
		}

	}


</script>
</body>

</html>