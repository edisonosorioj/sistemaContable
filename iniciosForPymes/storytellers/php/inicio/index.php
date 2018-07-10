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

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Consulta y por medio de un while muestra la lista de los pedidos

$query2 = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.start BETWEEN CURDATE() AND NOW()');

$tr2 = '';

 while ($row2 = $query2->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row2['estado'] == '0')?"Pendiente":"Realizado";

 	$tr2 .=	"<tr class='rows' id='rows'>
				<td>" . $row2['nombres'] 					. "</td>
				<td>" . $row2['nombre_pedido'] 				. "</td>
				<td  align='right'>$ " . $row2['t_costo'] 	. "</td>
				<td>" . $row2['start']						. "</td>
				<td>" . $row2['end']						. "</td>
				<td>" . $estado								. "</td>
				<td>&nbsp;&nbsp;
				<a href='pedidoProductos.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Ver Detalles'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				</td>
			</tr>";

 }

// Consulta y por medio de un while muestra la lista de los pedidos
$query = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido, p.t_costo, p.start, p.end, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id where p.start > NOW() ORDER BY p.start ASC;');

$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row['estado'] == '0')?"Pendiente":"Realizado";

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['nombres'] 		. "</td>
				<td>" . $row['nombre_pedido'] 	. "</td>
				<td  align='right'>$ " . $row['t_costo'] 	. "</td>
				<td>" . $row['start']	. "</td>
				<td>" . $row['end']	. "</td>
				<td>" . $estado	. "</td>
				<td>&nbsp;&nbsp;
				<a href='pedidoProductos.php?id=" . $row2['pedido_id'] . "'><span data-tooltip='Ver Detalles'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
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
				
				<div class='footer col-md-12' $show>
					<h2>Eventos de hoy</h2>
				</div>
				<div class='agile-tables' $show>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Cliente</th>
							<th>Nombre Evento</th>
							<th>Valor</th>
							<th>Inicia</th>
							<th>Finaliza</th>
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

				<div class='footer'>
					<h2>Pr&oacute;ximos Eventos</h2>
				</div>

				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Cliente</th>
							<th>Nombre Evento</th>
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
