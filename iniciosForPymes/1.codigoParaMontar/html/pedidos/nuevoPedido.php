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

	 	$option .=	"<option value='" . $row['nombres'] . "'>" . $row['nombres'] . "</option>";
	}


$html = "<!DOCTYPE html>
<head>
<title>Nuevo Pedido</title>
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
				<div id='myTabContent' class='tab-content'>
					<div role='tabpanel' class='tab-pane fade in active' id='home' aria-labelledby='home-tab'>
					
						<div class='main-grid'>
							<div class='agile-grids'>	
								<!-- input-forms -->
								<div class='grids'>
									<div class='progressbar-heading grids-heading'>
										<h2>Nuevo Pedido</h2>
									</div>
									<div class='panel panel-widget forms-panel'>
										<div class='forms'>
											<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
												<div class='form-title'>
													<h4>Datos Básicos</h4>
												</div>
												<div class='form-body'>
													<form action='../../php/pedidos/addPedido.php' method='post'> 
														<div class='form-group'> 
															<label>Fecha</label> 
															<input type='date' name='fecha' class='form-control'> 
														</div>
														<div class='form-group'> 
															<label>Cliente</label> 
															<select name='cliente' class='form-control1'>
																" . $option . "
															</select>
														</div>
														<div class='form-group'> 
															<label>Nombre</label> 
															<input type='text' name='nombre' class='form-control' placeholder='Nombre'> 
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
