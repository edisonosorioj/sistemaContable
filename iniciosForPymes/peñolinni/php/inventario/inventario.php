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
$total = '';
$sumtotal = '';

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}

$query = mysqli_query($result,'select * from productos where idproductos != 0 order by idproductos');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){


	$sumtotal=$row['disponible']*$row['valor'];

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idproductos'] 		. "</td>
				<td>" . $row['fecha'] 				. "</td>
				<td>" . $row['nombre'] 				. "</td>
				<td>" . $row['disponible'] 			. "</td>
				<td>$ " . number_format($row['valor'], 0, ",", ".") 		. "</td>
				<td>$ " . number_format($sumtotal, 0, ",", ".") 	. "</td>
				<td><a onclick='javascript:abrir(\"editarProductos.php?id=" . $row['idproductos'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarProductos.php?id=" . $row['idproductos'] . "'><span data-tooltip='Eliminar'>
				<i class='fa icon-off'></i></spam></a></td>
			</tr>";

 	$total = ((int)$total+(int)$sumtotal);
 }

$total = ($total > 0) ? $total = $total : $total = 0;

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
					<h2>Inventario</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/inventario/nuevoProducto.html\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					  	<h3>Total Inventario: $ " . number_format($total, 0, ",", ".") . "</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Fecha</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Valor</th>
							<th>Total</th>
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

