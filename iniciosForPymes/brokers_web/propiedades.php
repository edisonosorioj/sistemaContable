<?php 
require_once "php/conexion.php";

$conex = new conection();
$result = $conex->conex();
$propiedades  = '';
$count        = 1;

// Consulta y por medio de un while muestra la lista de las propiedades

$query2 = mysqli_query($result,"SELECT p.*, z.nombre as ciudad FROM propiedad p INNER JOIN zonas z ON p.zona = z.id;");

while ($row = $query2->fetch_array(MYSQLI_BOTH)){
  $div          = '';
  $div2         = '';
  $opacidad 	= '';
  $pagina 		= $row['pagina'];
  $texto 		= '';

  $desde		= ($row['estado'] == 1) ? 'Desde ' : '' ;

  if ($row['estado'] == 2) {
	$opacidad 	= 'opacity';
  	$pagina 	= '#';
  	$texto 		= ' - No disponible';
  }

  $propiedades .= "
        <div class='col-md-4'>
          <div class='property-wrap ftco-animate'>
            <a href='" . $pagina .  "' class='img' style='background-image: url(" . $row['img'] .  ");'></a>
            <div class='text " . $opacidad . "'>
              <p class='price'><span class='orig-price'>" . $desde . " $ " . number_format($row['costo'], 0, ",", ".") . $texto . "</span></p>
              <ul class='property_list'>
                <li><span class='flaticon-bed'></span>" . $row['dato1'] .  "</li>
                <li><span class='flaticon-bathtub'></span>" . $row['dato2'] .  "</li>
                <li><span class='flaticon-floor-plan'></span>" . $row['dato3'] .  "</li>
              </ul>
              <h3><a href='" . $pagina .  "'>" . $row['nombre'] .  "</a></h3>
              <span class='location'>" . $row['ciudad'] .  "</span>
              <a href='" . $pagina .  "' class='d-flex align-items-center justify-content-center btn-custom'>
                <span class='ion-ios-link'></span>
              </a>
            </div>
          </div>
        </div>";
}


$html = "<!DOCTYPE html>
<html lang='es'>
  <head>
    <title>Brokers Fast</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    
    <link rel='icon' href='images/favicon.ico' >
    <link href='https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900&display=swap' rel='stylesheet'>

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
    .opacity{
	   background-color:#fc883b !important;
	   opacity:0.6; /* Opacidad 60% */
	}
  </style>
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
	          <li class='nav-item'><a href='index.php' class='nav-link'>Brokers</a></li>
            <li class='nav-item  active'><a href='propiedades.php' class='nav-link'>Propiedades</a></li>
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
    
    <div class='hero-wrap ftco-degree-bg' style='background-image: url(\"images/bg_2.jpg\");' data-stellar-background-ratio='0.5'>
      <div class='overlay'></div>
      <div class='container'>
        <div class='row no-gutters slider-text justify-content-center align-items-center'>
          <div class='col-lg-8 col-md-6 ftco-animate d-flex align-items-end'>
          	<div class='text text-center'>
	            <h1 class='mb-4 font-weight-bold'>La forma mas sencilla<br>para buscar propiedades</h1>
	            <form action='#' class='search-location mt-md-5'>
	        		<div class='row justify-content-center'>
	        			<div class='col-lg-10 align-items-end'>
	        				<div class='form-group'>
	          				<div class='form-field'>
			                <input type='text' class='form-control' placeholder='Buscar'>
			                <button><span class='ion-ios-search'></span></button>
			              </div>
		              </div>
	        			</div>
	        		</div>
	        	</form>
            </div>
          </div>
        </div>
      </div>
      <div class='mouse'>
				<a href='#' class='mouse-icon'>
					<div class='mouse-wheel'><span class='ion-ios-arrow-round-down'></span></div>
				</a>
			</div>
    </div>

    <section class='ftco-section'>
    	<div class='container'>
        <div class='row'>
            " . $propiedades . "
        </div>
        <div class='row mt-5'>
          <div class='col text-center'>
            <div class='block-27'>
              <ul>
                <li><a href='#'>&lt;</a></li>
                <li class='active'><span>1</span></li>
                <li><a href='#'>2</a></li>
                <li><a href='#'>3</a></li>
                <li><a href='#'>4</a></li>
                <li><a href='#'>5</a></li>
                <li><a href='#'>&gt;</a></li>
              </ul>
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
  <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false'></script>
  <script src='js/google-map.js'></script>
  <script src='js/main.js'></script>
    
  </body>
</html>";

echo $html;