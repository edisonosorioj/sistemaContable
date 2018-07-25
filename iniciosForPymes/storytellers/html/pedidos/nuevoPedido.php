<?php
if( !session_id() )
{
    session_start();
}
require_once '../../php/conexion.php';

$conex = new conection();
$result = $conex->conex();

$option='';

$query = mysqli_query($result,'select * from clientes order by id');

while ($row = $query->fetch_array()){

	 	$option .=	"<option value='" . $row['id'] . "'>" . $row['nombres'] . "</option>";
	}

$option2='';

$query3 = mysqli_query($result,'select * from sede order by sede_id');

while ($row3 = $query3->fetch_array()){

	 	$option2 .=	"<option value='" . $row3['sede_id'] . "'>" . $row3['nombre'] . "</option>";
	}

$instalaciones='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 1');

while ($row4 = $query3->fetch_array()){

	 	$instalaciones .=	"<option value='" . $row4['id'] . "'>" . $row4['descripcion'] . "</option>";
	}


$html = "<!DOCTYPE html>
<head>
<title>Nueva Cotizaci&oacute;n</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='' />
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
		
</head>
<body class='dashboard-page'>

	<section class='wrapper scrollable'>
		<nav class='user-menu'>
			<a href='javascript:;' class='main-menu-access'>
			<i class='icon-proton-logo'></i>
			<i class='icon-reorder'></i>
			</a>
		</nav>
		<div class='grid_3 grid_5 wow fadeInUp animated' data-wow-delay='.5s'>
			<div class='bs-example bs-example-tabs' role='tabpanel' data-example-id='togglable-tabs'>

				<ul id='myTab' class='nav nav-tabs' role='tablist'>
					<li role='presentation' class='active'><a href='#home' id='home-tab' role='tab' data-toggle='tab' aria-controls='home' aria-expanded='true'>Cliente Existente</a></li>
					<li role='presentation'><a href='#profile' role='tab' id='profile-tab' data-toggle='tab' aria-controls='profile'>Nuevo Cliente</a></li>
				</ul>

				<div id='myTabContent' class='tab-content'>
					<div role='tabpanel' class='tab-pane fade in active' id='home' aria-labelledby='home-tab'>

						<div class='main-grid'>
							<div class='agile-grids'>	
								<!-- input-forms -->
								<div class='grids'>
									<div class='progressbar-heading grids-heading'>
										<h2>Nueva Cotizaci&oacute;n</h2>
									</div>
									<div class='panel panel-widget forms-panel'>
										<div class='forms'>
											<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
												<div class='form-title'>
													<h4>Datos Básicos</h4>
												</div>
												<div class='form-body'>
													<form action='../../php/eventos/addPedido.php' method='post'> 
														<div class='form-group'> 
															<label>Fecha Inicio</label> 
															<input type='date' name='start'> 
															<input type='time' name='hora_i' value='06:00:00' step='1'> 
														</div>
														<div class='form-group'> 
															<label>Fecha Final</label> 
															<input type='date' name='end'> 
															<input type='time' name='hora_f' value='06:00:00' step='1'> 
														</div>
														<div class='form-group'> 
															<label>Nombre</label> 
															<select name='cliente' class='form-control1'>
																" . $option . "
															</select>
														</div>
														<div class='form-group'> 
															<label>Sede</label> 
															<select name='sede' class='form-control1'>
																" . $option2 . "
															</select>
														</div>
														<div class='form-group'> 
															<label>Tipo de Evento</label> 
															<input type='text' name='evento' class='form-control' placeholder='Tipo de Evento'> 
														</div>
														<div class='form-group'> 
															<label>Numero de Invitados</label> 
															<input type='text' name='invitados' class='form-control' placeholder='Invitados'> 
														</div>
														<div class='form-group'> 
															<label>Instalaciones:</label>
															<select name='instalaciones' class='form-control1'>
																<option value='Seleccione'>Seleccione instalaciones</option>
																" . $instalaciones . "
															</select>
														</div>

														<button type='submit' class='btn btn-default w3ls-button'>Guardar</button> 
														<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button> 
													</form> 
												</div>
											</div>
										</div>
									</div>

								</div>
								<!-- //input-forms -->
							</div>
						</div>
					</div>

					<div role='tabpanel' class='tab-pane fade' id='profile' aria-labelledby='profile-tab'>

						<div class='main-grid'>
							<div class='agile-grids'>	
								<!-- input-forms -->
								<div class='grids'>
									<div class='progressbar-heading grids-heading'>
										<h2>Nueva Cotizaci&oacute;n</h2>
									</div>
									<div class='panel panel-widget forms-panel'>
										<div class='forms'>
											<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
												<div class='form-title'>
													<h4>Datos Básicos</h4>
												</div>
												<div class='form-body'>
													<form action='../../php/eventos/addPedidoCliente.php' method='post'> 
														<div class='form-group'> 
															<label>Fecha Inicio</label> 
															<input type='date' name='start' require/> 
															<input type='time' name='hora_i' value='06:00:00' step='1' require/> 
														</div>
														<div class='form-group'> 
															<label>Fecha Final</label> 
															<input type='date' name='end' require/> 
															<input type='time' name='hora_f' value='06:00:00' step='1'> 
														</div>
														<div class='form-group'> 
															<label>Cliente</label> 
															<input type='text' name='cliente' class='form-control' placeholder='Cliente'> 
														</div>
														<div class='form-group'> 
															<label>Empresa</label> 
															<input type='text' name='empresa' class='form-control' placeholder='Empresa'> 
														</div>
														<div class='form-group'> 
															<label>CC / NIT</label> 
															<input type='text' name='documento' class='form-control' placeholder='CC / NIT'> 
														</div>
														<div class='form-group'> 
															<label>Teléfono</label> 
															<input type='text' name='telefono' class='form-control' placeholder='Teléfono'> 
														</div>
														<div class='form-group'> 
															<label>Dirección</label> 
															<input type='text' name='direccion' class='form-control' placeholder='Dirección'> 
														</div>
														<div class='form-group'> 
															<label>Ciudad</label> 
															<input type='text' name='ciudad' class='form-control' placeholder='Ciudad'> 
														</div>
														<div class='form-group'> 
															<label>Email</label> 
															<input type='text' name='correo' class='form-control' placeholder='Email'> 
														</div>
														<div class='form-group'> 
															<label>Sede</label> 
															<select name='sede' class='form-control1'>
																" . $option2 . "
															</select>
														</div>
														<div class='form-group'> 
															<label>Tipo de Evento</label> 
															<input type='text' name='evento' class='form-control' placeholder='Tipo de Evento'> 
														</div>
														<div class='form-group'> 
															<label>Numero de Invitados</label> 
															<input type='text' name='invitados' class='form-control' placeholder='Invitados'> 
														</div>
														<div class='form-group'> 
															<label>Instalaciones:</label>
															<select name='instalaciones' class='form-control1'>
																<option value='Seleccione'>Seleccione instalaciones</option>
																" . $instalaciones . "
															</select>
														</div>

														<button type='submit' class='btn btn-default w3ls-button'>Guardar</button> 
														<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button> 
													</form> 
												</div>
											</div>
										</div>
									</div>

								</div>
								<!-- //input-forms -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;
