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

$show = '';

if ($idrol == 1) {
	include "../menu.php";
} else if ($idrol == 2){
	include "../menu2.php";
} else {
	include "../menu3.php";
}

// Consulta y por medio de un while muestra la lista de los pedidos. EVENTOS HOY

$query2 = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.start BETWEEN CURDATE() AND NOW() and estado = 1');

$tr2 = '';

 while ($row2 = $query2->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row2['estado'] == '0')?"Pendiente":"Realizado";

 	$tr2 .=	"<tr class='rows' id='rows'>
				<td>" . $row2['nombres'] 					. "</td>
				<td><a href='../eventos/pedidoProductos.php?id=" . $row2['pedido_id'] . "'>" . $row2['nombre_pedido'] 				. "</a></td>
				<td  align='right'>$ " . number_format($row2['t_costo'], 0, ",", ".")	. "</td>
				<td>" . $row2['start']						. "</td>
				<td>" . $row2['end']						. "</td>
				<td>" . $estado								. "</td>
				<td>&nbsp;&nbsp;
				<a href='../eventos/pedidoProductos.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Ver Detalles'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				</td>
			</tr>";

 }

// Consulta y por medio de un while muestra la lista de los pedidos. PROXIMOS EVENTOS
$query = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.start > NOW() and estado = 1 ORDER BY p.start ASC;');

$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row['estado'] == '0')?"Pendiente":"Realizado";

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['nombres'] 		. "</td>
				<td><a href='../eventos/pedidoProductos.php?id=" . $row['pedido_id'] . "'>" . $row['nombre_pedido'] 				. "</a></td>
				<td  align='right'>$ " . number_format($row['t_costo'], 0, ",", ".") 	. "</td>
				<td>" . $row['start']	. "</td>
				<td>" . $row['end']	. "</td>
				<td>" . $estado	. "</td>
				<td>&nbsp;&nbsp;
				<a href='../eventos/pedidoProductos.php?id=" . $row['pedido_id'] . "'><span data-tooltip='Ver Detalles'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				</td>
			</tr>";

 }


$html="<!DOCTYPE html>
<head>
<title>Wink</title>
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
<link rel='icon' href='../../images/fav.ico'>
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
				<!-- grids -->
				<div class='grids'>
					
					<div class='progressbar-heading grids-heading'>
						<h2>Inicio</h2>
					</div>
					
					<div class='panel panel-widget top-grids'>
						<div class='chute chute-center text-center'>
							<div class='row mb40'>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../agenda/agenda.php\"' class='btn btn-primary btn-block'>Calendario</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../cliente/cliente.php\"' class='btn btn-primary btn-block'>Clientes</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../eventos/cotizacion.php\"'class='btn btn-primary btn-block'>Cotizaciones</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../eventos/eventos.php\"' class='btn btn-primary btn-block'>Eventos</button>
									</div>
								</div>
							</div>
							<div class='row mb40'>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../proveedores/proveedores.php\"' class='btn btn-primary btn-block'>Proveedores</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../inventario/inventario.php\"' class='btn btn-primary btn-block'>Inventario</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../lista_precios/lista_precios.php\"' class='btn btn-primary btn-block'>Lista de Precios</button>
									</div>
								</div>
								<div class='col-md-3 mb5'>
									<div class='demo-grid'>
										<button type='button' onclick='window.location.href=\"../configuracion/configuracion.php\"' class='btn btn-primary btn-block'>Configuración</button>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- //grids -->
			</div>
		</div>
	<!-- footer -->
	<div class='footer'>
		<p>© 2019 Wink. All Rights Reserved. Design by ForPymes</p>
	</div>
	<!-- //footer -->
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
