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

// Obtiene el ID enviado desde Pedido para visualizar El Minuto a Minuto de un Evento en especial
$id = $_GET['id'];

// Consulta y por medio de un while muestra la lista de los clientes
$query = mysqli_query($result,"select * from minuto_a_minuto where pedido_id = '$id';");



$tr = '';

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='" . $row['minuto_id']. "'>
				<td></td>
				<td>" . $row['hora'] 		. "</td>
				<td>" . $row['minuto_id'] 	. "</td>
				<td>" . $row['minuto_id'] 	. "</td>
				<td>" . $row['minuto_id'] 	. "</td>
				<td>" . $row['orden'] 		. "</td>
			</tr>";

 }


$html = "<!DOCTYPE html>
<head>
<title>Minuto a minuto</title>
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
<link rel='icon' href='../../images/fav.png'>
<!-- //font-awesome icons -->
<script src='../../js/jquery2.0.3.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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
<script type='text/javascript' src='../../css/tabledit/jquery.tabledit.js'></script>
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
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- tables -->
				
				<div class='table-heading'>
					<h2>Minuto a minuto</h2>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table_table' class='table table-striped'>
						<thead>
						  <tr>
							<th>+</th>
							<th>Hora</th>
							<th>Actividad</th>
							<th>Proveedor</th>
							<th>Comentarios</th>
							<th>Orden</th>
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
			<p>© 2018 ForPymes. All Rights Reserved</p>
		</div>
		<!-- //footer -->
	</section>
	<script>
		$(document).ready(function(){
			$('#data_table').Tabledit({
				deleteButton: false,
				editButton: false,
				columns: {
				identifier: [0, 'minuto_id'],
				editable: [[1, 'hora'], [2, 'actividad'], [3, 'proveedor'], [4, 'comentarios'], [5, 'orden']]
			},
			hideIdentifier: true,
			url: 'live_edit.php'
			});
		});
	</script>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
	<script src='../../js/acciones.js'></script>
</body>
</html>";

echo $html;
