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


include "graficas.php";
if ($idrol == 0) {
	include "../menu.php";
} else {
	include "../menu2.php";
}

$caja = $ingmes - $egrmes;


$html= "<!DOCTYPE html>
<head>
<title>Inicio</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel='stylesheet' href='../../css/bootstrap.css'>
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href='../../css/style.css' rel='stylesheet' type='text/css' />
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel='stylesheet' href='../../css/font.css' type='text/css'/>
<link href='../../css/font-awesome.css' rel='stylesheet'> 
<!-- //font-awesome icons -->
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
<!-- charts -->
<script src='../../js/raphael-min.js'></script>
<script src='../../js/morris.js'></script>
<link rel='../../stylesheet' href='../../css/morris.css'>
<!-- //charts -->
<!--skycons-icons-->
<script src='../../js/skycons.js'></script>
<!--//skycons-icons-->
</head>
	<body class='dashboard-page'>
			<div class='agile-grids'>
				<div class='col-md-6 charts-right'>
					<div class='area-grids-heading'>
						<h3>Saldo en Caja: $ " . number_format($caja, 0, ",", ".") . "</h3>
					</div>
					<!-- area-chart -->
					<div class='area-grids'>
						<div class='area-grids-heading'>
							<h3>Balance General</h3>
						</div>
						<div id='graph4'></div>
						<script>
							Morris.Donut({
							  element: 'graph4',
							  data: [
								{value: " . $porcIng . ", label: 'Ingresos', formatted: '$ " . $ingr . "' },
								{value: " . $porcEgr . ", label: 'Egresos', formatted: '$ " . number_format((float)$egr, 0, ",", ".") . "' }
							  ],
							  formatter: function (x, data) { return data.formatted; }
							});
						</script>

					</div>
				</div>
				<div class='col-md-6 charts-right'>
					<div class='agile-last-grid'>
						<div class='area-grids-heading'>
							<h3>Balance últimos 7 Días</h3>
						</div>
						<div id='graph8'></div>
						<script>
						/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
						var day_data = [
		  					{'period': '" . $dia6 . "', 'ingreso': " . $ingr6 . ", 'egreso': " . $egr6 . "},
		  					{'period': '" . $dia5 . "', 'ingreso': " . $ingr5 . ", 'egreso': " . $egr5 . "},
		  					{'period': '" . $dia4 . "', 'ingreso': " . $ingr4 . ", 'egreso': " . $egr4 . "},
		  					{'period': '" . $dia3 . "', 'ingreso': " . $ingr3 . ", 'egreso': " . $egr3 . "},
		  					{'period': '" . $dia2 . "', 'ingreso': " . $ingr2 . ", 'egreso': " . $egr2 . "},
		  					{'period': '" . $dia1 . "', 'ingreso': " . $ingr1 . ", 'egreso': " . $egr1 . "},
		  					{'period': '" . $dia . "', 'ingreso': " . $ingr0 . ", 'egreso': " . $egr0 . "}
						];
						Morris.Bar({
						  element: 'graph8',
						  data: day_data,
						  xkey: 'period',
						  ykeys: ['ingreso', 'egreso'],
						  labels: ['INGRESO', 'EGRESO'],
						  xLabelAngle: 60
						});
						</script>
					</div>
				</div>
				
			
			<div class='agile-bottom-grids'>

				<div class='clearfix'> </div>
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2018 Forpymes . All Rights Reserved . Design by <a href=''>Forpymes</a></p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>
";

echo $html;

?>