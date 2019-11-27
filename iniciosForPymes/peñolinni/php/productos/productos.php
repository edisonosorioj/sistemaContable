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
$conteo = 1;

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}

$query = mysqli_query($result,'SELECT i.iditems as iditems, i.nombre as nombre, i.grupo as grupo, i.estado as estado, p.idprecios as idprecios FROM items i INNER JOIN precio_x_item p ON i.iditems = p.iditems WHERE i.iditems != 0 GROUP BY i.iditems ORDER BY i.iditems');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 $estado = ($row['estado'] == 1) ? 'Activo' : 'Inactivo';

 if ($row['grupo'] == 1) {
	$nombreGrupo = "Pizzas";
} elseif($row['grupo'] == 2) {
	$nombreGrupo = "Carnes";
} elseif($row['grupo'] == 3) {
	$nombreGrupo = "Otros";
} else {
	$nombreGrupo = "Bebidas";
}

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $conteo	. "</td>
				<td>" . $row['nombre'] 		. "</td>
				<td>" . $estado 			. "</td>
				<td>" . $nombreGrupo 		. "</td>
				<td><a href='verItem.php?id=" . $row['iditems'] . "'><span data-tooltip='Tipos'><i class='fa fa-file'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarItem.php?id=" . $row['iditems'] . "'><span data-tooltip='Eliminar'>
				<i class='fa icon-off'></i></spam></a></td>
			</tr>";

	$conteo++;

 }

$html="<!DOCTYPE html>
<head>
<title>Productos</title>
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
					<h2>Productos</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/productos/nuevoProducto.html\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Producto</th>
							<th>Estado</th>
							<th>Grupo</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr . 
						  "
						</tbody>
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

