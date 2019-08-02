<?php
	
require_once "../../php/conexion.php";

$conex = new conection();
$result = $conex->conex();

date_default_timezone_set('America/Lima');

// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$html 		= '';
$fecha 		= date('Y-m-d');

if ($fecha == date('Y-m-d')) {
	
	$html = 'No es posible hacer otro cuadre el día de hoy. Elimina el registro anterior e intenta de nuevo.';

	$html .= "<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button>";

	echo $html;
	
}else{

	$query = mysqli_query($result, "select sum(valor) as ingresos from ingresos where fecha = '$fecha';");
	$row	= $query->fetch_assoc();

	$ingresos	= $row['ingresos'];

	$query1 = mysqli_query($result, "select sum(valor) as compras from compras where fecha = '$fecha';");
	$row1	= $query1->fetch_assoc();

	$compras	= $row1['compras'];

	$balance = $ingresos - $compras;

	$html = "
	<!DOCTYPE html>
	<head>
	<title>Cuadre Caja</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name='keywords' content='Administración de Negocios, Admin, Negocios' />
	<!-- bootstrap-css -->
	<link rel='stylesheet' href='../../css/bootstrap.css'>
	<!-- //bootstrap-css -->
	<link rel='stylesheet' type='text/css' href='../../css/style3.css' />
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
	<body>
		<section>
			<div>
				<div class='agile-grids'>	
					<!-- input-forms -->
					<div class='grids'>
						<div class='progressbar-heading'>
							<h1>Cuadre de Caja</h1>
							<p>Fecha: " . $fecha . "</p>
							<p>Balance: " . $balance . "</p>
						</div>
						<div style='align-content:right;'>
							<form action='../../php/informes/addCruadreCaja.php' method='post'>
								<input type='hidden' name='balance' value='" . $balance . "'>
						            <div class='radio'>
							            <label style='font-size: 2.5em'>
							            	$<input type='text' name='cuadre' />
							            </label>
							        </div>
							        <button type='submit' class='btn btn-default w3ls-button'>Guardar</button>
									<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button> 
							</form>
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
