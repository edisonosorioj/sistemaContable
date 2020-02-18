<?php 
require_once "php/conexion.php";

$conex = new conection();
$result = $conex->conex();

// ID que viene desde el enlace
$id = $_GET['id'];

// Consulta y por medio de un while muestra la lista de las propiedades

$query  = mysqli_query($result,"SELECT p.nombre as nombre_propiedad, z.nombre as nombre_ciudad, z.id as id_zona FROM propiedad p INNER JOIN zonas z ON p.zona = z.id WHERE p.id = $id;");
$row    = $query->fetch_assoc();

$nombre_propiedad = $row['nombre_propiedad'];

$directory= 'images/manantiales/';
$dirint   = dir($directory);
$img      = '';
$img2     = '';
$count    = 0;
$ciudad   = $row['nombre_ciudad'];
$id_zona  = $row['id_zona'];

$query2  = mysqli_query($result,"SELECT z1.nombre as nombre_departamento FROM zonas z INNER JOIN zonas z1 ON z.zona_padre = z1.id WHERE z.id = $id_zona;");
$row2    = $query2->fetch_assoc();

$departamento   = $row2['nombre_departamento'];

while (($archivo = $dirint->read()) !== false)
{
    if (preg_match("/gif/", $archivo) || preg_match("/jpg/", $archivo) || preg_match("/png/", $archivo)){
      $active = ($archivo == '01.jpg')?'active':'';
      $image = $directory . '/' . $archivo;
      $img .= "<div class='carousel-item ".$active."'>
                <img class='d-block w-100' src='" . $image . "' style='width:800px !important; display:block;
                margin:auto;'>
              </div>";

      $img2 .= "<li data-target='#carousel-thumb' data-slide-to='" . $count . "' class='" . $active . "'>
                  <img class='d-block mt-5' src='" . $image . "'>
                </li>";

      $count=$count+1;
    }
}
$dirint->close();


$html = "<!DOCTYPE html>
<html lang='es'>
  <head>
    <title>Brokers Fast</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    
    <link rel='icon' href='images/favicon.ico' >

    <link rel='stylesheet' href='css/open-iconic-bootstrap.min.css'>
    <link rel='stylesheet' href='css/animate.css'>
    
    <link rel='stylesheet' href='css/owl.carousel.min.css'>
    <link rel='stylesheet' href='css/owl.theme.default.min.css'>
    <link rel='stylesheet' href='css/magnific-popup.css'>

    <link rel='stylesheet' href='css/aos.css'>

    <link rel='stylesheet' href='css/ionicons.min.css'>

    <link rel='stylesheet' href='css/bootstrap-datepicker.css'>
    <link rel='stylesheet' href='css/jquery.timepicker.css'>

    
    <link rel='stylesheet' href='css/flaticon.css'>
    <link rel='stylesheet' href='css/icomoon.css'>
    <link rel='stylesheet' href='css/style.css'>
    <link rel='stylesheet' href='css/styles.css'>
    <style>
    .btn-whatsapp {
           display:block;
           width:70px;
           height:70px;
           color:#fff;
           position: fixed;
           right:20px;
           bottom:20px;
           border-radius:50%;
           line-height:80px;
           text-align:center;
           z-index:999;
    }
  </style>
  <script type='text/javascript'>
    var URLactual = window.location.href;
  </script>
  </head>
  <body>
    
	  <nav class='navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light' id='ftco-navbar'>
	    <div class='container'>
	      <a class='navbar-brand' href='index.html'><img src='images/logo.png'></a>
	      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#ftco-nav' aria-controls='ftco-nav' aria-expanded='false' aria-label='Toggle navigation'>
	        <span class='oi oi-menu'></span> Menu
	      </button>

	      <div class='collapse navbar-collapse' id='ftco-nav'>
	        <ul class='navbar-nav ml-auto'>
	          <li class='nav-item'><a href='index.html' class='nav-link'>Brokers</a></li>
	          <li class='nav-item'><a href='empresa.html' class='nav-link'>Quienes Somos</a></li>
            <li class='nav-item'><a href='contacto.html' class='nav-link'>Contácto</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class='btn-whatsapp'>
      <a href='https://api.whatsapp.com/send?phone=573004004272&text=Hola!%20Te%20contácto%20desde%20tu%20página%20web.%20Me%20gustaría%20más%20información' target='_blank'>
        <img src='http://s2.accesoperu.com/logos/btn_whatsapp.png' alt=''>
      </a>
    </div>

    <section class='hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight' style='background-image: url(\"images/bg_1.jpg\");height: 300px !important;' data-stellar-background-ratio='0.5'>
      <div class='overlay'></div>
      <div class='container'>
        <div class='row no-gutters slider-text js-fullheight align-items-center justify-content-center'>
          <div class='col-md-9 ftco-animate pb-5 text-center'>
            <p class='breadcrumbs'><span class='mr-2'><a href='index.html'>Inicio <i class='ion-ios-arrow-forward'></i></a></span> <span>Propiedades <i class='ion-ios-arrow-forward'></i></span></p>
            <h1 class='mb-3 bread'>" . $nombre_propiedad . "</h1>
          </div>
        </div>
      </div>
    </section>

    <section class='mt-5'>
      <div class='container'>


        <div class='row justify-content-center'>
          <div class='col-md-8 mt-5'>

            <!--Carousel Wrapper-->
            <div id='carousel-thumb' class='carousel slide carousel-fade carousel-thumbnails' data-ride='carousel'>
              <!--Slides-->
              <div class='carousel-inner' role='listbox'>
                " . $img . "
              </div>
              <!--/.Slides-->
              <!--Controls-->
              <a class='carousel-control-prev' href='#carousel-thumb' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
              </a>
              <a class='carousel-control-next' href='#carousel-thumb' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
              </a>
              <!--/.Controls-->

              <ol class='carousel-indicators'>
                " . $img2 . "
              </ol>
            </div>
            <!--/.Carousel Wrapper-->

            <div class='property-details'>
              <div class='mb-5'></div>
              <div class='text text-center'>
                <span class='subheading'>$ciudad - $departamento</span>
                <h2>$nombre_propiedad</h2>
              </div>
            </div>
          </div>
        </div>

        <div class='row'>
          <div class='col-md-12 pills'>
            <div class='bd-example bd-example-tabs'>
              <div class='d-flex justify-content-center'>
                <ul class='nav nav-pills mb-3' id='pills-tab' role='tablist'>

                  <li class='nav-item'>
                    <a class='nav-link active' id='pills-description-tab' data-toggle='pill' href='#pills-description' role='tab' aria-controls='pills-description' aria-expanded='true'>Especificaciones</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' id='pills-manufacturer-tab' data-toggle='pill' href='#pills-manufacturer' role='tab' aria-controls='pills-manufacturer' aria-expanded='true'>Descripciones</a>
                  </li>
                </ul>
              </div>

              <div class='tab-content' id='pills-tabContent'>
                <div class='tab-pane fade show active' id='pills-description' role='tabpanel' aria-labelledby='pills-description-tab'>
                  <div class='row'>
                    <div class='col-md-6'>
                      <ul class='features'>
                        <li class='check'><span class='ion-ios-checkmark'></span>Áreas desde: 67 Mts2</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Barrio la Alameda</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Edificio de Propiedad Horizontal</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Parqueadero Común</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Portería de 24 horas</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Unidad Cerrada</li>
                      </ul>
                    </div>
                    <div class='col-md-6'>
                      <ul class='features'>
                        <li class='check'><span class='ion-ios-checkmark'></span>Primer Piso</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Balcón</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>2 Habitaciones</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>2 Baños</li>
                        <li class='check'><span class='ion-ios-checkmark'></span>Calentador de Agua a Gas</li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class='tab-pane fade' id='pills-manufacturer' role='tabpanel' aria-labelledby='pills-manufacturer-tab'>
                  <p>En Marinilla, apartamento ubicado en el barrio la Alameda. Propiedad con 67m2 con 3 habitaciones, 2 baños, sala, comedor, balcón, zona de ropas, en edificio de propiedad horizontal. Parqueadero común, portería 24 horas.</p>
                </div>

               
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class='ftco-footer ftco-section'>
      <div class='container'>
        <div class='row mb-5'>

          <div class='col-md'>
            <div class='ftco-footer-widget mb-4'>
              <h2 class='ftco-heading-2'>Brokers Soluciones</h2>
              <p>El camino a tener casa propia está cada vez mas cerca. Nosotros te ayudamos alcanzarlo. Siguenos en nuestras redes sociales y enamorate con nuestras ofertas!!</p>
              <ul class='ftco-footer-social list-unstyled mt-5'>
                <li class='ftco-animate'><a href='#'><span class='icon-twitter'></span></a></li>
                <li class='ftco-animate'><a href='https://www.facebook.com/Brokersfast/'><span class='icon-facebook'></span></a></li>
                <li class='ftco-animate'><a href='https://www.instagram.com/brokers_co/'><span class='icon-instagram'></span></a></li>
                <li class='ftco-animate'><a href='#'><span class='icon-youtube'></span></a></li>
              </ul>
            </div>
          </div>

          <div class='col-md'>
            <div class='ftco-footer-widget mb-4'>
              <h2 class='ftco-heading-2'>¿Tienes Inquitudes?</h2>
              <div class='block-23 mb-3'>
                <ul>
                  <li><span class='icon icon-map-marker'></span><span class='text'>Carrera 62a # 44 - 44 Urb. La Alameda - Rionegro, Antioquia</span></li>
                  <li><a href='#'><span class='icon icon-phone'></span><span class='text'>300 400 4272</span></a></li>
                  <li><a href='#'><span class='icon icon-envelope pr-4'></span><span class='text'>ventas@brokersfast.com.co</span></a></li>
                </ul>
              </div>
            </div>
          </div>

        </div>
        <div class='row'>
          <div class='col-md-12 text-center'>
  
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | BROKERS</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id='ftco-loader' class='show fullscreen'><svg class='circular' width='48px' height='48px'><circle class='path-bg' cx='24' cy='24' r='22' fill='none' stroke-width='4' stroke='#eeeeee'/><circle class='path' cx='24' cy='24' r='22' fill='none' stroke-width='4' stroke-miterlimit='10' stroke='#F96D00'/></svg></div>


  <script src='js/jquery.min.js'></script>
  <script src='js/jquery-migrate-3.0.1.min.js'></script>
  <script src='js/popper.min.js'></script>
  <script src='js/bootstrap.min.js'></script>
  <script src='js/jquery.easing.1.3.js'></script>
  <script src='js/jquery.waypoints.min.js'></script>
  <script src='js/jquery.stellar.min.js'></script>
  <script src='js/owl.carousel.min.js'></script>
  <script src='js/jquery.magnific-popup.min.js'></script>
  <script src='js/aos.js'></script>
  <script src='js/jquery.animateNumber.min.js'></script>
  <script src='js/bootstrap-datepicker.js'></script>
  <script src='js/jquery.timepicker.min.js'></script>
  <script src='js/scrollax.min.js'></script>
  <script src='js/main.js'></script>
    
  </body>
</html>";

echo $html;