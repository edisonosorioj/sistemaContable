<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id 		= $_GET['id'];
$mesa 		= $_GET['mesa'];

if ($id == 1) {
	$nombreGrupo = "Pizzas";
} elseif($id == 2) {
	$nombreGrupo = "Carnes";
} elseif($id == 3) {
	$nombreGrupo = "Otros";
} else {
	$nombreGrupo = "Bebidas";
}

// Consulta y por medio de un while muestra la lista de los pedidos
$query = mysqli_query($result,"select * from items where grupo = '$id';");

$div = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$nombre = $row['nombre'];
 	$iditems = $row['iditems'];

	$td = '';
 	$query2 = mysqli_query($result,"select * from precio_x_item where iditems = '$iditems';");

	 	while ($row2 = $query2->fetch_array(MYSQLI_BOTH)){

	 		$nombre2 	= $row2['nombre'];
	 		$idprecios 	= $row2['idprecios'];

	 		$td .= "<td width='100px'>
	 					<a href='#' onclick='javascript:abrir(\"detalles.php?id=" . $idprecios . "&mesa=" . $mesa . "\")'>
	 						<div class='especial'>" . $nombre2 . "</div>
	 					</a>
	 			   </td>
	 			";
	 	}

 	$div .=	"
			<tr height='50px'>
				<td style='text-align:left;width:150px'>
					<div class='especial' style='background-color:#abb6fd;'>
						$nombre
					</div>
				</td>
				" . $td . "
			</tr>
 			";
 	
 }


// Se crea el HTML con la información del Pedido
	
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
<script type='text/javascript'>
	function abrir(url) { 
		open(url,'','top=50,left=50,width=500,height=600') ; 
	}
</script>
</head>
<body class='dashboard-page'>

	<section class=''>
		<div class=''>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading'>
						<h1>$nombreGrupo</h1>
					<div>
					<button class='button' onclick='opener.location.href=\"pedido_mesa.php?id=" . $mesa . "\"; self.close();'>Listo!</button>
					<button class='button' onclick='window.close();'>Cancelar</button>
					</div>
					</div>
					<div class='center'>
						<table>
							"
							. $div . 
							"
						</table>
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