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
//* Consulta y por medio de un while muestra la lista de los clientes - DATE(DATE_SUB(NOW(),INTERVAL 10 HOUR))*//
$query = mysqli_query($result,'SELECT * FROM cuadre_caja;');

$tr = '';
$conteo = 1;

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$estado = ($row['estado'] == 0)? 'Correcto' : 'Incorrecto';

 	$tr .=	"<tr class='rows' id='rows'>
 				<td><a onclick='javascript:abrir(\"verCuadreCaja.php?id=" . $row['id_cuadre'] . "\")'>" . $row['fecha'] . "</a></td>
				<td  align='right'>$ " . number_format($row['valor_ventas'], 0, ",", ".") 	. "</td>
				<td  align='right'>$ " . number_format($row['cuadre_caja'], 0, ",", ".") 	. "</td>
				<td  align='right'>$ " . number_format($row['balance'], 0, ",", ".") 	. "</td>
				<td  align='right'>" . $estado . "</td>
				<td><a onclick='javascript:abrir(\"editarCuadre_caja.php?id=" . $row['id_cuadre'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil' style='font-size:2em;'></i></spam></a>&nbsp;&nbsp;
				<a href='eliminarCuadre_caja.php?id=" . $row['id_cuadre'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off' style='font-size:2em;'></i></a>
				</td>
			</tr>";

	$conteo++;

}

$html="<!DOCTYPE html>
<head>
<title>Cuadre Caja</title>
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
	open(url,'','top=100,left=100,width=800,height=400') ; 
	}
</script>
<!-- //tables -->
</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Cuadre Caja</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/informes/nuevoCuadre.php\")'>Nuevo</button>
				</div>
				<div class='bs-component mb20 col-md-6'>
			  		<h3>-</h3>
			  	</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Fecha</th>
							<th>Valor Caja</th>
							<th>Cuadre</th>
							<th>Balance</th>
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
