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
$tr2 = '';

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}

$query = mysqli_query($result,'select * from usuarios;');


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['iduser'] 			. "</td>
				<td><a onclick='javascript:abrir(\"verUsuario.php?id=" . $row['iduser'] . "\")'>" . $row['nombre'] 			. "</a></td>
				<td><a onclick='javascript:abrir(\"verUsuario.php?id=" . $row['iduser'] . "\")'>" . $row['apellido'] 		. "</a></td>
				<td><a onclick='javascript:abrir(\"verUsuario.php?id=" . $row['iduser'] . "\")'>" . $row['documento'] 		. "</a></td>
				<td align='right'><a onclick='javascript:abrir(\"verUsuario.php?id=" . $row['iduser'] . "\")'>" . number_format($row['valor_nomina'], 0, ",", ".") . "</a></td>
				<td><a onclick='javascript:abrir(\"editarUsuario.php?id=" . $row['iduser'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarUsuario.php?id=" 	. $row['iduser'] . "'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a></td>
			</tr>";

 }

$query2 = mysqli_query($result,'select SUM(valor_nomina) as total from usuarios');
 	$row2 = $query2->fetch_assoc();
 	$ing = $row2['total'];

$html="<!DOCTYPE html>
<head>
<title>Usuarios</title>
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
<body class='dashboard-page' style='overflow: scroll !important;'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Usuarios</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/nomina/nuevoUsuario.php\")'>Nuevo</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					  	<h3>Total Nomina: $ " . number_format($row2['total'], 0, ",", ".") . "</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Documento</th>
							<th>Nomina</th>
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
