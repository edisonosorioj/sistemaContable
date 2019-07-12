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

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}

// Consulta y por medio de un while muestra la lista de los pedidos
$query = mysqli_query($result,'select p.cliente_id, p.pedido_id as pedido_id, c.nombres as nombres, p.nombre_pedido as nombre_pedido, p.t_costo, p.t_cobrado, p.fecha, p.estado from pedidos p inner join clientes c on p.cliente_id = c.id order by p.pedido_id ASC;');

$div = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	if($row['estado'] == '0'){
 		$colorEstado = 'gray';
 	}elseif ($row['estado'] == '1') {
 		$colorEstado = 'green';
 	}else{
 		$colorEstado = 'blue';
 	}

 	if($row['estado'] == '0'){
 		$estado = 'Vacia';
 	}elseif ($row['estado'] == '1') {
 		$estado = 'Orden Tomada';
 	}else{
 		$estado = 'Orden Lista';
 	}

 	$nombre_mesa = $row['nombre_pedido'];

 	$costo 		= ($row['t_costo'] 		== null)	?	0				:$row['t_costo'];
 	$cobrado 	= ($row['t_cobrado'] 	== null)	?	0				:$row['t_cobrado'];

 	$div .=	"<a href='pedido_mesa.php?id=" . $row['pedido_id'] . "'>
 			<div class='mesas " . $colorEstado . "'>
 				<h1>$nombre_mesa</h1>
 				<p>$estado</p>
 				<a href='pedido_mesa.php?id=" . $row['pedido_id'] . "'><span>
					VER ORDEN</spam></a>
 			</div></a>";
 	
 }

$html="<!DOCTYPE html>
<head>
<title>Pedidos Mesas</title>
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
<link rel='stylesheet' type='text/css' href='../../css/style.css' />
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
<body class='dashboard-page center'>

		<div>
			<div>	
				
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/pedidos/nuevoPedido.php\")'>Nueva Mesa</button>
				</div>
				<div class='table-heading col-md-8'>
					<h2>Pedidos en Mesas</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:window.location.reload();'>Recargar</button>
				</div>
				<div>
					<div>
						  " 
						  . $div . 
						  "
					</div>
				</div>
				<!-- //tables -->
			</div>
		</div>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
