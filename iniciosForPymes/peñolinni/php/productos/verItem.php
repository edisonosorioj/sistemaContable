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
$tr = '';
$div = '';
$id = $_GET['id'];
$conteo = 1;

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

	$idprecios 	= $row2['idprecios'];
	$nombre2 	= $row2['nombre'];
	$valor 		= $row2['valor'];
	$iditems 	= $row2['iditems'];

	$tr .= "<tr class='rows' id='rows'>
				<td>" . $conteo . "</td>
				<td>" . $nombre2 . "</td>
			   	<td>" . $valor . "</td>
			   	<td><a onclick='javascript:abrir(\"editarItem.php?id=" . $row2['idprecios'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarItem.php?id=" . $idprecios . "'><span data-tooltip='Eliminar'>
				<i class='fa icon-off'></i></spam></a></td>
			</tr>";
	$conteo++;
	}


// Utilizamos esta consulta para obtener el nombre del Item
$query2 = mysqli_query($result, "select nombre from items where iditems = '$id'");

$row2=$query2->fetch_assoc();

$nombre_item = $row2['nombre'];

if ($id == 1) {
	$nombreGrupo = "Pizzas";
} elseif($id == 2) {
	$nombreGrupo = "Carnes";
} elseif($id == 3) {
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
					<h2>$nombreGrupo - $nombre_item</h2>
				</div>
				<div class='bs-component mb20 col-md-8'>
					<button type='button' class='btn btn-primary hvr-icon-pulse col-11' onClick='window.location.href=\"productos.php\" '>Volver</button>
					<button type='button' class='btn btn-primary hvr-icon-float-away col-11' onclick='javascript:abrir(\"../../html/productos/nuevoItem.php?id=" . $id . "\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
						<table>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Valor</th>
								<th>Acciones</th>
							</tr>
							"
							. $tr . 
							"
						</table>
					</div> 
				</div>
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© " . date('Y') . " ForPymes. All Rights Reserved . Design by <a href='https://forpymes.co'></a>ForPymes</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;

