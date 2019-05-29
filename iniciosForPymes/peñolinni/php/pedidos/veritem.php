<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from items where grupo ='$id'");

$row = $query->fetch_assoc();

$idnomina 		= $row['idnomina'];


// Se crea el HTML con la información del Pedido
	
$html = "
<!DOCTYPE html>
<head>
<title>Información Nomina</title>
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
<body class='dashboard-page'>

	<section class='wrapper scrollable'>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>$nombreGrupo</h2>
					</div>
					<form action='addPedidoMesa.php?id=$id' method='post'>
						
						<button type='submit' class='btn btn-default w3ls-button'>Cambiar</button> 
						<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cerrar</button> 
					</form> 
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