<?php
// Version 2.0 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.html");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';
$tr2 = '';
$deuda = '';

if ($idrol == 0) {
	include "../menu.php";
}elseif ($idrol == 1) {
	include "../menu2.php";
}else{
	include "../menu3.php";
}

// Obtiene el ID enviado desde Cliente para visualizar su historial
$id = $_GET['id'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select cr.idcreditos as idcreditos, cr.fecha as fecha, cr.detalles as detalles, cr.valor as valor, cr.registro_id as registro_id, cr.idclientes as cliente_id from clientes c inner join creditos cr on c.id = cr.idclientes where cr.idclientes = '$id' order by cr.idcreditos DESC, fecha DESC;");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	if ($row['valor'] < 0) {
 		$td = "&nbsp;&nbsp;";
 	}else{
 		$td = "&nbsp;&nbsp;
			<a class='botonTab' onclick='javascript:abrir(\"comprobante.php?id=" . $row['idcreditos'] . "\")'><span data-tooltip='Recibo'><i
			class='fa fa-file-text-o'></i></spam></a>&nbsp;&nbsp;";
 	}

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" . $row['idcreditos'] 	. "</td>
				<td>" . $row['fecha'] 		. "</td>
				<td>" . $row['detalles'] 	. "</td>
				<td>$ " . number_format($row['valor'], 0, ",", ".") 	. "</td>
				<td>
				<a class='botonTab' onclick='javascript:abrir(\"detallesCredito.php?registro_id=" . $row['registro_id'] . "&cliente_id=" . $row['cliente_id'] . "&fecha=" . $row['fecha'] . "\")'><span data-tooltip='Detalles'><i class='fa fa-file-text-o' style='font-size:2em;'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarCredito.php?id=" . $row['idcreditos'] . "' class='botonTab'><span data-tooltip='Eliminar'><i class='fa icon-off' style='font-size:2em;'></i></spam></a>
				</td>
			</tr>";

 }

// Utilizamos esta consulta para obtener el nombre del cliente en su historial 
$query2 = mysqli_query($result, "select nombres from clientes where id = '$id'");

$row2=$query2->fetch_assoc();

$nombre = $row2['nombres'];

// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query3 = mysqli_query($result,"select SUM(valor) as total from clientes c inner join creditos cr on c.id = cr.idclientes where cr.idclientes = '$id'");

$row3 = $query3->fetch_assoc();

if($row3['total'] < 0){

	$deuda .="<label class='deuda'>Cartera Pendiente: $ " . number_format($row3['total'], 0, ",", ".") ."</label></form>";

}else{
	$deuda .="<label class='aFavor'>Cartera a Favor: $ " . number_format($row3['total'], 0, ",", ".") ."</label></form>";

}

// Se contruye el HTML para imprimirlo mas adelante.

$html="<!DOCTYPE html>
<head>
<title>Credito</title>
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
	open(url,'','top=100,left=100,width=900,height=600') ; 
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
					<h2>$nombre</h2>
				</div>
				<div class='bs-component mb20 col-md-8'>
					<button type='button' class='btn btn-primary hvr-icon-pulse col-11' onClick=' window.location.href=\"../cliente/cliente.php\" '>Volver</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					  	<h3>" . $deuda . "</h3>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Cod.</th>
							<th>Fecha</th>
							<th width='30%'>Detalles</th>
							<th>Valor</th>
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
	<script>
		$('#checkTodos').change(function () {
  		$('input:checkbox').prop('checked', $(this).prop('checked'));
		});
	</script>
</body>
</html>";

echo $html;
