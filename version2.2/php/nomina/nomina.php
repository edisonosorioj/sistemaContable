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

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Consulta y por medio de un while muestra la lista de los pedidos
$query = mysqli_query($result,'select * from nomina;');

$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$estado 	= ($row['estado'] 		== '0')		?	"Pendiente"		:"Realizado";

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idnomina'] 		. "</td>
				<td>" . $row['fecha']	. "</td>
				<td>" . $row['nombre'] 		. "</td>
				<td  align='right'>$ " . number_format($row['total_nomina'], 0, ",", ".") . "</td>
				<td>" . $estado	. "</td>
				<td><a onclick='javascript:abrir(\"editarNomina.php?id=" . $row['idnomina'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a href='grupoNomina.php?id=" . $row['idnomina'] . "'><span data-tooltip='Detalles'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarNomina.php?id=" . $row['idnomina'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off'></i></a>
				</td>
			</tr>";

 }

$html="<!DOCTYPE html>
<head>
<title>Nomina</title>
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
	open(url,'','top=100,left=100,width=900,height=400') ; 
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
					<h2>Nomina</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/nomina/nuevaNomina.html\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Nombre</th>
							<th>Valor</th>
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
