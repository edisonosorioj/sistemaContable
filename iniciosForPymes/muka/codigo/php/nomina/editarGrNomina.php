<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();

// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from grupoNomina where idgrupo ='$id'");

$row = $query->fetch_assoc();

$idnomina 		= $row['idnomina'];
$idusuario 		= $row['idusuario'];
$auxilio 		= number_format($row['auxilio'], 0, ",", ".");
$compensacion 	= number_format($row['compensacion'], 0, ",", ".");
$salud 			= number_format($row['salud'], 0, ",", ".");
$pension 		= number_format($row['pension'], 0, ",", ".");
$prestamo 		= number_format($row['prestamos'], 0, ",", ".");
$pago_total 	= $row['pago_total'];
$dias 			= $row['dias'];
$nuevoDias		= 30;

$deducciones = $row['salud'] + $row['pension'] + $row['prestamos'];
$deducciones = number_format($deducciones, 0, ",", ".");


$pago_total = number_format($pago_total, 0, ",", ".");

$query3 = mysqli_query($result, "select * from nomina where idnomina = '$idnomina'");

$row3 = $query3->fetch_assoc();

$estado = $row3['estado'];

if ($estado == 1) {
	 
	$msg = "La nomina ya fue realizada, no es posible cambiar los usuarios. Si desea cambiarlos debe cancelarlo primero y realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";

	echo $html;	
}else{

$query2 = mysqli_query($result, "select * from usuarios where iduser = '$idusuario'");

$row2 = $query2->fetch_assoc();

$nombres 		= $row2['nombre'] . ' ' . $row2['apellido'];
$valor_nomina 	= number_format($row2['valor_nomina'], 0, ",", ".");
$documento	 	= $row2['documento'];
	
$devengado = ($row2['valor_nomina']/$nuevoDias)*$dias;
$devengado = number_format($devengado, 0, ",", ".");

$html = "
<!-- Se crea el HTML con la información de la Nomina -->
<!DOCTYPE html>
<head>
<title>Editar Nomina de Usuario</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Administración de Negocios, Admin, Negocios' />
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
</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

	<section class='wrapper scrollable'>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Editar Nomina Usuario</h2>
					</div>
					<div class='panel panel-widget forms-panel'>
						<div class='forms'>
							<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
								<div class='form-title'>
									<h4>Datos Básicos :</h4>
								</div>
								<div class='form-body'>
									<form action='actGrNomina.php' method='post'>

										<div class='form-group'> 
											<input type='hidden' name='id' value='$id' class='form-control'> 
										</div>
										<div class='form-group'> 
											<label>Valor Nómina</label> 
											<input type='text' name='nomina' class='form-control' value='$valor_nomina'> 
										</div> 
										<div class='form-group'> 
											<label>Días laborados</label> 
											<input type='text' name='dias' class='form-control' value='$dias'>
										</div> 
										<div class='form-group'> 
											<label>Devengado</label> 
											<input type='text' name='devengado' class='form-control' value='$devengado' disabled> 
										</div>
										<div class='form-group'> 
											<label>Auxilio de Transporte</label> 
											<input type='text' name='auxilio' class='form-control' placeholder='Auxilio de Transporte' value='$auxilio'> 
										</div>
										<div class='form-group'> 
											<label>Compensación</label> 
											<input type='text' name='compensacion' class='form-control' placeholder='Compensacion' value='$compensacion'> 
										</div>
										<div class='form-group'> 
											<label>Salud 4%</label> 
											<input type='text' name='salud' class='form-control' placeholder='Salud' value='$salud'> 
										</div>
										<div class='form-group'> 
											<label>Pensión 4%</label> 
											<input type='text' name='pension' class='form-control' placeholder='Pension' value='$pension'> 
										</div>
										<div class='form-group'> 
											<label>Prestamos</label> 
											<input type='text' name='prestamos' class='form-control' placeholder='Prestamos' value='$prestamo'> 
										</div>
										<div class='form-group'> 
											<label>Total Pago</label> 
											<input type='text' name='pago_total' class='form-control' placeholder='Pago Total' value='$pago_total' disabled> 
										</div>

										<button type='submit' class='btn btn-default w3ls-button'>Actualizar</button> 
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
}