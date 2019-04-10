<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}


$html="<!DOCTYPE html>
<head>
<title>Informes</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src='../../js/jquery2.0.3.min.js'></script>
<script src='../../js/modernizr.js'></script>
<script src='../../js/jquery.cookie.js'></script>
<script src='../../js/screenfull.js'></script>
<script>
	$(function () {
		$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

		if (!screenfull.enabled) {
			return false;
		}

		$('#toggle').click(function () {
			screenfull.toggle($('#container')[0]);
		});	
	});
</script>
<!-- tables -->
<link rel='stylesheet' type='text/css' href='../../css/table-style.css' />
<link rel='stylesheet' type='text/css' href='../../css/basictable.css' />
<script type='text/javascript' src='../../js/jquery.basictable.min.js'></script>
<script>
    var theme = $.cookie('protonTheme') || 'default';
    $('body').removeClass (function (index, css) {
        return (css.match (/\btheme-\S+/g) || []).join(' ');
    });
    if (theme !== 'default') $('body').addClass(theme);
</script>
<script type='text/javascript'>
    $(document).ready(function() {
      $('#table').basictable();
    }); 
	function abrir(url) { 
	open(url,'','top=100,left=100,width=900,height=700') ; 
	}
</script>
<!-- //tables -->
</head>
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				
				<div class='buttons-heading'>
					<h2>Informes</h2>
				</div>

			<!-- //Color-variations -->
				<div class='agile-buttons-grids'>
					<!-- button-states -->
					<div class='col-sm-6 col-md-4 button-size-grids'>
						<div class='panel button-sizes'>
							<div class='panel-heading'>
								<div class='panel-title pn'>
									<h3 class='mtn mb10 fw400'>Est. Cuenta Clientes</h3>
								</div>
							</div>
							<div class='panel-body mtn'>
								
								<form class='form-horizontal' action='informeClientes.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
								<div class='bs-component mb20'>
									<button type='submit' class='btn btn-hover btn-dark btn-block'>Generar</button>
								</div>
								</form> 
								
							</div>
						</div>
					</div>

					<div class='col-sm-6 col-md-4 button-size-grids'>
						<div class='panel button-sizes'>
							<div class='panel-heading'>
								<div class='panel-title pn'>
									<h3 class='mtn mb10 fw400'>Informe General</h3>
								</div>
							</div>
							<div class='panel-body mtn'>
								
								<form class='form-horizontal' action='informeGeneral.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
								<div class='form-group'> 
									<label>Fecha Inicio</label> 
									<input type='date' name='fecha_inicio' class='form-control'>
								</div>
								<div class='form-group'> 
									<label>Fecha Final</label> 
									<input type='date' name='fecha_fin' class='form-control'>
								</div>
								<div class='bs-component mb20'>
									<button type='submit' class='btn btn-hover btn-dark btn-block'>Generar</button>
								</div>
								</form> 
								
							</div>
						</div>
					</div>

					<div class='col-sm-6 col-md-4 button-size-grids'>
						<div class='panel button-sizes'>
							<div class='panel-heading'>
								<div class='panel-title pn'>
									<h3 class='mtn mb10 fw400'>Informe Inventario</h3>
								</div>
							</div>
							<div class='panel-body mtn'>
								
								<form class='form-horizontal' action='informeInventario.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
								<div class='bs-component mb20'>
									<button type='submit' class='btn btn-hover btn-dark btn-block'>Generar</button>
								</div>
								</form> 
								
							</div>
						</div>
					</div>

				</div>
				<div class='clearfix'> </div>
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
				<p>© 2019 ForPymes. All Rights Reserved . Design by <a href='https://forpymes.co'></a>ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
