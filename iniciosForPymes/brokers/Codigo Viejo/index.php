<?php 
require('./integrados/conexion/config.php'); 
/*require('./integrados/funciones/funciones_consultas.php');*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./libreria/theme/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./logo.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Brokers
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="./libreria/theme/css/material-kit.css" rel="stylesheet" />
  <link href="./libreria/theme/demo/demo.css" rel="stylesheet" />
  <link href="./libreria/swiper/dist/css/swiper.min.css" rel="stylesheet" />
  <link href="./estilos/general.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">

    <!-- MENU SUPERIROR DE NAVEGACION -->
    <?php require('./integrados/internas/menu.php'); ?>

    <div class="page-header header-filter clear-filter purple-filter" data-parallax="true" >
        
      <!-- SLIDE DE IMAGENES PANTALLA INICIO -->
      <div id="contenedor_slide_swiper_index">
         <!-- Swiper -->
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <!-- Required swiper-lazy class and image source specified in data-src attribute -->
              <img data-src="https://i.ytimg.com/vi/36bJ-ON_JPo/maxresdefault.jpg" class="swiper-lazy">
              <!-- Preloader image -->
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>
            <div class="swiper-slide">
              <img data-src="https://i.ytimg.com/vi/DROgTYmqN1E/maxresdefault.jpg" class="swiper-lazy">
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>
            <div class="swiper-slide">
              <img data-src="http://clasificados.colcampestre.com/2536/alquiler-casa-campestre-ccp238-condominio-campestre-el-penon-girardot.jpg" class="swiper-lazy">
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>
            <div class="swiper-slide">
              <img data-src="https://s-media-cache-ak0.pinimg.com/originals/61/5f/34/615f3449bfae5878c78b2b3067a41675.jpg" class="swiper-lazy">
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>
            <div class="swiper-slide">
              <img data-src="http://www.playalobos.cl/images/slides/slide1.jpg" class="swiper-lazy">
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>
            <div class="swiper-slide">
              <img data-src="http://www.capital.com.pa/wp-content/uploads/2013/05/casas-americanas-modernas3.jpg" class="swiper-lazy">
              <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">
            <div class="brand">
              <!-- FORMULARIO PARA REALIZAR BUSQUEDA DE PROPIEDADES -->
              <form id="form_buscar_propiedad_index" method="GET" action='resultado_propiedad.php'>
                 <div class="row">

                   <div class="col-lg-1 col-sm-1">
                   </div>

                   <div class="col-lg-2 col-sm-2">
                    <div class="form-group">
                      <div id="select_form_srh_index" class="input-group">                      
                          <select class="form-control" name="tipo_propiedad" id="select_propiedad_buscar_index">
                            <option>Seleccione una opción</option>
                            <option>Arriendos</option>
                            <option>Ventas</option>
                            <option>Lotes</option>
                            <option>Proyectos</option>
                          </select>
                      </div>
                    </div>
                   </div>
                   
                   <div class="col-lg-2 col-sm-2">
                    <div class="form-group">
                      <div id="select_form_srh_index" class="input-group">                      
                          <select style="top: 0px;" name="cod_pais" class="form-control" id="pais_cargar_departamento" onchange="cargar_departamento()">
                            <option value="0">Seleccione País</option>
                              <option value="1">Colombia</option>
                          </select>
                      </div>
                    </div>
                   </div>

                   <div class="col-lg-3 col-sm-3">
                    <div class="form-group">
                      <div id="select_form_srh_index" class="input-group">                      
                          <select class="form-control" name="cod_provincia" id="departamento_cargar_ciudad" disabled onchange="cargar_ciudades()">
                              <option value="0" selected>Seleccione Departamento</option>
                          </select>
                      </div>
                    </div>
                   </div>

                   <div style="display: inline-flex;" class="col-lg-3 col-sm-3">
                    <div class="form-group">
                      <div id="select_form_srh_index" class="input-group">          
                          <select class="form-control" name="cod_ciudad" id="cargar_ciudad" disabled>
                              <option value="0" selected>Seleccione una Ciudad</option>
                          </select>
                      </div>
                    </div>
                    <button style="top: 15px; margin-left: 15px;" type="submit" class="btn btn-white btn-raised btn-fab btn-round">
                      <i class="material-icons">search</i>
                    </button>
                   </div>

                 </div>
              </form>

            <!-- SLIDE DE TEXTO PANTALLA INICIO -->
            <div id="contenedor_slide_text_index">
               <!-- Swiper -->
              <div class="swiper-container_b">
                <div class="swiper-wrapper">
                  <div class="swiper-slide"><p>OLVIDATE DE LAS INTERMEDIACIONES</p><small class="txt_subslide_index">SIMPLE + EFICIENTE + FACIL</small></div>
                  <div class="swiper-slide"><p>CONSIGUE LA CASA IDEAL PARA TI</p><small class="txt_subslide_index">ARRIENDOS + VENTAS + LOTES</small></div>
                  <div class="swiper-slide"><p>ADMINISTRA TU PROPIEDAD FACILMENTE</p><small class="txt_subslide_index">PUBLICA + VERIFICA ESTADO DE LA PROPIEDAD + DINERO AL INSTANTE </small></div>
                </div>
              </div>
              </div>
            </div>
            </div>
          </div>
        </div>

    </div>

  <div class="main main-raised">
    <div class="section section-basic">
      <div class="container">
          <!-- SECCION DE INFORMACION DE LOS SERVICIOS -->
          <section id="pantalla_c">
              <div class="row">
                  <div class="colm_index col-md-3 col-lg-12">
                      <div class="row">
                          <div class="titulos_secciones_index block">PROPIEDADES DESTACADAS</div>
                          <div class="block col-md-3 col-lg-4" data-move-y="400px" data-move-x="-200px">
                              
                              <!-- Tabs with icons on Card -->
                              <div class="card card-nav-tabs">
                                <div class="card-header card-header-primary">
                                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                  <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                    	<a href="#">
                                     		<h3 style="color: black; font-weight: 500; text-align: center;">Casa Finca - Marinilla</h3>
											<img src="/propiedad/propiedades_destacadas/foto01.jpeg" alt="" width="300 px">
										</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Tabs with icons on Card -->
                                               
                          </div>
                          <div class="block col-md-3 col-lg-4" data-move-y="400px" data-move-x="100px">
                            
                              <div class="card card-nav-tabs">
                                <div class="card-header card-header-primary">
                                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                  <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                    	<a href="#">
	                                     	<h3 style="color: black; font-weight: 500; text-align: center;">Casa Finca - La Ceja</h3>
											<img src="/propiedad/propiedades_destacadas/foto02.jpeg" alt="" width="300 px">
									 	</a>	
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Tabs with icons on Card -->

                          </div>
                          <div class="block col-md-3 col-lg-4" data-move-y="400px" data-move-x="200px">
                    
                              <div class="card card-nav-tabs">
                                <div class="card-header card-header-primary">
                                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                                  <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper">
                                    	<a href="#">
                                     		<h3 style="color: black; font-weight: 500; text-align: center;">Casa Finca - Rionegro</h3>
											<img src="/propiedad/propiedades_destacadas/foto03.jpeg" alt="" width="300 px">
										</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Tabs with icons on Card -->
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
    </div>
  </div>

<!-- BOTON SUBIR NAVEGACION -->
<div id="altura_ventana"></div>
<a style="text-decoration: none;" href="javascript:void(0)" onclick="desplazar_pagina_arriba()"><div id="button_up_pag"><img src="<?php echo $dominio; ?>imagenes/iconos/page_up.png"></div></a>

<!-- FOOT DE LA PAGINA -->
<?php require('./integrados/internas/foot.php'); ?>
  
</body>
</html>

<script src="./libreria/theme/js/core/jquery.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/core/popper.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="./libreria/theme/js/plugins/moment.min.js"></script>
<script src="./libreria/theme/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
<script src="./libreria/theme/js/material-kit.js" type="text/javascript"></script>
<script src="./libreria/swiper/dist/js/swiper.min.js"></script>
<script src="./libreria/jquery_smoove/dist/jquery.smoove.js"></script>
<script src="./java/page_up.js" type="text/javascript" ></script>
<script src="./java/ajax_cargar_departamento.js" type="text/javascript" ></script>
<script src="./java/ajax_cargar_ciudad.js" type="text/javascript" ></script>



<script> function scrollToDownload() { if ($('.main-raised').length != 0) { $("html, body").animate({ scrollTop: $('.main-raised').offset().top }, 1000); } } </script>
<script>$('.block').smoove({offset:'40%'});</script>
<script>  var swiper = new Swiper('.swiper-container', { lazy: true, loop: true, keyboard: { enabled: true, }, autoplay: { delay: 4500, disableOnInteraction: false, }, }); var swiper_b = new Swiper('.swiper-container_b', { keyboard: { enabled: true, }, autoplay: { delay: 4500, disableOnInteraction: false, }, }); </script>