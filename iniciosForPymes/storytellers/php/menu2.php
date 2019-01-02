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
			<li>
				<a href='../agenda/agenda.php'>
					<i class='icon-table nav-icon'></i>
					<span class='nav-text'>
					Calendario
					</span>
				</a>
			</li>
			<li>
				<a href='../cliente/cliente.php'>
					<i class='fa fa-heart nav-icon'></i>
					<span class='nav-text'>Clientes</span>
				</a>
			</li>
			<li>
				<a href='../eventos/cotizacion.php'>
					<i class='fa fa-file-text-o nav_icon'></i>
					<span class='nav-text'>
					Cotizaciones
					</span>
				</a>
			</li>	
			<li>
				<a href='../eventos/eventos.php'>
					<i class='fa fa-file-text-o nav_icon'></i>
					<span class='nav-text'>
					Eventos
					</span>
				</a>
			</li>	
			<li>
				<a href='../proveedores/proveedores.php'>
					<i class='fa fa-shopping-cart nav-icon'></i>
					<span class='nav-text'>Proveedores</span>
				</a>
			</li>
			<li>
				<a href='../inventario/inventario.php'>
					<i class='fa fa-list-ul'></i>
					<span class='nav-text'>
					Inventario
					</span>
				</a>
			</li>
			<li>
				<a href='../lista_precios/lista_precios.php'>
					<i class='fa fa-usd nav-icon'></i>
					<span class='nav-text'>
					Lista de Precios
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
				<h1><img src='../../images/logo.png' alt='' /></h1>
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



echo $menu;


 ?>