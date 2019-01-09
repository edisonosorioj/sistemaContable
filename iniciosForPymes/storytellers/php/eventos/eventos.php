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
// Consulta y por medio de un while muestra la lista de los pedidos de EVENTO FINALIZADOS

$query2 = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.estado = 1 and p.start < NOW() ORDER BY p.start ASC');

$tr2 = '';

 while ($row2 = $query2->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row2['estado'] == '0')?"Pendiente":"Realizado";
 	$t_costo2 = ($row2['t_costo'] == '')?0:$row2['t_costo'];

 	$tr2 .=	"<tr class='rows' id='rows'>
				<td>" . $row2['nombres'] 					. "</td>
				<td><a href='pedidoProductos.php?id=" . $row2['pedido_id'] . "'>" . $row2['nombre_pedido'] 	. "</a></td>
				<td  align='right'>$ " . number_format($t_costo2, 0, ",", ".")	. "</td>
				<td>" . $row2['start']						. "</td>
				<td>" . $row2['end']						. "</td>
				<td>" . $estado								. "</td>
				<td><a onclick='javascript:abrir(\"editarPedido.php?id=" . $row2['pedido_id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a href='pedidoProductos.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Revisar'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a href='../minuto_a_minuto/minuto_a_minuto.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Minuto'><i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarPedido.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off'></i></a>
				</td>
			</tr>";

 }

// Consulta y por medio de un while muestra la lista de los pedidos. EVENTOS CONFIRMADOS
$query = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.estado = 1 and p.start > NOW() ORDER BY p.start ASC;');

$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row['estado'] == '0')?"Pendiente":"Realizado";
 	$t_costo = ($row['t_costo'] == '')?0:$row['t_costo'];

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['nombres'] 		. "</td>
				<td><a href='pedidoProductos.php?id=" . $row['pedido_id'] . "'>" . $row['nombre_pedido'] 	. "</a></td>
				<td  align='right'>$ " . number_format($t_costo, 0, ",", ".") 	. "</td>
				<td>" . $row['start']	. "</td>
				<td>" . $row['end']	. "</td>
				<td>" . $estado	. "</td>
				<td><a onclick='javascript:abrir(\"editarPedido.php?id=" . $row['pedido_id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a href='pedidoProductos.php?id=" . $row['pedido_id'] . "'><span data-tooltip='Revisar'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a href='../minuto_a_minuto/minuto_a_minuto.php?id=" . $row['pedido_id'] . "'><span data-tooltip='Minuto'><i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarPedido.php?id=" . $row['pedido_id'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off'></i></a>
				</td>
			</tr>";

 }

$html="<!DOCTYPE html>
<head>
<title>Eventos</title>
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
	open(url,'','top=100,left=100,width=900,height=700') ; 
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
				<div class='footer col-md-12'>
					<h2>Eventos Confirmados</h2>
				</div>

				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Cliente</th>
							<th>Tipo de Evento</th>
							<th>Valor</th>
							<th>Inicia</th>
							<th>Finaliza</th>
							<th>Estado</th>
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

				<div class='footer col-md-12'>
					<h2>Eventos Finalizados</h2>
				</div>

				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Cliente</th>
							<th>Tipo de Evento</th>
							<th>Valor</th>
							<th>Inicio</th>
							<th>Finalizo</th>
							<th>Estado</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr2 . 
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
			<p>© 2018 ForPymes. All Rights Reserved</p>
		</div>
		<!-- //footer -->
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
