<?php
fwrite($archivo, "<?php \$codigo_propiedad = '".$codigo_propiedad."'; \$val_arriendo = '".$valor_arriendo."'; \$val_venta = '".$valor_venta."'; \$copropiedad = '".$copropiedad."'; \$carpeta_propiedad = '".$nombre_carpeta."'; ?>
<?php require('../../integrados/conexion/config.php'); ?>
<?php require('../../integrados/consultas.php'); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='utf-8' />
	<link rel='icon' type='image/png' href='../../logo.ico'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<title>".$titulo."</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons' />
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css'>
	<link href='../../libreria/theme/css/material-kit.css' rel='stylesheet' />
	<link href='../../libreria/theme/demo/demo.css' rel='stylesheet' />
	<link href='../../estilos/general.css' rel='stylesheet' />
	<link rel='stylesheet' href='../../libreria/swiper/dist/css/swiper.min.css'>
	<script src='https://code.jquery.com/jquery-1.12.4.js'></script>
</head>

<body class='login-page sidebar-collapse'>
	<?php require('../../integrados/internas/menu.php'); ?>
	<div class='header-filter' id='fondo_plantilla_propiedades'></div>
	<div style='height: auto;' class='page-header header-filter'>
		<div class='container'>
			<div class='row'>
				<div class='col-lg-12 col-md-12 ml-auto mr-auto'>
					<div id='formulario_contacto_us' class='card card-login'>            
						<div class='card-header card-header-primary text-center'>
							<h4 class='card-title'>".$nombre_ciudad." - ".$nombre_provincia."</h4>
							<?php require('../../integrados/internas/social_line.php'); ?>
						</div>
						<div id='contenedor_propiedad_publicada' class='card-body'>

							<div class='form-row'>

								<div class='form-group col-md-6'>
									<div class='input-group'>
										<h2>".$titulo."</h2>
									</div>
								</div>

								<div class='form-group col-md-6'>
									<div class='input-group'>
										<h2 id='codigo_propiedad_dpl'>CÓDIGO: ".$codigo_propiedad."</h2>
									</div>
								</div>

							</div>

							<div id='contenedor_slide_swiper_propiedad'>
								<div class='swiper-container gallery-top'>
									<div class='swiper-wrapper'>
									    <?php require('../../integrados/propiedad/cargar_imagenes_grandes.php'); ?>
									</div>
									<div class='swiper-button-next swiper-button-blue'></div>
									<div class='swiper-button-prev swiper-button-blue'></div>
								</div>
								<div class='swiper-container gallery-thumbs'>
									<div class='swiper-wrapper'>
									    <?php require('../../integrados/propiedad/cargar_imagenes_thumbs.php'); ?>
									</div>
								</div>
							</div>

							<div class='form-row'>

								<div class='form-group col-md-9'>
									<div class='input-group'>

										<div class='form-group col-md-6'>
											<div class='input-group'>
												<h3 class='orange_txt bold_txt'>".$tipo_propiedad."</h3>
											</div>
										</div>

										<div class='form-group col-md-6'>
											<div class='input-group'>
												<?php require('../../integrados/propiedad/cargar_valores_propiedad.php'); ?>
											</div>
										</div>

									</div>

									<div style='margin:0px;padding: 0px;' class='input-group'>

										<div class='form-group col-md-12'>
											<div class='input-group'>
												<h4 class='box_subtitulos_txt'>Descripcion</h4><br>
												<p class='box_txtdescriptiv_prop'>".$descripcion."</p>
											</div>
										</div>

										<div class='form-group col-md-12'>
											<div class='input-group'>
												<h4 class='box_subtitulos_txt'>Localización , caracteristicas y áreas</h4><br>
												    <table id='table_prop_pub'>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>public</i><p>País :</p></td>
												    		<td class='txt_col_2_table'>".$nombre_pais."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>location_city</i><p>Departamento ó Provincia :</p></td>
												    		<td class='txt_col_2_table'>".$nombre_provincia."</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>domain</i><p>Ciudad o municipio :</p></td>
												    		<td class='txt_col_2_table'>".$nombre_ciudad."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>home</i><p>Sector o barrio :</p></td>
												    		<td class='txt_col_2_table'>".$sector_barrio."</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>poll</i><p>Estrato :</p></td>
												    		<td class='txt_col_2_table'>".$estrato."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>attach_money</i><p>Valor Administración :</p></td>
												    		<td class='txt_col_2_table'>$0</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>fullscreen</i><p>Area total :</p></td>
												    		<td class='txt_col_2_table'>".$area_total." M2. aproximadamente</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>fullscreen</i><p>Area bruta construida :</p></td>
												    		<td class='txt_col_2_table'>".$area_construida." M2. aproximadamente<br><small>área bruta incluye buitrones, columnas y muros</small></td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>layers</i><p>Número de niveles :</p></td>
												    		<td class='txt_col_2_table'>".$numero_niveles."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>filter_1</i><p>Número Piso :</p></td>
												    		<td class='txt_col_2_table'>".$numero_piso."</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>meeting_room</i><p>Alcobas familiares :</p></td>
												    		<td class='txt_col_2_table'>".$numero_alcoba."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>wc</i><p>Baños familiares :</p></td>
												    		<td class='txt_col_2_table'>".$numero_bano."</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>kitchen</i><p>Tipo de cocina :</p></td>
												    		<td class='txt_col_2_table'>".$tipo_cocina."</td>
												    	</tr>
												    	<tr>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>apps</i><p>Tipo de pisos :</p></td>
												    		<td class='txt_col_2_table'>".$tipo_piso."</td>
												    	</tr>
												    	<tr class='impar_color'>
												    		<td class='orange_txt bold_txt td_flex'><i id='icon_table_prop_pub' class='material-icons'>drive_eta</i><p>Parqueaderos :</p></td>
												    		<td class='txt_col_2_table'>".$txt_parqueadero."</td>
												    	</tr>
												    	
												    </table>

												    <a class='button_adquirir_prop' href=''><div>ARRENDAR PROPIEDAD</div></a>

											</div>
										</div>

									</div>

								</div>

								<div class='form-group col-md-3'>
									<div class='input-group'>
										<a class='button_adquirir_prop' href=''><div>ARRENDAR PROPIEDAD</div></a>
										<h6 class='box_subtitulos_txt'>Comodidades del inmueble</h6>
										<ul id='comodidades_propiedad_lat'>
										    <?php require('../../integrados/propiedad/cargar_comodidades_propiedad.php'); ?>
											<li><i id='icon_table_prop_pub' class='material-icons'>panorama_wide_angle</i><p>Balcón</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>looks</i><p>Patio</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>star</i><p>Biblioteca/star</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>view_carousel</i><p>Closet/Cuarto de linos</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>access_alarm</i><p>Alarma</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>waves</i><p>Aire acondicionado</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>border_outer</i><p>Dispositivo de domotica</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>bubble_chart</i><p>Red de Gas</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>local_laundry_service</i><p>Zona de Ropas</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>hot_tub</i><p> Calentador de agua</p></li>
										</ul>
										<h6 class='box_subtitulos_txt'>Comodidades de la Copropiedad/Unidad residencial</h6>
										<ul id='comodidades_copropiedad_lat'>
										    <?php require('../../integrados/propiedad/cargar_comodidades_copropiedad.php'); ?>
											<li><i id='icon_table_prop_pub' class='material-icons'>panorama_vertical</i><p>Ascensor</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>ring_volume</i><p>Citofono</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>delete</i><p>Shut de Basura</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>airport_shuttle</i><p>Parqueadero para Visitantes</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>group</i><p>Salón Social</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>transfer_within_a_station</i><p>Cancha Polideportiva</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>whatshot</i><p>Zona BBQ</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>insert_emoticon</i><p>Juegos Infantiles</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>nature_people</i><p>Zonas verdes</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>nature</i><p>Zona Pet friendly</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>directions_run</i><p>Pista de Trote o Senderos</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>hot_tub</i><p>Jacuzzi</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>spa</i><p>Turco</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>pool</i><p>Piscina Climatizada</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>tv</i><p>Circuito Cerrado de TV</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>how_to_reg</i><p>Porteria</p></li>
											<li><i id='icon_table_prop_pub' class='material-icons'>access_time</i><p>Horario Porteria</p></li>
										</ul>
									</div>
								</div>

							</div>

						</div>

					</div>
				</div>
			</div>
		</div>

		<div id='altura_ventana'></div>
		<a style='text-decoration: none;' href='javascript:void(0)' onclick='desplazar_pagina_arriba()'><div id='button_up_pag'><img src='<?php echo \$dominio; ?>imagenes/iconos/page_up.png'></div></a>

	</div>

	<script src='../../libreria/theme/js/core/popper.min.js' type='text/javascript'></script>
	<script src='../../libreria/theme/js/core/bootstrap-material-design.min.js' type='text/javascript'></script>
	<script src='../../libreria/theme/js/plugins/moment.min.js'></script>
	<script src='../../libreria/theme/js/plugins/nouislider.min.js' type='text/javascript'></script>
	<script src='../../libreria/theme/js/plugins/jquery.sharrre.js' type='text/javascript'></script>
	<script src='../../libreria/theme/js/material-kit.js' type='text/javascript'></script>
	<script type='text/javascript' src='../../java/page_up.js'></script>
	<script type='text/javascript' src='../../java/menu.js'></script>
	<script src='../../libreria/swiper/dist/js/swiper.js'></script>
	<!-- Initialize Swiper -->
	<script>
		var galleryTop = new Swiper('.gallery-top', {
			spaceBetween: 10,
			loop:true,
			autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      loopedSlides: 5, //looped slides should be the same
      navigation: {
      	nextEl: '.swiper-button-next',
      	prevEl: '.swiper-button-prev',
      },
  });
		var galleryThumbs = new Swiper('.gallery-thumbs', {
			spaceBetween: 10,
			slidesPerView: 4,
			touchRatio: 0.2,
			loop: true,
      loopedSlides: 5, //looped slides should be the same
      slideToClickedSlide: true,
  });
		galleryTop.controller.control = galleryThumbs;
		galleryThumbs.controller.control = galleryTop;

	</script>

</body>

</html>
");
      fclose($archivo);
?>