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
$tr = '';


$query = mysqli_query($result,'select * from sede');

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
 				<td>" . $row['sede_id']			. "</td>
				<td>" . $row['nombre'] 		. "</td>
				<td>" . $row['estado'] 			. "</td>
				<td>" . $row['color'] 		. "</td>
				<td><a onclick='javascript:abrir(\"editarSede.php?id=" . $row['sede_id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a href='precio_dia_sede.php?id=" . $row['sede_id'] . "'><span data-tooltip='Precios'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarSede.php?id=" 	. $row['sede_id'] . "'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a></td>
			</tr>";

 }

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

$html="<!DOCTYPE html>
<head>
<title>Sedes</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Sistema Administrativo' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script> 
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
				
				<div class='table-heading'>
					<h2>Sedes</h2>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Id</th>
							<th>Nombres</th>
							<th>Estado</th>
							<th>Color</th>
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
