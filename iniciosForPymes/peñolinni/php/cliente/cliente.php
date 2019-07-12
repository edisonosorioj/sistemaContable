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
// Consulta y por medio de un while muestra la lista de los clientes
$query = mysqli_query($result,'select c.id, c.empresa, c.documento, c.nombres, c.telefono, c.correo, c.direccion, SUM(cr.valor) as valor from clientes c left join creditos cr on c.id = cr.idclientes group by c.id order by c.nombres');



$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['documento'] 	. "</td>
				<td><a onclick='javascript:abrir(\"verCliente.php?id=" . $row['id'] . "\")'>" . $row['empresa'] . "</a></td>
				<td><a onclick='javascript:abrir(\"verCliente.php?id=" . $row['id'] . "\")'>" . $row['nombres'] . "</a></td>
				<td>" . $row['telefono'] 	. "</td>
				<td  align='right'>$ " . number_format($row['valor'], 0, ",", ".") 	. "</td>
				<td><a onclick='javascript:abrir(\"editarCliente.php?id=" . $row['id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a href='../credito/credito.php?id=" . $row['id'] . "'><span data-tooltip='Historia'>
					<i class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;
				<a href='eliminarCliente.php?id=" . $row['id'] . "'><span data-tooltip='Eliminar'>
					<i class='fa icon-off'></i></a>
				</td>
			</tr>";

 }

// Realiza una segunda consulta que suma el total que deben todos los clientes
 $query2 = mysqli_query($result,'select SUM(cr.valor) as valor from creditos cr');

// Lo organiza en un array y permite utilizar cada uno de los parametros
 $cartera = $query2->fetch_array(MYSQLI_BOTH);
 $cTotal = number_format($cartera['valor'], 0, ",", ".");


$html="<!DOCTYPE html>
<head>
<title>Clientes</title>
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
<!-- //tables -->
</head>
<body class='dashboard-page' style='overflow: scroll !important;'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Clientes</h2>
				</div>
				<div class='bs-component mb20 col-md-2'>
					<button type='button' class='btn btn-primary btn-block hvr-icon-float-away' onclick='javascript:abrir(\"../../html/cliente/nuevoCliente.html\")'>Nuevo</button>
				</div>
				<div class='bs-component mb20 col-md-6'>
			  		<h3>Total : $ $cTotal</h3>
			  	</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>ID</th>
							<th>Empresa</th>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Saldo</th>
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
