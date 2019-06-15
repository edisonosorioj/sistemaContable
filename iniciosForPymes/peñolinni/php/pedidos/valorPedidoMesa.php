<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$html 		= '';
$id 		= $_GET['id'];

$query3 = mysqli_query($result, "select count(*) as conteo from pedidoProductos where pedido_id = '$id' and producto like '%- Media%' and registro_id is null;");
$row3	= $query3->fetch_assoc();

$conteo	= $row3['conteo'];

if (($conteo == 2) || ($conteo == 4) || ($conteo == 6)) {
	# code...
} else {
	# code...
}


$query2 = mysqli_query($result, "select sum(valort) as total from pedidoProductos where pedido_id = '$id' and registro_id is null;");
$row2	= $query2->fetch_assoc();

$valor_pedido	= $row2['total'];

$html = "
<!DOCTYPE html>
<head>
<title>Pedidos</title>
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
						<h1>El total de la cuenta es:</h1>
					</div>
					<div style='align-content:right;'>
						<form action='pagarPedidoMesa.php' method='post'>
					            <div class='radio'>
						            <label style='font-size: 2.5em'>
						                <h2>$valor_pedido</h2>
						            </label>
						        </div>
						        <button type='submit' class='btn btn-default w3ls-button'>Pagar</button> 
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