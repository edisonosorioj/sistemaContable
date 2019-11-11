<?php 
require('./integrados/conexion/config.php');
require('./integrados/cargar_funciones.php');
if (!isset($_SESSION['doc'])) {redirigir_sesion($_SESSION['doc']);}
// echo $_SESSION['publicar_propiedad']['titulo_propiedad'];
// echo $_SESSION['publicar_propiedad']['matricula_inmobiliaria'];
// echo $_SESSION['publicar_propiedad']['descripcion_propiedad'];
// echo $_SESSION['publicar_propiedad']['direccion_propiedad'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" >
	<link rel="icon" type="image/png" href="./logo.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Publicar Propiedad
	</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
	<link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
	<link href="./estilos/general.css" rel="stylesheet" />
	<link rel="stylesheet" href="./estilos/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

	<script> $( function() { $( "#accordion" ).accordion({ heightStyle: "content" }); } ); </script>
</head>

<body class="login-page sidebar-collapse">
	<?php require('./integrados/internas/menu.php'); ?>
	<div class="header-filter" style=" background-image: url('./libreria/theme/img/city-profile.jpg'); background-size: cover; background-position: top center;position: fixed;top: 0px;left: 0px;height: 100%;width: 100%;"></div>
	<div id="contenedor_publicar_propiedad" class="page-header header-filter">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-10 ml-auto mr-auto">
					<div id="contenedor_publicar_form_propiedad" class="card card-login">
						<form  enctype="multipart/form-data" method="POST" action="./integrados/registro/propiedad" id="form_publicar_propiedad" class="form">
							<div class="card-header card-header-primary text-center">
								<h4 class="card-title">Publicar Propiedad</h4>
								<?php require('./integrados/internas/social_line.php'); ?>
							</div>
							<p class="description text-center">Por favor ingrese toda la información correctamente</p>
							<div style="margin-bottom: 60px;" class="card-body">

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">title</i>
										</span>
									</div>
									<input id="titulo_publicar_propiedad" type="text" class="form-control" name="titulo_publicar_propiedad" spellcheck="true" placeholder="Título de la propiedad: Venta, Casa Campestre, Marinilla" title="Titulo de la Propiedad" value="">
								</div>
								<small class="warning_publicar">Entre más objetivo sea el título, más probabilidades tendrás para que encuentren tu propiedad.</small>
								<div id="cont_error_titulo_publicar_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>

								<div id="accordion">
									<h3>Cargar Imágenes de la Propiedad</h3>
									<div>
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
																					<a class="nav-link active" href="#imagenes_publicar_propiedad" data-toggle="tab">
																						<i class="material-icons">add_to_photos</i> Imágenes
																					</a>
																				</li>
																				<li class="nav-item">
																					<a class="nav-link" href="#videos_publicar_propiedad" data-toggle="tab">
																						<i class="material-icons">subscriptions</i> Video
																					</a>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
																<div class="card-body ">
																	<div class="tab-content text-center">
																		<div class="tab-pane active" id="imagenes_publicar_propiedad">
																			<small>Evite subir imágenes con contenidos tales como: contenido sexual, imágenes con ropa visible en la propiedad, marcas publicitarias, animales.</small>
																			<div class="input-group">
																				<div id="contenedor_img_pub_doc" class="form-group">

																					<?php 
																					$num = 1;
																					while ($num <= 20) {

																						if ($num == 1) {
																							?>
																							<div class="input_file_img_pub_propiedad">
																								<input type="file" id="<?php echo $num; ?>" class="img_upload_img" style="z-index: 0;" name="img<?php echo $num; ?>"/>
																								<div class="contenedor_pre_img_editar_pub">
																									<img id="upload_img_prev_<?php echo $num; ?>" src="<?php echo $dominio ?>imagenes/iconos/s-cargar_img.png" class="img_upload" alt="Cargar imagen">
																								</div>
																							</div>
																							<?
																						}else{
																							?>
																							<div style="display: none;" id="input_file_img_<?php echo $num; ?>" class="input_file_img_pub_propiedad">
																								<input type="file" id="<?php echo $num; ?>" class="img_upload_img" style="z-index: 0;" name="img<?php echo $num; ?>" />
																								<div class="contenedor_pre_img_editar_pub">
																									<img id="upload_img_prev_<?php echo $num; ?>" src="<?php echo $dominio ?>imagenes/iconos/s-cargar_img.png" class="img_upload" alt="Cargar imagen">
																								</div>
																								<div class="del_img_pub_propiedad"><a href="javascript:void(0)" id="eliminar_<?php echo $num; ?>" ><img src="./imagenes/iconos/error.png"></a></div>
																							</div>
																							<?
																						}
																						$num++;
																					}
																					?>
																				</div>
																				<input id="total_imagenes" name="total_img" type="hidden" value="1">
																			</div>
																			<div id="cont_error_imagen_select" class="burbuja_alerta left_burbuja_error_der"></div>
																			<div id="desplegar_imagenes_pub_cargar"><a href="javascript:void(0)" onclick="add_img_up_prop()"><img src="./imagenes/iconos/plus.png"><p>Agregar Imagen</p></a></div>
																		</div>
																		<div class="tab-pane" id="videos_publicar_propiedad">
																			<div id="espacio_video" class="form-group"></div>
																			<div id="publicar_video_noticia_evento" class="form-group">
																				<div class="cont_img_sel_youtu_not"><img src="./imagenes/iconos/youtube.png"/></div>
																				<div class="cont_input_a_vid_not_txt">
																					<input type="text" class="form-control" id="fomr_pub_input_url_vid_doc_us" name="url_video_propiedad" placeholder="Pegue aquí la URL del video" maxlength="100">
																				</div>
																				<div class="cont_img_ayuda_sel_youtu"><a target="_blank" href="#ayuda" title="¿Qué videos puedo publicar?"><img src="./imagenes/iconos/ayuda.png"></a></div>
																			</div>
																			<small>Nota: Los videos permitidos para la publicación de la propiedad son videos provenientes de: Youtube, Facebook, Vimeo</small>
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
									<h3>Información General de la Propiedad</h3>
									<div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div style="top:22px;" class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">home</i>
														</span>
													</div>
													<select id='tipo_propiedad_publicar_propiedad' onchange="desplegar_opciones_propiedad(); desplegar_piso_propiedad(); ocultar_burbujas()" name="tipo_propiedad_publicar_propiedad" class="form-control">
														<option value="0" selected>Tipo de propiedad</option>
														<?php conectar(); echo Cargar::Tipo_Propiedad($mysqli); desconectar(); ?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend ">
														<span class="input-group-text">
															<i class="material-icons">fiber_pin</i>
														</span>
													</div>
													<input id="matricula_propiedad_publicar_propiedad" type="text" class="form-control has-danger" name="matricula_propiedad_publicar_propiedad" placeholder="Número Matrícula Inmobiliaria" value="" >
													<div id="cont_error_matricula_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
												</div>
											</div>

										</div>
										
										<div id="dpl_niveles_estrato_propiedad" class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">directions_run</i>
														</span>
													</div>
													<input id="numero_niveles_publicar_propiedad" type="number" min="0" class="form-control" name="numero_niveles_publicar_propiedad" placeholder="Numero Niveles">
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">timeline</i>
														</span>
													</div>
													<input id="estrato_publicar_propiedad" type="number" min="0" class="form-control" name="estrato_publicar_propiedad" placeholder="Estrato">
												</div>
											</div>
											<div id="cont_error_tipo_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
											<div id="cont_error_estrato_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>
										</div>

										<div id="dpl_alcobas_banos_propiedad" class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">hotel</i>
														</span>
													</div>
													<input id="numero_alcobas_publicar_propiedad" type="number" min="0" class="form-control" name="numero_alcobas_publicar_propiedad" placeholder="Numero Alcobas">
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">airline_seat_recline_normal</i>
														</span>
													</div>	
													<input id="numero_banos_publicar_propiedad" type="number" min="0" class="form-control" name="numero_banos_publicar_propiedad" placeholder="Numero Baños">
												</div>
											</div>
											<div id="cont_error_alcobas_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>								
											<div id="cont_error_banos_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>
										</div>

										<div id="dpl_cocina_piso_propiedad" class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">fastfood</i>
														</span>
													</div>
													<select id='tipo_cocina_publicar_propiedad' name="tipo_cocina_publicar_propiedad" class="form-control">
														<option value="0" selected>Tipo Cocina</option>
														<?php conectar(); echo Cargar::Tipo_Cocina($mysqli); desconectar(); ?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">view_quilt</i>
														</span>
													</div>
													<select id='tipo_piso_publicar_propiedad' name="tipo_piso_publicar_propiedad" class="form-control">
														<option value="0" selected>Tipo Piso</option>
														<?php conectar(); echo Cargar::Tipo_Piso($mysqli); desconectar(); ?>
													</select>
												</div>
											</div>

										</div>
										<div id="cont_error_cocina_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
										<div id="cont_error_piso_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>

										<div id="num_piso_propiedad" class="form-row">

											<div class="form-group col-md-12">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">filter_1</i>
														</span>
													</div>
													<input id="numero_piso_casa_apt" type="number" min="0" class="form-control" name="numero_piso_casa_apt" placeholder="Piso donde se encuentra la propiedad">
												</div>
											</div>

										</div>

										<div class="input-group">
											<div class="correcion_input_forms">
												<label for="summernotee">Descripción de la propiedad</label><br>
												<small style="position: relative;top: -6px;">Sea lo más explícito y concreto al redactar la descripción de su propiedad.</small>
												<textarea id="summernote" class="form-control" name="descripcion_publicar_propiedad" value='' spellcheck="true"></textarea>
											</div>
											<div id="cont_error_descripcion_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
										</div>	

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">public</i>
														</span>
													</div>
													<select style="top: 0px;" id="pais_cargar_departamento" name="pais_publicar_propiedad" onchange="cargar_departamento()" class="form-control custom-select">
														<option value="0" selected>Seleccione país</option>
														<?php conectar(); echo Cargar::Pais($mysqli); desconectar(); ?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">location_city</i>
														</span>
													</div>
													<select name="departamento_publicar_propiedad" id="departamento_cargar_ciudad" class="form-control" disabled onchange="cargar_ciudades()">
														<option value="0" selected>Seleccione el departamento</option>
													</select>
												</div>
											</div>
											<div id="cont_error_pais_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>								
											<div id="cont_error_provincia_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>
										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">business</i>
														</span>
													</div>
													<select id='cargar_ciudad' name="ciudad_publicar_propiedad" class="form-control" disabled onchange="cargar_sector_ciudad()">
														<option value="0" selected>Seleccione la ciudad</option>
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
													<select id='cargar_sectores' name="sector_publicar_propiedad_select" class="form-control" disabled>
														<option value="0" selected>Seleccione el sector</option>
													</select>
												</div>
											</div>
											<div id="cont_error_ciudad_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>								
											<div id="cont_error_sector_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>
										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">attach_money</i>
														</span>
													</div>
													<input id="val_arriendo_publicar_propiedad" type="number" class="form-control" min="0" name="val_arriendo_publicar_propiedad" value="<?php echo $_SESSION['publicar_propiedad']['valor_arriendo_propiedad']; ?>" placeholder="Valor Arriendo">
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">attach_money</i>
														</span>
													</div>
													<input id="val_venta_publicar_propiedad" type="number" class="form-control" min="0" name="val_venta_publicar_propiedad" value="<?php echo $_SESSION['publicar_propiedad']['valor_venta_propiedad']; ?>" placeholder="Valor Venta">
												</div>
											</div>
											<div id="cont_error_arriendo_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
											<div id="cont_error_venta_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>
										</div>

										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">add_location</i>
												</span>
											</div>
											<input id="direccion_publicar_propiedad" type="text" class="form-control" name="direccion_publicar_propiedad" value="" placeholder="Dirección de la propiedad...">
											<div id="cont_error_direccion_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
										</div>

									</div>
									<h3 id="comodidades_de_la_propiedad">Comodidades de la Propiedad</h3>
									<div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">panorama_wide_angle</i>
														</span>
													</div>
													<select id='balcon_publicar_propiedad' name="balcon_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Balcón?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">looks</i>
														</span>
													</div>
													<select id='patio_publicar_propiedad' name="patio_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Patio o Terraza?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">star</i>
														</span>
													</div>
													<select id='biblioteca_publicar_propiedad' name="biblioteca_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Biblioteca/star?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">view_carousel</i>
														</span>
													</div>
													<select id='closet_publicar_propiedad' name="closet_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Closet/Cuarto de linos?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">access_alarm</i>
														</span>
													</div>
													<select id='alarma_publicar_propiedad' name="alarma_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Alarma?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">waves</i>
														</span>
													</div>
													<select id='aire_acondicionado_publicar_propiedad' name="aire_acondicionado_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Aire acondicionado?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">border_outer</i>
														</span>
													</div>
													<select id='domotica_publicar_propiedad' name="domotica_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Dispositivo de domótica?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">bubble_chart</i>
														</span>
													</div>
													<select id='red_gas_publicar_propiedad' name="red_gas_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Red de Gas?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">local_laundry_service</i>
														</span>
													</div>
													<select id='zona_ropa_publica_propiedad' name="zona_ropa_publica_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Zona de Ropas?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">hot_tub</i>
														</span>
													</div>
													<select id='calentador_agua_publicar_propiedad' name="calentador_agua_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Calentador de agua?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

									</div>

									<h3>Información Adicional de la Propiedad</h3>
									<div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">more</i>
														</span>
													</div>
													<select id='constructora_publicar_propiedad' name="constructora_publicar_propiedad" class="form-control">
														<option value="0" selected>Constructora</option>
														<?php conectar(); echo Cargar::Constructora($mysqli); desconectar(); ?>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">location_city</i>
														</span>
													</div>
													<select id='copropiedad_publicar_propiedad' onchange="accordion_info_copropiedad()" name="copropiedad_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Pertenece a alguna Copropiedad?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>
										<div id="cont_error_niveles_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">layers</i>
														</span>
													</div>
													<input id="area_total_publicar_propiedad" type="number" class="form-control" name="area_total_publicar_propiedad" value="<?php echo $_SESSION['publicar_propiedad']['area_total_propiedad']; ?>" placeholder="Area total">
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">layers</i>
														</span>
													</div>
													<input id="area_bruta_publicar_propiedad" type="number"  class="form-control" name="area_bruta_publicar_propiedad" value="<?php echo $_SESSION['publicar_propiedad']['area_total_bruta_propiedad']; ?>" placeholder="Area bruta construida">
													<small style="position: absolute;top: 45px;left: 13%;">área bruta incluye buitrones, columnas y muros</small>
												</div>
											</div>

										</div>
										<div id="cont_error_area_total_propiedad" class="burbuja_alerta left_burbuja_error_izq"></div>
										<div id="cont_error_area_bruta_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">directions_car</i>
														</span>
													</div>
													<select id='parqueadero_publicar_propiedad' onchange="desplegar_opciones_parqueadero()" name="parqueadero_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Parqueadero?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div id="cuarto_util_parqueadero" class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">local_play</i>
														</span>
													</div>
													<select id='cuarto_util_parqueadero_select' name="cuarto_util_parqueadero_select" class="form-control">
														<option value="0" selected>¿Tiene Cuarto util?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>
										<div id="cont_error_parqueadero_propiedad" class="burbuja_alerta left_burbuja_error_der"></div>

									</div>
									<h3 id="accordion_info_copropiedad">Información Copropiedad / Unidad Residencial</h3>
									<div>
										<h4>Comodidades Copropiedad / Unidad Residencial </h4>

										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="material-icons">business</i>
												</span>
											</div>
											<select id='nombre_copropiedad_publicar_propiedad' name="nombre_copropiedad_publicar_propiedad" class="form-control">
												<option value="0" selected>Seleccione la copropiedad</option>
												<?php conectar(); echo Cargar::Copropiedad($mysqli); desconectar(); ?>										
											</select>
										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">panorama_vertical</i>
														</span>
													</div>
													<select id='ascensor_publicar_propiedad' name="ascensor_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Ascensor?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">ring_volume</i>
														</span>
													</div>
													<select id='citofono_publicar_propiedad' name="citofono_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Citófono?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">delete</i>
														</span>
													</div>
													<select id='shut_basura_publicar_propiedad' name="shut_basura_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Shut de Basura?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">airport_shuttle</i>
														</span>
													</div>
													<select id='parqueadero_visitante_publicar_propiedad' name="parqueadero_visitante_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Parqueadero para Visitantes?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">group</i>
														</span>
													</div>
													<select id='salon_social_publicar_propiedad' name="salon_social_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Salón Social?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">transfer_within_a_station</i>
														</span>
													</div>
													<select id='cancha_polideportiva_publicar_propiedad' name="cancha_polideportiva_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Cancha Polideportiva?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>	

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">whatshot</i>
														</span>
													</div>
													<select id='zona_bbq_publicar_propiedad' name="zona_bbq_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Zona BBQ?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">insert_emoticon</i>
														</span>
													</div>
													<select id='juegos_infantiles_publicar_propiedad' name="juegos_infantiles_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Juegos Infantiles?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">nature_people</i>
														</span>
													</div>
													<select id='zonas_verdes_publicar_propiedad' name="zonas_verdes_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Zonas verdes?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">directions_run</i>
														</span>
													</div>
													<select id='pista_trote_publicar_propiedad' name="pista_trote_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Pista de Trote o Senderos?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">hot_tub</i>
														</span>
													</div>
													<select id='jacuzzi_publicar_propiedad' name="jacuzzi_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Jacuzzi?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">spa</i>
														</span>
													</div>
													<select id='turco_publicar_propiedad' name="turco_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Turco?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">fitness_center</i>
														</span>
													</div>
													<select id='gim_publicar_propiedad' name="gim_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Gimnasio?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">pool</i>
														</span>
													</div>
													<select id='piscina_publicar_propiedad' name="piscina_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Piscina Climatizada?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>	

										<div class="form-row">

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">tv</i>
														</span>
													</div>
													<select id='tv_publicar_propiedad' name="tv_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Tiene Circuito Cerrado de TV?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

											<div class="form-group col-md-6">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">how_to_reg</i>
														</span>
													</div>
													<select id='porteria_publicar_propiedad' name="porteria_publicar_propiedad" onchange="horario_porteria()" class="form-control">
														<option value="0" selected>¿Tiene Portería?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>

										<!-- AGREGADO HORARIO PORTERIA -->
										<div id="horario_porteria_copropiedad" class="form-row">

											<div class="form-group col-md-12">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">access_time</i>
														</span>
													</div>
													<select id='horario_porteria_copro' name="horario_porteria_copro" class="form-control">
														<option value="0" selected>¿Horario Portería?</option>
														<option value="1">24 Horas</option>
														<option value="2">12 Horas</option>
														<option value="3">6 Horas</option>
													</select>
												</div>
											</div>

										</div>

										<div class="form-row">

											<div class="form-group col-md-12">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="material-icons">nature</i>
														</span>
													</div>
													<select id='zone_pet_publicar_propiedad' name="zone_pet_publicar_propiedad" class="form-control">
														<option value="0" selected>¿Cuenta con Zona Pet friendly?</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div>

										</div>



									</div>
								</div>

	
							</div>
							<div class="footer text-center">
								<input type="submit" class="btn btn-primary btn-wd btn-lg" name="publicar_propiedad" value="PUBLICAR PROPIEDAD">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/plugins/moment.min.js"></script>
	<script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	<script type="text/javascript" src="./java/burbuja_error.js"></script>
	<!--<script type="text/javascript" src="./java/validar_formulario_publicar_propiedad.js"></script>--> 
	<script type="text/javascript" src="./java/summernote_propiedad.js"></script>
	<script type="text/javascript" src="./java/validar_video.js"></script>
	<script src="./java/ajax_cargar_departamento.js" type="text/javascript" ></script>
    <script src="./java/ajax_cargar_ciudad.js" type="text/javascript" ></script>
    <script src="./java/ajax_cargar_sector.js" type="text/javascript" ></script>
	<script type="text/javascript">

		$("#1").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#2").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#3").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#4").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#5").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#6").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#7").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#8").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#9").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#10").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#11").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#12").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#13").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#14").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#15").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#16").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#17").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#18").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#19").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});
		$("#20").change(function(){var num_id = $(this).attr('id'); readURL(this,num_id);});

		$("#eliminar_2").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#2').val(''); $('#input_file_img_2').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_3").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#3').val(''); $('#input_file_img_3').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_4").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#4').val(''); $('#input_file_img_4').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_5").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#5').val(''); $('#input_file_img_5').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_6").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#6').val(''); $('#input_file_img_6').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_7").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#7').val(''); $('#input_file_img_7').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_8").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#8').val(''); $('#input_file_img_8').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_9").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#9').val(''); $('#input_file_img_9').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_10").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#10').val(''); $('#input_file_img_10').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_11").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#11').val(''); $('#input_file_img_11').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_12").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#12').val(''); $('#input_file_img_12').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_13").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#13').val(''); $('#input_file_img_13').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_14").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#14').val(''); $('#input_file_img_14').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_15").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#15').val(''); $('#input_file_img_15').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_16").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#16').val(''); $('#input_file_img_16').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_17").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#17').val(''); $('#input_file_img_17').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_18").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#18').val(''); $('#input_file_img_18').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_19").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#19').val(''); $('#input_file_img_19').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });
		$("#eliminar_20").click(function(){ var num_img_totales = Number($('#total_imagenes').val() - 1); $('#20').val(''); $('#input_file_img_20').css({'display':'none'}); $('#total_imagenes').val(num_img_totales); });

		function desplegar_opciones_parqueadero(){
			var parqueadero_us = $('#parqueadero_publicar_propiedad').val();
			if (parqueadero_us == 1) {
				$('#cuarto_util_parqueadero').fadeIn(600);
			}else{
				$('#cuarto_util_parqueadero').fadeOut(600);
			}
		}

		function desplegar_opciones_propiedad(){
			var tipo_propiedad = $('#tipo_propiedad_publicar_propiedad').val();
			if (tipo_propiedad != 3 && tipo_propiedad != 0 ) {
				$('#dpl_niveles_estrato_propiedad').css({'display':'flex'});
				$('#dpl_alcobas_banos_propiedad').css({'display':'flex'});
				$('#dpl_cocina_piso_propiedad').css({'display':'flex'});
				$('#comodidades_de_la_propiedad').css({'display':'flex'});
			}else{
				$('#dpl_niveles_estrato_propiedad').fadeOut(600);
				$('#dpl_alcobas_banos_propiedad').fadeOut(600);
				$('#dpl_cocina_piso_propiedad').fadeOut(600);
				$('#comodidades_de_la_propiedad').fadeOut(600);
			}
		}

		function desplegar_piso_propiedad(){
			var piso_propiedad = $('#tipo_propiedad_publicar_propiedad').val();
			if (piso_propiedad == 1 || piso_propiedad == 2 || piso_propiedad == 7 || piso_propiedad == 8 || piso_propiedad == 10) {
				$('#num_piso_propiedad').fadeIn(600);
			}else{
				$('#num_piso_propiedad').fadeOut(600);
			}
		}

		function horario_porteria(){
			var horario_porteria = $('#porteria_publicar_propiedad').val();
			if (horario_porteria == 1) {
				$('#horario_porteria_copropiedad').fadeIn(600);
			}else{
				$('#horario_porteria_copropiedad').fadeOut(600);
			}
		}

		function accordion_info_copropiedad(){
			var estado_copropiedad = $('#copropiedad_publicar_propiedad').val();
			if (estado_copropiedad == 1) {
				$('#accordion_info_copropiedad').fadeIn(600);
			}else{
				$('#accordion_info_copropiedad').fadeOut(600);
			}
		}

		function readURL(input,num) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {$('#upload_img_prev_'+num).attr('src', e.target.result);}      
				reader.readAsDataURL(input.files[0]);
			}
		}

		function add_img_up_prop(){
			var num_charge_img = Number($('#total_imagenes').val()) + 1;
			$("#upload_img_prev_"+num_charge_img+"").attr("src","./imagenes/cargando.gif");
			if (num_charge_img == 20) {$('#desplegar_imagenes_pub_cargar').fadeOut();}
			if (num_charge_img <= 20) {
				$('#input_file_img_'+num_charge_img+'').css({'display':'inline-flex'});
				$('#total_imagenes').val(num_charge_img);
			}
			$("#upload_img_prev_"+num_charge_img+"").attr("src","./imagenes/iconos/s-cargar_img.png");
		}


	</script>
</body>

</html>