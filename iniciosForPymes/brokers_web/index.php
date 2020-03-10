<?php 
require_once "php/conexion.php";

$conex = new conection();
$result = $conex->conex();
$propiedades  = '';
$count        = 1;

require 'header.php';

// Consulta y por medio de un while muestra la lista de las propiedades

$query2 = mysqli_query($result,"SELECT p.*, z.nombre as ciudad FROM propiedad p INNER JOIN zonas z ON p.zona = z.id WHERE p.tipo = 1;");

while ($row = $query2->fetch_array(MYSQLI_BOTH)){
  $div          = '';
  $div2         = '';

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
            <a href='" . $row['pagina'] .  "' class='img' style='background-image: url(" . $row['img'] .  ");'></a>
            <div class='text'>
              <p class='price'><span class='orig-price'>Desde $ " . number_format($row['costo'], 0, ",", ".") .  "</span></p>
              <ul class='property_list'>
                <li><span class='flaticon-bed'></span>" . $row['dato1'] .  "</li>
                <li><span class='flaticon-bathtub'></span>" . $row['dato2'] .  "</li>
                <li><span class='flaticon-floor-plan'></span>" . $row['dato3'] .  "</li>
              </ul>
              <h3><a href='" . $row['pagina'] .  "'>" . $row['nombre'] .  "</a></h3>
              <span class='location'>" . $row['ciudad'] .  "</span>
              <a href='" . $row['pagina'] .  "' class='d-flex align-items-center justify-content-center btn-custom'>
                <span class='ion-ios-link'></span>
              </a>
            </div>
          </div>
        </div>" .
        $div2;

    $count=$count+1;
}


$html = "
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
              <p style='margin-left: 2em !important;'>Nace del deseo por encontrar múltiples servicios en un solo lugar, para facilidad y comodidad del cliente. En el año 2011 se inicia el proyecto en la ciudad de Medellín, dónde trabajamos durante 2 años, pero sentiamos que aún nos faltaba objetivos que lograr. Por esta razón hicimos un cambio de dirección, y es donde decidimos abrir nuestra oficina en el oriente antioqueño, en el año 2014. Desde entonces venimos trabajando para brindar cada día el mejor servicio a nuestros clientes, con innovación, calidad,  honestidad, transparencia. Para que encuentren a un click la solución a cada necesidad relacionada con sus inmuebles.</p>
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
              <p style='margin-left: 2em !important;'>Nace del deseo por encontrar múltiples servicios en un solo lugar, para facilidad y comodidad del cliente. En el año 2011 se inicia el proyecto en la ciudad de Medellín, dónde trabajamos durante 2 años, pero sentiamos que aún nos faltaba objetivos que lograr. Por esta razón hicimos un cambio de dirección, y es donde decidimos abrir nuestra oficina en el oriente antioqueño, en el año 2014. Desde entonces venimos trabajando para brindar cada día el mejor servicio a nuestros clientes, con innovación, calidad,  honestidad, transparencia. Para que encuentren a un click la solución a cada necesidad relacionada con sus inmuebles.</p>
                </div>
              </div>
        </div>
      </div>
    </section>
";

echo $html;

require 'footer.php';