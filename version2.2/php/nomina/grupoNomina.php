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
$tr 	= '';
$option = '';
$estado = '';
$porDescuento = 0.04;

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query3 = mysqli_query($result, "select * from nomina where idnomina = '$id'");
$row3 = $query3->fetch_assoc();
$nombre 		= $row3['fecha'];
$nombre_nomina = $row3['nombre'];
$estado 		= $row3['estado'];


// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"SELECT n.idnomina as idnomina, u.iduser as iduser, u.nombre as nombre, u.apellido as apellido, u.valor_nomina as valor_nomina, g.dias as dias, g.salud as salud, g.pension as pension, g.prestamos as prestamos, g.idgrupo as idgrupo, g.pago_total as pago_total FROM nomina n inner join grupoNomina g inner join usuarios u on n.idnomina = g.idnomina and u.iduser = g.idusuario WHERE n.idnomina = '$id'");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){
// echo "Llegue aqui";die();

 	$devengado = ($row['valor_nomina']/$row['dias'])*$row['dias'];
 	$deducciones = $row['salud'] + $row['pension'] + $row['prestamos'];


 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['nombre'] . " " . $row['apellido'] . "</td>
				<td align='right'>$ " . number_format($row['valor_nomina'], 0, ",", ".") 	. "</td>
				<td>" 	. 	$row['dias'] 	. "</td>
				<td align='right'>$ " . number_format($devengado, 0, ",", ".") 	. "</td>
				<td align='right'>$ " . number_format($deducciones, 0, ",", ".") 	. "</td>
				<td align='right'>$ " . number_format($row['pago_total'], 0, ",", ".") 	. "</td>
				<td>
				<a class='botonTab' onclick='javascript:abrir(\"verGrNomina.php?id=" . $row['idgrupo'] . "\")'><span data-tooltip='Detalles'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarGrNomina.php?id=" . $row['idgrupo'] . "' class='botonTab'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a>
				</td>
			</tr>";

 }

// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query3 = mysqli_query($result,"select SUM(cr.pago_total) as valor from nomina c inner join grupoNomina cr on c.idnomina = cr.idnomina where c.idnomina = '$id'");

$row3 = $query3->fetch_assoc();

$valorNomina = "Valor Nomina: $ " . number_format($row3['valor'], 0, ",", ".") . "";

//Sale la lista de productos disponibles.

$option='';

$query4 = mysqli_query($result,'select * from usuarios order by iduser');

while ($row = $query4->fetch_array()){

	 	$option .=	"<option value='" . $row['iduser'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
	}


// Se contruye el HTML para imprimirlo mas adelante.

$html="<!DOCTYPE html>
<head>
<title>Productos de Pedido</title>
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
<!-- //tables -->
</head>
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				
				<div class='table-heading'>
					<h2>$nombre_nomina</h2>
				</div>
				<div class='forms'>
					<div class='form-two widget-shadow'>
						<div class='row mb40'>
							<div class='col-md-1'>
							</div>	
							<div class='col-md-4'>
								<form class='form-horizontal' action='addGrNomina.php' method='post'> 
									<div class='form-group'> 
										<input type='hidden' name='idnomina' value='$id'>
										<label>Usuario:</label> 
										<select name='usuario' class='form-control'>" . $option . "</select>
									</div>
									<button type='submit' class='btn btn-primary'>Agregar</button> 
							</div>
							<div class='col-md-1'>
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='ejecutarNomina.php' method='post'>
									<input type='hidden' name='idnomina' value='$id'>
									<div class='form-group'> <label>Valor Nomina: </label> 
										<input type='text' name='cobrado' class='form-control' value='$ " . number_format($row3['valor'], 0, ",", ".") . "' disabled/>
									</div> 
									<button type='submit' class='btn btn-primary'>Liquidar</button> 
								</form> 
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='comprobante_nomina.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
									<div class='form-group'> <label>Nomina #</label>
										<input type='hidden' name='idnomina' value='$id'>
										<input type='text' name='nuevo_nomina_id' class='form-control' value='$id' disabled/>
									</div>
									<button type='submit' class='btn btn-danger'>Generar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th width='30%'>Nombres</th>
							<th>Nomina</th>
							<th>Dias</th>
							<th>Devengado</th>
							<th>Deducciones</th>
							<th>Total</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  ". 
						  $tr
						  ."
						<tr>
							<td colspan='3'></td>
							<td><b>TOTAL</b></td>
							<td align='left'>$valorNomina</td>
						</tr>
						</tbody>
					  </table>
					</div>
				</div>
				<!-- //tables -->
			</div>
		</div>
		<!-- footer -->
		<div class='footer'>
			<p>© 2018 ForPymes. All Rights Reserved. Design by <a href='edisonosorioj.com'></a>Edison Osorio</p>
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
