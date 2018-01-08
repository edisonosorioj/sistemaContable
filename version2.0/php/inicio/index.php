<?php

// session_start();

// if (!isset($_SESSION['login'])) {

// 	header("Location: ../inicio/session.php");
// 	exit();
	
// }

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
$ingr = '';
$egr = '';
$sum = '';
$ingr0 = '';
$egr0 = '';
$ingr1 = '';
$egr1 = '';
$ingr2 = '';
$egr2 = '';
$ingr3 = '';
$egr3 = '';
$ingr4 = '';
$egr4 = '';
$ingr5 = '';
$egr5 = '';
$ingr6 = '';
$egr6 = '';

$gra = '';


/////////////////////Ingresos-Egresos/////////////////////////////

// Ingresos
$query = mysqli_query($result,'select SUM(valor) as total from ingresos');

$row = $query->fetch_assoc();
$ingr .= number_format($row['total'], 0, ",", ".");

// Egresos
$query2 = mysqli_query($result,"select SUM(valor) as total from compras");

$row2 = $query2->fetch_assoc();
$egr .= number_format($row2['total'], 0, ",", ".");

/////////////////////Porcentaje Ing-Egr/////////////////////////////

$sum = $row['total'] + $row2['total'];

$porcIng = $sum - $row2['total'];
$porcEgr = $sum - $row['total'];

/////////////////// Ingresos y Egresos por Día/////////////////////

$dia = date("Y-m-d");

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr0 .= 0;
}else{
	$ingr0 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr0 .= 0;
}else{
	$egr0 .= $row4['total'];
}

/////////////
$dia1 = date("Y-m-d", strtotime("-1 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia1."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr1 .= 0;
}else{
	$ingr1 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia1."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr1 .= 0;
}else{
	$egr1 .= $row4['total'];
}

/////////////
$dia2 = date("Y-m-d", strtotime("-2 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia2."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr2 .= 0;
}else{
	$ingr2 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia2."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr2 .= 0;
}else{
	$egr2 .= $row4['total'];
}

////////////
$dia3 = date("Y-m-d", strtotime("-3 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia3."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr3 .= 0;
}else{
	$ingr3 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia3."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr3 .= 0;
}else{
	$egr3 .= $row4['total'];
}

/////////////////
$dia4 = date("Y-m-d", strtotime("-4 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia4."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr4 .= 0;
}else{
	$ingr4 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia4."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr4 .= 0;
}else{
	$egr4 .= $row4['total'];
}

////////////////
$dia5 = date("Y-m-d", strtotime("-5 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia5."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr5 .= 0;
}else{
	$ingr5 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia5."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr5 .= 0;
}else{
	$egr5 .= $row4['total'];
}


////////////////
$dia6 = date("Y-m-d", strtotime("-6 day"));

$query3 = mysqli_query($result,"select SUM(valor) as total from ingresos where fecha = '".$dia6."'");

$row3 = $query3->fetch_assoc();
if ($row3['total'] <= 0) {
	$ingr6 .= 0;
}else{
	$ingr6 .= $row3['total'];
}

$query4 = mysqli_query($result,"select SUM(valor) as total from compras where fecha = '".$dia6."'");

$row4 = $query4->fetch_assoc();
if ($row4['total'] <= 0) {
	$egr6 .= 0;
}else{
	$egr6 .= $row4['total'];
}

///////////////////

$html= "<!DOCTYPE html>
<head>
<title>Centraliza</title>
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
	<script>
	        var theme = $.cookie('protonTheme') || 'default';
	        $('body').removeClass (function (index, css) {
	            return (css.match (/\btheme-\S+/g) || []).join(' ');
	        });
	        if (theme !== 'default') $('body').addClass(theme);
        </script>
	<nav class='main-menu'>
		<ul>
			<li>
				<a href='index.php'>
					<i class='fa fa-home nav_icon'></i>
					<span class='nav-text'>
					Inicio
					</span>
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../cliente/cliente.php'>
				<i class='fa fa-cogs' aria-hidden='true'></i>
				<span class='nav-text'>
					Clientes
				</span>
				<!-- <i class='icon-angle-right'></i><i class='icon-angle-down'></i> -->
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../egresos/egresos.php'>
				<i class='fa fa-check-square-o nav_icon'></i>
				<span class='nav-text'>
				Egresos
				</span>
				<!-- <i class='icon-angle-right'></i><i class='icon-angle-down'></i> -->
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../ingresos/ingresos.php'>
					<i class='fa fa-file-text-o nav_icon'></i>
						<span class='nav-text'>Ingresos</span>
					<!-- <i class='icon-angle-right'></i><i class='icon-angle-down'></i> -->
				</a>
			</li>
<!-- 			<li>
				<a href='../cuentas/cuentas.php'>
					<i class='fa fa-bar-chart nav_icon'></i>
					<span class='nav-text'>
						Cuentas
					</span>
				</a>
			</li> -->
<!-- 			<li>
				<a href='../inventario/inventario.php'>
					<i class='icon-font nav-icon'></i>
					<span class='nav-text'>
					Inventario
					</span>
				</a>
			</li> -->
		<ul class='logout'>
			<li>
			<a href='session.html'>
			<i class='icon-off nav-icon'></i>
			<span class='nav-text'>
			Salir
			</span>
			</a>
			</li>
		</ul>
	</nav>
	<section class='wrapper scrollable'>
		<nav class='user-menu'>
			<a href='javascript:;' class='main-menu-access'>
			<i class='icon-proton-logo'></i>
			<i class='icon-reorder'></i>
			</a>
		</nav>
		<section class='title-bar'>
			<div class='logo'>
				<h1><a href='index.html'><img src='../../images/logo.png' alt='' />Centraliza</a></h1>
			</div>
			<div class='full-screen'>
				<section class='full-top'>
					<button id='toggle'><i class='fa fa-arrows-alt' aria-hidden='true'></i></button>	
				</section>
			</div>
			<div class='w3l_search'>
				<form action='#' method='post'>
					<input type='text' name='search' value='Search' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'Search';}' required=''>
					<button class='btn btn-default' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>
				</form>
			</div>
			<div class='header-right'>
				<div class='profile_details_left'>
					<div class='profile_details'>		
						<ul>
							<li class='dropdown profile_details_drop'>
								<a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
									<div class='profile_img'>	
										<span class='prfil-img'><i class='fa fa-user' aria-hidden='true'></i></span> 
										<div class='clearfix'></div>	
									</div>	
								</a>
								<ul class='dropdown-menu drp-mnu'>
									<li> <a href='#'><i class='fa fa-cog'></i> Settings</a> </li> 
									<li> <a href='#'><i class='fa fa-user'></i> Profile</a> </li> 
									<li> <a href='#'><i class='fa fa-sign-out'></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class='clearfix'> </div>
				</div>
			</div>
			<div class='clearfix'> </div>
		</section>
		<div class='main-grid'>
			
			<div class='social grid'>
					<div class='grid-info'>
						<div class='col-md-3 top-comment-grid'>
							<div class='comments likes'>
								<div class='comments-icon'>
									<i class='fa fa-facebook'></i>
								</div>
								<div class='comments-info likes-info'>
									<h3>95K</h3>
									<a href='#'>Likes</a>
								</div>
								<div class='clearfix'> </div>
							</div>
						</div>
						<div class='col-md-3 top-comment-grid'>
							<div class='comments'>
								<div class='comments-icon'>
									<i class='fa fa-comments'></i>
								</div>
								<div class='comments-info'>
									<h3>12K</h3>
									<a href='#'>Comments</a>
								</div>
								<div class='clearfix'> </div>
							</div>
						</div>
						<div class='col-md-3 top-comment-grid'>
							<div class='comments tweets'>
								<div class='comments-icon'>
									<i class='fa fa-twitter'></i>
								</div>
								<div class='comments-info tweets-info'>
									<h3>27K</h3>
									<a href='#'>Tweets</a>
								</div>
								<div class='clearfix'> </div>
							</div>
						</div>
						<div class='col-md-3 top-comment-grid'>
							<div class='comments views'>
								<div class='comments-icon'>
									<i class='fa fa-eye'></i>
								</div>
								<div class='comments-info views-info'>
									<h3>557K</h3>
									<a href='#'>Views</a>
								</div>
								<div class='clearfix'> </div>
							</div>
						</div>
						<div class='clearfix'> </div>
					</div>
			</div>
			
			<div class='agile-grids'>
				<div class='col-md-6 charts-right'>
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
								{value: " . $porcEgr . ", label: 'Egresos', formatted: '$ " . $egr . "' }
							  ],
							  formatter: function (x, data) { return data.formatted; }
							});
						</script>

					</div>
					<!-- //area-chart -->
				</div>
				<div class='col-md-6 agile-bottom-right'>
					<div class='agile-bottom-grid'>
						<div class='area-grids-heading'>
							<h3>Stacked Bars chart</h3>
						</div>
						<div id='graph6'></div>
						<script>
						// Use Morris.Bar
						Morris.Bar({
						  element: 'graph6',
						  data: [
							{x: '2011 Q1', y: 0},
							{x: '2011 Q2', y: 1},
							{x: '2011 Q3', y: 2},
							{x: '2011 Q4', y: 3},
							{x: '2012 Q1', y: 4},
							{x: '2012 Q2', y: 5},
							{x: '2012 Q3', y: 6},
							{x: '2012 Q4', y: 7},
							{x: '2013 Q1', y: 8}
						  ],
						  xkey: 'x',
						  ykeys: ['y'],
						  labels: ['Y'],
						  barColors: function (row, series, type) {
							if (type === 'bar') {
							  var red = Math.ceil(255 * row.y / this.ymax);
							  return 'rgb(' + red + ',0,0)';
							}
							else {
							  return '#000';
							}
						  }
						});
						</script>
					</div>
				</div>
				
			
			<div class='agile-bottom-grids'>
				<div class='col-md-6 agile-last-left agile-last-middle'>
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
				<div class='col-md-6 agile-last-left agile-last-middle'>
					<div class='agile-last-grid'>
						<div class='area-grids-heading'>
							<h3>Balance últimos 7 Días</h3>
						</div>
						<div id='graph9'></div>
						<script>
						/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
						var day_data = [
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000},
		  					{'period': '2017-04-01', 'ingreso2': 225.000, 'egreso2': 500.000}
						];
						Morris.Bar({
						  element: 'graph9',
						  data: day_data,
						  xkey: 'period',
						  ykeys: ['ingreso2', 'egreso2'],
						  labels: ['INGRESO', 'EGRESO'],
						  xLabelAngle: 60
						});
						</script>
					</div>
				</div>


			<div class='agile-last-grids'>
					<div class='col-md-12 agile-bottom-left'>
						<div class='agile-bottom-grid'>
							<div class='area-grids-heading'>
								<h3>Stacked Bars chart</h3>
							</div>
							<div id='graph5'></div>
							<script>
							// Use Morris.Bar
							Morris.Bar({
							  element: 'graph5',
							  data: [
								{x: '2011 Q1', y: 3, z: 2, a: 3},
								{x: '2011 Q2', y: 2, z: null, a: 1},
								{x: '2011 Q3', y: 0, z: 2, a: 4},
								{x: '2011 Q4', y: 2, z: 4, a: 3}
							  ],
							  xkey: 'x',
							  ykeys: ['y', 'z', 'a'],
							  labels: ['Y', 'Z', 'A'],
							  stacked: true
							});
							</script>
						</div>
					</div>
					<div class='clearfix'> </div>
				</div>
				<div class='col-md-6 agile-last-left'>
					<div class='agile-last-grid'>
						<div class='area-grids-heading'>
							<h3>Daylight savings time</h3>
						</div>
						<div id='graph7'></div>
						<script>
						// This crosses a DST boundary in the UK.
						Morris.Area({
						  element: 'graph7',
						  data: [
							{x: '2013-03-30 22:00:00', y: 3, z: 3},
							{x: '2013-03-31 00:00:00', y: 2, z: 0},
							{x: '2013-03-31 02:00:00', y: 0, z: 2},
							{x: '2013-03-31 04:00:00', y: 4, z: 4}
						  ],
						  xkey: 'x',
						  ykeys: ['y', 'z'],
						  labels: ['Y', 'Z']
						});
						</script>

					</div>
				</div>

				<div class='col-md-6 agile-last-left agile-last-right'>
					<div class='agile-last-grid'>
						<div class='area-grids-heading'>
							<h3>Daylight savings time</h3>
						</div>
						<div id='graph10'></div>
						<script>
						var day_data = [
						  {'elapsed': 'I', 'value': 34},
						  {'elapsed': 'II', 'value': 24},
						  {'elapsed': 'III', 'value': 3},
						  {'elapsed': 'IV', 'value': 12},
						  {'elapsed': 'V', 'value': 13},
						  {'elapsed': 'VI', 'value': 22},
						  {'elapsed': 'VII', 'value': 5},
						  {'elapsed': 'VIII', 'value': 26},
						  {'elapsed': 'IX', 'value': 12},
						  {'elapsed': 'X', 'value': 19}
						];
						Morris.Line({
						  element: 'graph10',
						  data: day_data,
						  xkey: 'elapsed',
						  ykeys: ['value'],
						  labels: ['value'],
						  parseTime: false
						});
						</script>

					</div>
				</div>
				<div class='clearfix'> </div>
			</div>

			<div class='agile-two-grids'>
				<div class='col-md-6 count'>
						<div class='count-grid'>
							<h3 class='title'>Countdown</h3>
							<ul id='example'>
								<li><span class='hours'>00</span><p class='hours_text'>Hours</p></li>
								<li class='seperator'>:</li>
								<li><span class='minutes'>00</span><p class='minutes_text'>Minutes</p></li>
								<li class='seperator'>:</li>
								<li><span class='seconds'>00</span><p class='seconds_text'>Seconds</p></li>
							</ul>
							<div class='clearfix'> </div>
							<script type='text/javascript' src='../../js/jquery.countdown.min.js'></script>
							<script type='text/javascript'>
								$('#example').countdown({
									date: '12/24/2020 18:59:59',
									offset: -8,
									day: 'Day',
									days: 'Days'
								}, function () {
									alert('Done!');
								});
							</script>
						</div>
				</div>
				<div class='col-md-6 weather'>
					<div class='weather-right'>
						<div class='weather-heading'>
							<h3>Weather Report</h3>
						</div>
								<ul>
									<li>
										<figure class='icons'>
											<canvas id='partly-cloudy-day' width='60' height='60'></canvas>
										</figure>
										<h3>25 °C</h3>
										<div class='clearfix'></div>
									</li>
									<li>
										<figure class='icons'>
											<canvas id='clear-day' width='40' height='40'></canvas>
										</figure>
										<div class='weather-text'>
											<h4>WED</h4>
											<h5>27 °C</h5>
										</div>
										<div class='clearfix'></div>
									</li>
									<li>
										<figure class='icons'>
											<canvas id='snow' width='40' height='40'></canvas>
										</figure>
										<div class='weather-text'>
											<h4>THR</h4>
											<h5>13 °C</h5>
										</div>
										<div class='clearfix'></div>
									</li>
									<li>
										<figure class='icons'>
											<canvas id='partly-cloudy-night' width='40' height='40'></canvas>
										</figure>
										<div class='weather-text'>
											<h4>FRI</h4>
											<h5>18 °C</h5>
										</div>
										<div class='clearfix'></div>
									</li>
									<li>
										<figure class='icons'>
											<canvas id='cloudy' width='40' height='40'></canvas>
										</figure>
										<div class='weather-text'>
											<h4>SAT</h4>
											<h5>15 °C</h5>
										</div>
										<div class='clearfix'></div>
									</li>
									<li>
										<figure class='icons'>
											<canvas id='fog' width='40' height='40'></canvas>
										</figure>
										<div class='weather-text'>
											<h4>SUN</h4>
											<h5>11 °C</h5>
										</div>
										<div class='clearfix'></div>
									</li>
								</ul>
								<script>
									 var icons = new Skycons({'color': '#fcb216'}),
										  list  = [
											'partly-cloudy-day'
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
								<script>
									 var icons = new Skycons({'color': '#000'}),
										  list  = [
											'clear-night','partly-cloudy-night', 'cloudy', 'clear-day', 'sleet', 'snow', 'wind','fog'
										  ],
										  i;

									  for(i = list.length; i--; )
										icons.set(list[i], list[i]);
									  icons.play();
								</script>
					</div>
				</div>
				<div class='clearfix'> </div>
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2016 AlDía . All Rights Reserved . Design by <a href=''>AlDía</a></p>
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