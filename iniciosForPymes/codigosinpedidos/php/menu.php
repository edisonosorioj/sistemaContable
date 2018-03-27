<?php 

$menu = "

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
				<a href='../inicio/index.php'>
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
				</a>
			</li>
			<li>
				<a href='../inventario/inventario.php'>
					<i class='icon-font nav-icon'></i>
					<span class='nav-text'>
					Inventario
					</span>
				</a>
			</li>
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
				<h1><a href='index.html'><img src='../../images/logo.png' alt='' />Centraliza</a></h1>
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
// Modulo configuración - En construcción.
// <li> <a href='#'><i class='fa fa-cog'></i> Configuración</a> </li> 



echo $menu;


 ?>