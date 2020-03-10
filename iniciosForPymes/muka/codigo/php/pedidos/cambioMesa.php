<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$html 		= '';
$id 		= $_GET['id'];
$ajuste		= 0;

$query = mysqli_query($result, "select * from pedidos where pedido_id != '$id' and estado = 0;");
$opcion = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$opcion .= "<option value='".$row['pedido_id']."'>" . $row['nombre_pedido'] . "</option>";

 }

$html = "
<!DOCTYPE html>
<head>
<title>Cambio de mesa</title>
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
						<h1>Mesas Disponibles:</h1>
					</div>
					<div style='align-content:right;'>
						<form action='cambiarMesa.php' method='post'>
							<input type='hidden' name='pedido_id' value='$id'>
					            <div class='radio'>
						            <label style='font-size: 2.5em'>
						                <select name='nueva_mesa'>
						                	" . $opcion . "
						                </select>
						            </label>
						        </div>
						        <button type='submit' class='btn btn-default w3ls-button'>Cambiar</button> 
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