<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="./logo.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Collage</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
	<link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
	<link href="./estilos/general.css" rel="stylesheet" />
	<link rel="stylesheet" href="./libreria/swiper/dist/css/swiper.min.css">
</head>
<body class="login-page sidebar-collapse">
	<?php require('./integrados/internas/menu.php'); ?>
	<div class="page-header header-filter" style="background-image: url('./libreria/theme/img/city-night-profile.jpg'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 ml-auto mr-auto">
					<div class="card card-login">
						<div class="card-body">

							<div class="form-row">

								<div class="form-group col-md-4">
									<div class="input-group">
										
										<div class="card card-nav-tabs">
											<div id="reset_header_card_collage" class="card-header card-header-primary">
												<div class="nav-tabs-navigation">
													<div class="nav-tabs-wrapper">
														<ul class="nav nav-tabs" data-tabs="tabs">															
															<div class="form-row">
																<div class="form-group col-md-3">
																	<li class="nav-item">
																		<a id="reset_nav_link_img" class="nav-link" href="#profile" data-toggle="tab">
																			<img id="reset_circle_img_collage" src="https://www.brokersfast.com.co/material-kit-html-v2.0.4/assets/img/faces/avatar.jpg" title="Nombre perfil" class="img-raised rounded-circle img-fluid">
																		</a>
																	</li>
																</div>
																<div class="form-group col-md-9">
																	<li class="nav-item">
																		<a id="reset_nav_link_titu" class="nav-link active" href="#info_propiedad" data-toggle="tab">
																			<i class="material-icons">home</i> Apartamento en arriendo Vereda Fontibon Rionegro
																		</a>
																	</li>
																</div>
															</div>
														</ul>
													</div>
												</div>
											</div>
											<div id="reset_card_body_collage" class="card-body ">
												<div class="tab-content text-center">
													<div class="tab-pane active" id="info_propiedad">

														<div class="info_propiedad_resumen"><i class="material-icons">public</i><p>Rionegro - Antioquia</p></div>
														
														<div class="contenedor_swipe_img">
															<div class="swiper-container">
																<div class="swiper-wrapper">
																	<div class="swiper-slide"><img src="http://brokerssoluciones.com/Fotosh/578990_13.jpg" alt="Raised Image" class="img-raised rounded img-fluid"></div>
																	<div class="swiper-slide"><img src="http://brokerssoluciones.com/Fotosh/578990_15.jpg" alt="Raised Image" class="img-raised rounded img-fluid"></div>
																	<div class="swiper-slide"><img src="http://brokerssoluciones.com/Fotosh/578990_14.jpg" alt="Raised Image" class="img-raised rounded img-fluid"></div>
																</div>
																<div class="swiper-pagination"></div>
															</div>															
														</div>

														<div class="info_propiedad_resumen"><i class="material-icons">location_city</i><p>APARTAMENTO EN ARRIENDO $850,000</p></div>
														<div class="descripcion_propiedad_resum">Apartamento de 65 m2 para estrenar en unidad cerrada.<a class="button_mas_propiedad" href="#link" title="Ver más información">VER MAS</a></div>

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

		<?php require('./integrados/internas/foot.php'); ?>
	</div>
	<script src="./libreria/theme/js/core/jquery.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/plugins/moment.min.js"></script>
	<script src="./libreria/theme/js/plugins/nouislider.min.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
	<script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>

	<script src="./libreria/swiper/dist/js/swiper.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper-container', {
			direction: 'vertical',
			slidesPerView: 1,
			spaceBetween: 30,
			mousewheel: true,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		});
	</script>

</body>

</html>