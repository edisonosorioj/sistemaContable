<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
$td = '';
$div = '';
$id = $_GET['id'];

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}


// Consulta y por medio de un while muestra la lista de los pedidos

$query2 = mysqli_query($result,"select * from precio_x_item where iditems = '$id';");

while ($row2 = $query2->fetch_array(MYSQLI_BOTH)){

	$nombre2 	= $row2['nombre'];
	$idprecios 	= $row2['idprecios'];
	$valor 		= $row2['valor'];
	$iditems 	= $row2['iditems'];

	$td .= "<td width='100px'>
				<a href='#' onclick='javascript:abrir(\"detalles.php?id=" . $idprecios . "\")'>
					<div class='especial'>" . $nombre2 . " - " . $valor . "</div>
				</a>
		   </td>
		";
}



if ($iditems == 1) {
	$nombreGrupo = "Pizzas";
} elseif($iditems == 2) {
	$nombreGrupo = "Carnes";
} elseif($iditems == 3) {
	$nombreGrupo = "Otros";
} else {
	$nombreGrupo = "Bebidas";
}

$html="<!DOCTYPE html>
<head>
<title>Inventario</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
<!-- tables -->
<link rel='stylesheet' type='text/css' href='../../css/table-style.css' />
<link rel='stylesheet' type='text/css' href='../../css/basictable.css' />
<script type='text/javascript' src='../../js/jquery.basictable.min.js'></script>
<script>
    var theme = $.cookie('protonTheme') || 'default';
    $('body').removeClass (function (index, css) {
        return (css.match (/\btheme-\S+/g) || []).join(' ');
    });
    if (theme !== 'default') $('body').addClass(theme);
</script>
<script type='text/javascript'>
    $(document).ready(function() {
      $('#table').basictable();
    }); 
	function abrir(url) { 
	open(url,'','top=100,left=100,width=900,height=500') ; 
	}
</script>
<script>
function confirmar(texto)
{
if (confirm(texto))
{
return true;
}
else return false;
}
</script>
<!-- //tables -->
</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>$nombreGrupo</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary hvr-icon-pulse col-11' onClick=' window.location.href=\"../cliente/cliente.php\" '>Volver</button>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/productos/nuevoItem.html\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='center'>
						<table>
							<tr>
								"
								. $td . 
								"
							</tr>
						</table>
					</div> 
				</div>
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2019 ForPymes. All Rights Reserved . Design by <a href='https://forpymes.co'></a>ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;

