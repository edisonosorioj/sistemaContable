<?php 
require('integrados/conexion/config.php');
require('integrados/consultas.php');

// Obtiene el ID enviado desde index.php para visualizar los productos solicitados
$tipo_propiedad = $_GET['tipo_propiedad'];
$cod_pais = $_GET['cod_pais'];
$cod_provincia = $_GET['cod_provincia'];
$cod_ciudad = $_GET['cod_ciudad'];

conectar();

$array_cons = Consulta::Con_Propiedad($mysqli, $cod_ciudad);
$count = 2;
$count_array = count($array_cons);
$imagenes = '';
$propiedad = '';

// Construye la vista de las propiedasdes segun la busqueda solicitada 
while ($count <= $count_array) {
	$nombre_propiedad = $array_cons[$count][0];
	$nombre_ciudad = $array_cons[$count][1];
	$nombre_departamento = $array_cons[$count][2];
	$valor_arriendo = number_format($array_cons[$count][3], 0, ',', '.');
	$valor_venta = number_format($array_cons[$count][4], 0, ',', '.');
	$descripcion = $array_cons[$count][5];
	$cod_propiedad = $array_cons[$count][6];
	$nombre_carpeta = $array_cons[$count][7];

//Condiciona si aparece o no venta y compra de propiedades.
	if ($array_cons[$count][3] > 0) {
		$arriendo = '<div class="info_propiedad_resumen"><i class="material-icons">location_city</i><p>VALOR EN ARRIENDO $ ' . $valor_arriendo . '</p></div>';
	}else{
		$arriendo = '<div class="info_propiedad_resumen"><i class="material-icons">location_city</i><p>NO DISPONIBLE PARA ARRIENDO</p></div>';		
	}

	if ($array_cons[$count][4] > 0) {
		$venta = '<div class="info_propiedad_resumen"><i class="material-icons">location_city</i><p>VALOR EN VENTA $ ' . $valor_venta . '</p></div>';
	}else{
		$venta = '<div class="info_propiedad_resumen"><i class="material-icons">location_city</i><p>NO ESTA A LA VENTA</p></div>';
	}

	//Llama a la funcion que trae las imagenes en un array desde consultas.php
	$array_img = Consulta::Imagenes_Propiedad($mysqli, $cod_propiedad);
	$count2 = 0;
	$count_array_imag = count($array_img);

	//Construye un array con las imagenes de la propiedad relacionadas en la base de datos.
	while ($count2 < $count_array_imag ) { 
		$imagenes .= '<div class="swiper-slide"><img src="https://www.brokersfast.com.co/propiedad/' . $nombre_carpeta . '/imagenes/' . $array_img[$count2] . '" alt="Raised Image" class="img-raised rounded img-fluid"></div>';
	 	$count2++;
	 }

	$propiedad .= '<div class="form-group col-md-4">
		<div class="input-group">
			<div class="card card-nav-tabs">
				<div id="reset_header_card_collage" class="card-header card-header-primary">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
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
											<a href="#" id="titulo_resultado_propiedad" class="nav-link active" data-toggle="tab" target="_blank">
												<i class="material-icons">home</i>' . $nombre_propiedad . '
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
							<div class="info_propiedad_resumen"><i class="material-icons">public</i><p>' . $nombre_ciudad . ' - ' . $nombre_departamento . '</p></div>
							<div class="contenedor_swipe_img">
								<div class="swiper-container">
									<div class="swiper-wrapper">
									' . $imagenes . '
									</div>
									<div class="swiper-pagination"></div>
								</div>															
							</div>

							' . $arriendo . '
							' . $venta . '
							<div class="descripcion_propiedad_resum">' . substr($descripcion, 0, 70) . '...<a class="button_mas_propiedad" href="https://www.brokersfast.com.co/propiedad/ejemplo/propiedad.php?id=' . $cod_propiedad . '" title="Ver más información">VER MAS</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';

	$count++;
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="./logo.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Resultado Propiedades</title>
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
			<div class="row" id="row_resultado_propiedad">
				<div class="col-lg-12 col-md-12 ml-auto mr-auto">
					<div class="card card-login">
						<div class="card-body">

							<div class="form-row">

								<?php echo $propiedad ?>

						</div>
					</div>
				</div>
			</div>
		</div>

		<?php //require('./integrados/internas/foot.php'); ?>
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