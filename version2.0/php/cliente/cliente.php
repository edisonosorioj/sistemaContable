<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

include "../menu.php";

// Consulta y por medio de un while muestra la lista de los clientes
$query = mysqli_query($result,'select c.id, c.documento, c.nombres, telefono, SUM(cr.valor) as valor from clientes c
								left join creditos cr on c.id = cr.idclientes
								group by c.id order by c.nombres');



$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['documento'] 				. "</td>
				<td>" . $row['nombres'] 				. "</td>
				<td>" . $row['telefono'] 				. "</td>
				<td  align='right'>$ " . number_format($row['valor'], 0, ",", ".") 	. "</td>
				<td><a onclick='javascript:abrir(\"editarCliente.php?id=" . $row['id'] . "\")'><span data-tooltip='Editar'>
					<i class='fa fa-file-text-o nav_icon'></i></spam></a>
				<a href='../credito/credito.php?id=" . $row['id'] . "'><span data-tooltip='Historia'>
					<i class='fa fa-bar-chart nav_icon'></i></spam></a>
				<a href='eliminarCliente.php?id=" . $row['id'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off nav-icon'></i></a>
				</td>
			</tr>";

 }

// Realiza una segunda consulta que suma el total que deben todos los clientes
 $query2 = mysqli_query($result,'select SUM(cr.valor) as valor from creditos cr');

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $cartera = $query2->fetch_array(MYSQLI_BOTH);


$html="<!DOCTYPE html>
<head>
<title>Clientes</title>
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
</head>
<body class='dashboard-page'>

	
	<section class='wrapper scrollable'>
		<nav class='user-menu'>
			<a href='javascript:;' class='main-menu-access'>
			<i class='icon-proton-logo'></i>
			<i class='icon-reorder'></i>
			</a>
		</nav>
		<section class='title-bar'>
			<div class='logo'>
				<h1><a href='index.html'><img src='images/logo.png' alt='' />LOGO</a></h1>
			</div>
			<div class='full-screen'>
				<section class='full-top'>
					<button id='toggle'><i class='fa fa-arrows-alt' aria-hidden='true'></i></button>	
				</section>
			</div>
			<div class='w3l_search'>
				<form action='#' method='post'>
					<input id='search' type='text' name='search' value=''>
					<button class='btn btn-default' type='submit' disabled='true'><i class='fa fa-search'></i></button>
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
									<li> <a href='#'><i class='fa fa-cog'></i> Configuración</a> </li> 
									<li> <a href='#'><i class='fa fa-user'></i> Perfil</a> </li> 
									<li> <a href='#'><i class='fa fa-sign-out'></i> Salir</a> </li>
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
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Clientes</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/cliente/nuevoCliente.html\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					  	<h3>Cartera Pendiente: $ " . number_format($cartera['valor'], 0, ",", ".") ."</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Saldo</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr . 
						  "
						</tbody>
					  </table>
					</div>
				</div>
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2017 AdminSoft . All Rights Reserved . Design by <a href='edisonosorioj.com'></a>AlDía</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;