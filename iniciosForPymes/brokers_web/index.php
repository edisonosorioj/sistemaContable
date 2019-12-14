<?php 
require_once "php/conexion.php";

$conex = new conection();
$result = $conex->conex();
$propiedades  = '';
$count        = 1;
$div          = '';
$div2         = '';

// Consulta y por medio de un while muestra la lista de las propiedades

$query2 = mysqli_query($result,"select * from propiedad where tipo = 1;");

while ($row = $query2->fetch_array(MYSQLI_BOTH)){

  if ($count == 1) {
    $div .= "<div class='carousel-item carousel-item-property active'>
              <div class='row'>";
  }else if($count == 4 || $count == 7){
    $div .= "<div class='carousel-item carousel-item-property'>
                <div class='row'>";
  }else{
      $div .= '';
  }

  if ($count == 3 || $count == 6 || $count == 9) {
    $div2 .= " </div>
            </div>";
    }else{
      $div2 .= '';
    }

  $propiedades .= $div . "
        <div class='col-md-4'>
          <div class='property-wrap ftco-animate'>
            <a href='babilonia.html' class='img' style='background-image: url(images/work-1.jpg);'></a>
            <div class='text'>
              <p class='price'><span class='old-price'>150 Millones</span><span class='orig-price'>$130<small>Millones</small></span></p>
              <ul class='property_list'>
                <li><span class='flaticon-bed'></span>3</li>
                <li><span class='flaticon-bathtub'></span>2</li>
                <li><span class='flaticon-floor-plan'></span>Desde 35 Mt2</li>
              </ul>
              <h3><a href='babilonia.html'>" . $row['nombre'] .  "</a></h3>
              <span class='location'>Marinilla</span>
              <a href='babilonia.html' class='d-flex align-items-center justify-content-center btn-custom'>
                <span class='ion-ios-link'></span>
              </a>
            </div>
          </div>
        </div>" . $div2;

    $count=$count+1;
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
	          <li class='nav-item active'><a href='index.html' class='nav-link'>Brokers</a></li>
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
    
    <div class='hero-wrap ftco-degree-bg' style='background-image: url('images/bg_2.jpg');' data-stellar-background-ratio='0.5'>
      <div class='overlay'></div>
      <div class='container'>
        <div class='row no-gutters slider-text justify-content-center align-items-center'>
          <div class='col-lg-8 col-md-6 ftco-animate d-flex align-items-end'>
          	<div class='text text-center'>
	            <h1 class='mb-4 font-weight-bold'>La forma mas sencilla<br>para buscar propiedades</h1>
	            <p style='font-size: 18px;'>Brindamos la mejor asesoria y acompañamiento a la hora de comprar una propiedad o alquilarla</p>
	            <form action='#' class='search-location mt-md-5'>
		        		<div class='row justify-content-center'>
		        			<div class='col-lg-10 align-items-end'>
		        				<div class='form-group'>
		          				<div class='form-field'>
				                <!-- <input type='text' class='form-control' placeholder='Buscar'>
				                <button><span class='ion-ios-search'></span></button> -->
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

    <section class='ftco-section ftco-no-pb'>
      <div class='container'>
      	<div class='row justify-content-center'>
          <div class='col-md-12 heading-section text-center ftco-animate mb-5'>
          	<span class='subheading'>Nuestros Servicios</span>
            <h2 class='mb-2'>El camino corto para comprar casa</h2>
          </div>
        </div>
        <div class='row d-flex'>
          <div class='col-md-3 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services d-block text-center'>
            	<div class='icon d-flex justify-content-center align-items-center'><span class='flaticon-piggy-bank'></span></div>
              <div class='media-body py-md-4'>
                <h3>Bajas Comisiones</h3>
                <p>Escuchamos tus necesidades y comprendemos lo importante que es tu nuevo hogar.</p>
              </div>
            </div>      
          </div>
          <div class='col-md-3 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services d-block text-center'>
            	<div class='icon d-flex justify-content-center align-items-center'><span class='flaticon-wallet'></span></div>
              <div class='media-body py-md-4'>
                <h3>Facilidades de Pago</h3>
                <p>El primer paso no debe ser fácil, pero podemos trabajar para que este mas tranquilo.</p>
              </div>
            </div>      
          </div>
          <div class='col-md-3 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services d-block text-center'>
            	<div class='icon d-flex justify-content-center align-items-center'><span class='flaticon-file'></span></div>
              <div class='media-body py-md-4'>
                <h3>Expertos en este mercado</h3>
                <p>Desde el 2011 hemos trabajado duro dar a conocer nuestra empresa en el tema inmobiliario.</p>
              </div>
            </div>      
          </div>
          <div class='col-md-3 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services d-block text-center'>
            	<div class='icon d-flex justify-content-center align-items-center'><span class='flaticon-locked'></span></div>
              <div class='media-body py-md-4'>
                <h3>Seguridad</h3>
                <p>No es difícil encontrar propiedades, lo difícil es tener la seguridad de encontrar la indicada para usted.</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class='ftco-section goto-here'>
    	<div class='container'>
    		<div class='row justify-content-center'>
          <div class='col-md-12 heading-section text-center ftco-animate mb-5'>
          	<span class='subheading'>Nuestras ofertas</span>
            <h2 class='mb-2'>Ofertas exclusivas</h2>
          </div>
        </div>

        <div class='row w-100'>

          <div id='properties-slider' class='carousel slide w-100' data-ride='carousel'>
            <ol class='carousel-indicators'>
              <li data-target='#properties-slider' data-slide-to='0' class='active'></li>
              <li data-target='#properties-slider' data-slide-to='1'></li>
            </ol>
            <div class='carousel-inner'>
              
              " . $propiedades . "

            </div>
            <a class='carousel-control-prev' href='#properties-slider' role='button' data-slide='prev'>
              <span class='carousel-control-prev-icon' aria-hidden='true'></span>
              <span class='sr-only'>Previous</span>
            </a>
            <a class='carousel-control-next' href='#properties-slider' role='button' data-slide='next'>
              <span class='carousel-control-next-icon' aria-hidden='true'></span>
              <span class='sr-only'>Next</span>
            </a>
          </div>

        </div>

    	</div>
    </section>

    <section class='ftco-section ftco-degree-bg services-section img mx-md-5' style='background-image: url(images/bg_2.jpg);'>
      <div class='overlay'></div>
      <div class='container'>
        <div class='row justify-content-start mb-5'>
          <div class='col-md-4 text-center heading-section heading-section-white ftco-animate'>
            <span class='subheading'>Quienes Somos</span>
            <h2 class='mb-3'>BROKERS</h2>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-4'>
            <div class='row'>
              <p>Nace del deseo por encontrar múltiples servicios en un solo lugar, para facilidad y comodidad del cliente. En el año 2011 se inicia el proyecto en la ciudad de Medellín, dónde trabajamos durante 2 años, pero sentiamos que aún nos faltaba objetivos que lograr. Por esta razón hicimos un cambio de dirección, y es donde decidimos abrir nuestra oficina en el oriente antioqueño, en el año 2014. Desde entonces venimos trabajando para brindar cada día el mejor servicio a nuestros clientes, con innovación, calidad,  honestidad, transparencia. Para que encuentren a un click la solución a cada necesidad relacionada con sus inmuebles.</p>
                </div>
              </div>
        </div>
      </div>
    </section>

   <section class='ftco-section ftco-no-pb'>
    <div class='container'>
      <div class='row justify-content-center pb-5'>
          <div class='col-md-12 heading-section text-center ftco-animate'>
            <span class='subheading'>Innovación</span>
            <h2 class='mb-4'>Tecnología y Desarrollo</h2>
          </div>
        </div>

        <div class='row justify-content-center'>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-1.jpg' alt=''></div>
                <h3>Proyectos</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-2.jpg' alt=''></div>
                <h3>Construcción</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-3.jpg' alt=''></div>
                <h3>Administración</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-4.jpg' alt=''></div>
                <h3>Venta de P.R.</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-5.jpg' alt=''></div>
                <h3>Financiamiento</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-6.jpg' alt=''></div>
                <h3>Mantenimiento</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-7.jpg' alt=''></div>
                <h3>Arquitectura</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-8.jpg' alt=''></div>
                <h3>Diseño Int.</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-9.jpg' alt=''></div>
                <h3>Clientes</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-10.jpg' alt=''></div>
                <h3>Servicios</h3>
              </div>
            </div>      
          </div>

          <div class='col-lg-2 d-flex align-self-stretch ftco-animate'>
            <div class='media block-6 services services-2'>
               <div class='media-body py-md-4 text-center'>
                <div class='icon mb-3 d-flex align-items-center justify-content-center'><img src='images/icon-11.jpg' alt=''></div>
                <h3>Noticias</h3>
              </div>
            </div>      
          </div>

    </div>
  </section>

  <section class='ftco-section ftco-no-pb'>
      <div class='container'>
        <div class='row no-gutters'>
          <div class='col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center' style='background-image: url(images/about.jpg);'>
          </div>
          <div class='col-md-6 wrap-about py-md-5 ftco-animate'>
            <div class='heading-section p-md-5'>
              <h2 class='mb-4'>Valores</h2>

              <p>Sustentarse en dos pilares fundamentales: seriedad y honestidad, basado en un auténtico compromiso de responsabilidad como norma ética en todos nuestros actos</p>
              • Alta calidad<br>
              • Prestigio<br>
              • Excelencia<br>
              • Responsabilidad social empresarial<br>
              • Creatividad e innovación<br>
              • Trabajo en equipo<br>
              • Identidad<br>
              • Profesionalismo<br>
              • Pasión: comprometidos con el alma y la mente
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class='ftco-section ftco-degree-bg services-section img mx-md-5' style='background-image: url(images/bg_3.jpg);'>
      <div class='overlay'></div>
      <div class='container'>
        <div class='row justify-content-start mb-5'>
          <div class='col-md-4 text-center heading-section heading-section-white ftco-animate'>
            <span class='subheading'>Quienes Somos</span>
            <h2 class='mb-3'>BROKERS</h2>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-4'>
            <div class='row'>
              <p>Nace del deseo por encontrar múltiples servicios en un solo lugar, para facilidad y comodidad del cliente. En el año 2011 se inicia el proyecto en la ciudad de Medellín, dónde trabajamos durante 2 años, pero sentiamos que aún nos faltaba objetivos que lograr. Por esta razón hicimos un cambio de dirección, y es donde decidimos abrir nuestra oficina en el oriente antioqueño, en el año 2014. Desde entonces venimos trabajando para brindar cada día el mejor servicio a nuestros clientes, con innovación, calidad,  honestidad, transparencia. Para que encuentren a un click la solución a cada necesidad relacionada con sus inmuebles.</p>
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
                  <li><a href='#'><span class='icon icon-phone'></span><span class='text'>300 400 4272 - 3205247665</span></a></li>
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