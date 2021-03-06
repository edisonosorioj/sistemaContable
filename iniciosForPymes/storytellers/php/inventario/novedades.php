<?php
// Version 2.0 of Edison Osorio
session_start();


// Verifica que la sesion este correcta. Sino existe lo saca del sistema.
if (!isset($_SESSION['login'])) {

	header("Location: ../inicio/session.php");
	exit();
	
}
if (isset($_SESSION['idrol'])){

	$idrol = $_SESSION['idrol'];
	
}

require_once '../conexion.php';

$conex = new conection();
$result = $conex->conex();
$tr = '';


// Obtiene el ID enviado desde Productos para visualizar su historial
$id = $_GET['id'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"SELECT np.id as id, np.detalles as detalles, np.cantidad as cantidad, np.fecha as fecha FROM novedadProducto np INNER JOIN productos p ON np.productoId = p.idproductos WHERE p.idproductos = '$id' ORDER BY id;");
                  

 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows'>
 				<td></td>
				<td>" 	. $row['fecha'] 	. "</td>
				<td>" 	. $row['detalles'] 	. "</td>
				<td>" 	. $row['cantidad'] 	. "</td>
				<td>
				<a class='botonTab' onclick='javascript:abrir(\"editarNovedad.php?id=" . $row['id'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarNovedad.php?id=" . $row['id'] . "' class='botonTab'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a>
				</td>
			</tr>";

 }

// Utilizamos esta consulta para obtener el nombre del cliente en su historial 
$query2 = mysqli_query($result, "SELECT nombre FROM productos WHERE idproductos = '$id'");

$row2=$query2->fetch_assoc();

$nombre = $row2['nombre'];


// Según su rol habilita el rol correspondiente
if ($idrol == 1) {
	include "../menu.php";
} else if ($idrol == 2){
	include "../menu2.php";
} else {
	include "../menu3.php";
}


// Se contruye el HTML para imprimirlo mas adelante.

$html="<!DOCTYPE html>
<head>
<title>Novedades</title>
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
	open(url,'','top=100,left=100,width=800,height=500') ; 
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
					<h2>$nombre</h2>
				</div>
				<div class='bs-component mb20 col-md-8'>
					<button type='button' class='btn btn-primary hvr-icon-pulse' onClick=' window.location.href=\"inventario.php\"'>Volver</button>
					<button type='button' class='btn btn-primary hvr-icon-float-away' onclick='javascript:abrir(\"../../html/inventario/agregarProducto.php?id=" . $id . "\")'>Agregar</button>
					<button type='button' class='btn btn-primary hvr-icon-sink-away' onclick='javascript:abrir(\"../../html/inventario/restarProducto.php?id=" . $id . "\")'>Restar</button>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th></th>
							<th>Fecha</th>
							<th width='30%'>Detalles</th>
							<th>Cantidad</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  " 
						  . $tr . 
						  "
						</tbody>
					  </table>
					  </form>
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
	<script>
		$('#checkTodos').change(function () {
  		$('input:checkbox').prop('checked', $(this).prop('checked'));
		});
	</script>
</body>
</html>";

echo $html;
