<?php

if (isset($_SESSION['idrol'])){

	$fecha_ultimo_pago 	= $_SESSION['fecha_ultimo_pago'];
	$nomina 			= $_SESSION['modulo_nomina'];
	$pedidomesas 		= $_SESSION['mesas'];
}

$fecha_actual		= strtotime(date('d-m-Y'));
$fecha_contrato		= strtotime(date($fecha_ultimo_pago));
$status 			= '';

$status 		= ($fecha_contrato < $fecha_actual) ? "class='class_a_href'" 			: $status;
$pedidomesas 	= ($pedidomesas == 1) 				? "../pedidos/pedidos_mesas.php" 	: "../pedidos/pedido.php" ;


if ($nomina == 1) {
	$nomina = "<li class='has-subnav'>
				<a href='../nomina/usuarios.php' " . $status . ">
					<i class='fa fa-file-text-o nav_icon'></i>
						<span class='nav-text'>Nomina</span>
					<i class='icon-angle-right'></i><i class='icon-angle-down'></i>
				</a>
				<ul>
					<li>
						<a href='../nomina/usuarios.php' class='subnav-text'>Usuarios</a>
					</li>
					<li>
						<a href='../nomina/nomina.php' class='subnav-text'>Liquidar Nomina</a>
					</li>
				</ul>
			</li>";
}else{
	$nomina = '';
}

$menu = "
	<head>
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
		<link rel='icon' href='../../images/fav.png'>
	</head>
	<nav class='main-menu'>
		<ul>
			<li>
				<a href='../inicio/index.php'>
					<i class='fa fa-home nav_icon'></i>
					<span class='nav-text'>
					Inicio
					</span>
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../cliente/cliente.php' " . $status . ">
				<i class='icon-user nav-icon'></i>
				<span class='nav-text'>
					Clientes
				</span>
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../egresos/egresos.php' " . $status . ">
				<i class='fa fa-file-text-o nav_icon'></i>
				<span class='nav-text'>
				Egresos
				</span>
				<!-- <i class='icon-angle-right'></i><i class='icon-angle-down'></i> -->
				</a>
			</li>
			<li class='has-subnav'>
				<a href='../ingresos/ingresos.php' " . $status . ">
					<i class='fa fa-file-text-o nav_icon'></i>
						<span class='nav-text'>Ingresos</span>
				</a>
			</li>
			<li>
				<a href='" . $pedidomesas . "' " . $status . ">
					<i class='icon-table nav-icon'></i>
					<span class='nav-text'>
					Contratos
					</span>
				</a>
			</li>
			<li>
				<a href='../inventario/inventario.php' " . $status . ">
					<i class='fa fa-list-ul'></i>
					<span class='nav-text'>
					Propiedades
					</span>
				</a>
			</li>
			" . $nomina . "
			<li>
				<a href='../informes/informes.php' " . $status . ">
					<i class='icon-folder-open nav-icon'></i>
					<span class='nav-text'>
					Informes
					</span>
				</a>
			</li>
		</ul>
		<ul class='logout'>
			<li>
				<a href='../logout.php'>
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
				<h1><a href='index.html'><img src='../../images/logo.png' alt='' />Forpymes</a></h1>
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
									<li> <a href='../configuracion/configuracion.php'><i class='fa fa-cog'></i> Configuración</a> </li> 
									<li> <a href='../perfil/perfil.php'><i class='fa fa-user'></i> Perfil</a> </li> 
									<li> <a href='../logout.php'><i class='fa fa-sign-out'></i> Salir</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class='clearfix'> </div>
				</div>
			</div>
			<div class='clearfix'> </div>
		</section>

";



echo $menu;


 ?>