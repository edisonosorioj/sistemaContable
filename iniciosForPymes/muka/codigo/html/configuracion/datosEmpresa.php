<?php

require_once "../../php/conexion.php";

$conex = new conection();
$result = $conex->conex();

$query4 = mysqli_query($result, "select * from variables;");

$rows = mysqli_num_rows ($query4);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row4 = mysqli_fetch_array($query4);  
        $rows4[$i] = $row4["nombre"];  
        $datos[$rows4[$i]] = $row4["detalle"];  
    }  
              
}  

$nombre_empresa 	= $datos['empresa'];
$tipo 				= $datos['tipo_identificacion'];
$identificacion		= $datos['identificacion'];
$forma_de_pago		= $datos['forma_de_pago'];
$lugar_expedicion	= $datos['lugar_expedicion'];
$cel				= $datos['cel'];
$tel				= $datos['tel'];



$html = "<!DOCTYPE html>
<head>
<title>Actualización Datos</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='AdminSoft' />
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
<body class='dashboard-page' style='overflow: scroll !important;'>

	<section class='wrapper scrollable'>
		<nav class='user-menu'>
			<a href='javascript:;' class='main-menu-access'>
			<i class='icon-proton-logo'></i>
			<i class='icon-reorder'></i>
			</a>
		</nav>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Actualización de Datos</h2>
					</div>
					<div class='panel panel-widget forms-panel'>
						<div class='forms'>
							<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
								<div class='form-title'>
									<h4>Datos Básicos :</h4>
								</div>
								<div class='form-body'>
									<form action='../../php/configuracion/actDatosEmpresa.php' method='post'> 
										<div class='form-group'> 
											<label>Nombre Persona Natural o Empresa</label> 
											<input type='text' name='n_empresa' class='form-control' placeholder='Nombre Empresa' value='$nombre_empresa'> 
										</div>
										<div class='form-group'> 
											<label>Tipo de Identificación</label> 
											<input type='text' name='t_identificacion' class='form-control' placeholder='Tipo Identificación' value='$tipo'> 
										</div>
										<div class='form-group'> 
											<label>Identificación</label> 
											<input type='text' name='identificacion' class='form-control' placeholder='Numero de Identificación' value='$identificacion'> 
										</div>
										<div class='form-group'> 
											<label>Lugar de Expedición del Documento</label> 
											<input type='text' name='l_expedicion' class='form-control' placeholder='Lugar de Expedición' value='$lugar_expedicion'> 
										</div> 
										<div class='form-group'> 
											<label>Detalles</label> 
											<input type='text' name='forma_pago' class='form-control' placeholder='Forma de Pago' value='$forma_de_pago'> 
										</div> 
										<div class='form-group'> 
											<label>Telefono Fijo</label> 
											<input type='text' name='fijo' class='form-control' placeholder='Tel. Fijo' value='$tel'> 
										</div> 
										<div class='form-group'> 
											<label>Telefono Celular</label> 
											<input type='text' name='celular' class='form-control' placeholder='No. Celular' value='$cel'> 
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
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;
