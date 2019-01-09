<?php
session_start();

if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$sede_id = $_GET['id'];

$tr = '';


$query = mysqli_query($result,"SELECT pd.pxd_id as pxd_id, pd.dia as dia, pd.precio as precio, pd.impuesto as impuesto, pd.item_id as item_id, s.nombre as nombre_sede FROM sede s INNER JOIN precio_x_dia pd ON s.sede_id = pd.sede_id WHERE pd.sede_id = '$sede_id';");

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$item = ($row['item_id'] == '1')?"Salón, mobiliario, parqueadero, iluminación decorativa, espacio al aire libre y energía":"Solo salón, mobiliario, parqueadero, iluminación decorativa, espacio al aire libre, seguridad, aseo, administrador y energía";

 	$tr .=	"<tr class='rows' id='rows'>
 				<td>" . $row['dia']			. "</td>
				<td>" . $row['precio'] 		. "</td>
				<td>" . $row['impuesto'] 	. "</td>
				<td>" . $item				. "</td>
				<td><a onclick='javascript:abrir(\"editarPrecioSede.php?id=" . $row['pxd_id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarPrecioSede.php?id=" 	. $row['pxd_id'] . "'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a></td>
			</tr>";

 }

 $query2 = mysqli_query($result,"select * from sede where sede_id = '$sede_id'");

 $row2 = $query2->fetch_assoc();
 $nombre_sede = $row2['nombre'];

if ($idrol == 1) {
	include "../menu.php";
} else if ($idrol == 2){
	include "../menu2.php";
} else {
	include "../menu3.php";
}

$html="<!DOCTYPE html>
<head>
<title>Precio de Sede</title>
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
	open(url,'','top=100,left=100,width=600,height=500') ; 
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
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Precios " . $nombre_sede . "</h2>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Día</th>
							<th>Precio</th>
							<th>Impuesto</th>
							<th>Item</th>
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
			<p>© 2017 AdminSoft . All Rights Reserved . Design by <a href='edisonosorioj.com'></a>AlDía</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
