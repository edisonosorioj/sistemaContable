<?php
// Version 2.2 of Edison Osorio
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
require('funcionesEspeciales.php');

$conex = new conection();
$result = $conex->conex();
$tr = '';
$option = '';
$estado = '';
$form = '';
$horas = '';

if ($idrol == 1) {
	include "../menu.php";
} else if ($idrol == 2){
	include "../menu2.php";
} else {
	include "../menu3.php";
}



// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, estado, invitados, instalacion_id, sede_id, start, end from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row = $query->fetch_assoc();
$id_pedido 		= $row['pedido_id'];
$nombre_pedido 	= $row['nombre_pedido'];
$nombre_cliente = $row['nombres'];
$id_cliente 	= $row['id'];
$estado 		= $row['estado'];
$invitados 		= $row['invitados'];
$inst_id 		= $row['instalacion_id'];
$sede_id 		= $row['sede_id'];
$fecha_inicio 	= $row['start'];
$fecha_fin 		= $row['end'];

//Información de la tabla cotización

$query12 = mysqli_query($result, "select * from cotizacion where pedido_id = '$id'");
$row12 = $query12->fetch_assoc();
 
$entrada_id 	 	= $row12['entrada'];
$plato_fuerte_id	= $row12['plato_fuerte'];
$mezcladores_id		= $row12['mezcladores'];
$menaje_id			= $row12['menaje'];
$personal_id		= $row12['personal'];
$direccionamiento_id = $row12['direccionamiento'];
$licor_id			= $row12['licor'];
$cotizacion_id		= $row12['cotizacion_id'];
$observaciones		= $row12['observaciones'];
$valorCotiza		= $row12['valor'];
$abono				= $row12['abono'];
$cuotas				= $row12['cuotas'];


// Descripción del item de la lista de precios
$query1 = mysqli_query($result, "select * from lista_precios where id =  ' $entrada_id ' ");
$row1 = $query1->fetch_assoc();

$nombre_entrada	= $row1['descripcion'];

// Descripción del item de la lista de precios
$query2 = mysqli_query($result, "select * from lista_precios where id = '$plato_fuerte_id'");
$row2 = $query2->fetch_assoc();

$nombre_plato	= $row2['descripcion'];

// Descripción del item de la lista de precios
$query3 = mysqli_query($result, "select * from lista_precios where id = '$mezcladores_id'");
$row3 = $query3->fetch_assoc();

$nombre_mezcladores	= $row3['descripcion'];

// Descripción del item de la lista de precios
$query4 = mysqli_query($result, "select * from lista_precios where id = '$menaje_id'");
$row4 = $query4->fetch_assoc();

$nombre_menaje	= $row4['descripcion'];

// Descripción del item de la lista de precios
$query5 = mysqli_query($result, "select * from lista_precios where id = '$personal_id'");
$row5 = $query5->fetch_assoc();

$nombre_personal	= $row5['descripcion'];

// Descripción del item de la lista de precios
$query6 = mysqli_query($result, "select * from lista_precios where id = '$direccionamiento_id'");
$row6 = $query6->fetch_assoc();

$nombre_direccionamiento	= $row6['descripcion'];

// Descripción del item de la lista de precios
$query7 = mysqli_query($result, "select * from lista_precios where id = '$licor_id'");
$row7 = $query7->fetch_assoc();

$nombre_licor	= $row7['descripcion'];

//Consultar la cantidad de horas que tiene el evento

$horas = date("H:i", strtotime("00:00:00") + strtotime($fecha_fin) - strtotime($fecha_inicio));


 // Consulta para saber el día de la semana
$fecha_inicio = $row['start'];
 $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");
 $dia = $dias[date("w", strtotime($fecha_inicio))];

// Consulta el nombre de la sede

$query8 = mysqli_query($result,"select * from sede where sede_id = '$sede_id'");

$sede = $query8->fetch_assoc();

$nombre_sede = $sede['nombre'];


//Sale la lista de productos disponibles.

$query9 = mysqli_query($result,"select * from lista_precios where id = '$inst_id'");

$row9 = $query9->fetch_assoc();

$instalacion = $row9['descripcion'];


//Sale la lista de productos disponibles.

$entrada='';

$query10 = mysqli_query($result,'select * from lista_precios where item_id = 2 order by id');

while ($row10 = $query10->fetch_array()){

	 	$entrada .=	"<option value='" . $row10['id'] . "'>" . $row10['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$platoFuerte='';

$query11 = mysqli_query($result,'select * from lista_precios where item_id = 3 order by id DESC');

while ($row11 = $query11->fetch_array()){

	 	$platoFuerte .=	"<option value='" . $row11['id'] . "'>" . $row11['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$mezcladores='';

$query12 = mysqli_query($result,'select * from lista_precios where item_id = 4 order by id DESC');

while ($row12 = $query12->fetch_array()){

	 	$mezcladores .=	"<option value='" . $row12['id'] . "'>" . $row12['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$menaje='';

$query13 = mysqli_query($result,'select * from lista_precios where item_id = 5 order by id DESC');

while ($row13 = $query13->fetch_array()){

	 	$menaje .=	"<option value='" . $row13['id'] . "'>" . $row13['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$personalServicio='';

$query14 = mysqli_query($result,'select * from lista_precios where item_id = 6 order by id');

while ($row14 = $query14->fetch_array()){

	 	$personalServicio .=	"<option value='" . $row14['id'] . "'>" . $row14['descripcion'] . "</option>";
	}

//Sale la lista de productos disponibles.

$direccionamiento='';

$query15 = mysqli_query($result,'select * from lista_precios where item_id = 8 order by id');

while ($row15 = $query15->fetch_array()){

	 	$direccionamiento .=	"<option value='" . $row15['id'] . "'>" . $row15['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$licor='';

$query16 = mysqli_query($result,'select * from lista_precios where item_id = 7 order by id');

while ($row16 = $query16->fetch_array()){

	 	$licor .=	"<option value='" . $row16['id'] . "'>" . $row16['descripcion'] . "</option>";
	}

if ($estado == 1) {
	$form .= "<form class='form-horizontal' action='cuenta_de_cobro.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
		<input type='hidden' name='pedido_id' value='$id_pedido'>
		<button type='submit' class='btn btn-block btn-primary'>Cuenta Cobro / Factura</button>
	</form>
	<form class='form-horizontal' action='lista_check.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=1000 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
		<input type='hidden' name='pedido_id' value='$id_pedido'>
		<button type='submit' class='btn btn-block btn-primary'>Check List</button>
	</form>
	<form class='form-horizontal' action='cancelarPedido.php' method='post'>
		<label></label>
		<input type='hidden' name='pedido_id' value='$id_pedido'>
		<button type='submit' class='btn btn-block btn-danger'>Cancelar Evento</button> 
	</form>"
	;
} else {
	$form .= "";
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
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
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
					<h2>$nombre_cliente - $nombre_pedido</h2>
				</div>
				<div class='forms'>
					<div class='form-two widget-shadow'>
						
						<div class='row mb40'>
							<div class='col-md-4'>
								<div class='form-group'> 
								<form class='form-horizontal' action='editarPedido.php?id=$id' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
									<label>Tipo de Evento:</label> 
									<input type='text' name='tipoEvento' class='form-control' value='$nombre_pedido' disabled/>
									<label>Instalaciones:</label>
									<input type='text' class='form-control' value='$instalacion' disabled/>
								</div>
							</div>
							<div class='col-md-2'>
								<div class='form-group'> 
								<label>Invitados: </label> 
									<input type='text' name='invitados' class='form-control' value='$invitados' disabled/>
								<label>Sede: </label> 
									<input type='text' name='sede' class='form-control' value='$nombre_sede' disabled/>
								</div>
							</div>
							<div class='col-md-2'>
								<label>Horas</label>
								<input type='text' name='horas' class='form-control' value='$horas' disabled/>
								<label>Día del Evento</label>
								<input type='text' name='diaEvento' class='form-control' value='$dia' disabled/>
							</div>
							<div class='col-md-2'>
								<label>Valor Cotización</label>
								<input type='text' class='form-control' value='$ " . number_format($valorCotiza, 0, ",", ".") . "' disabled/>
								<label>-</label> 
								<button type='submit' class='btn btn-primary btn-block'>Cambiar</button> 
							</div>
							</form>
						<form class='form-horizontal' action='addCotizacion.php' method='post' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
							<div class='col-md-2'>
								<label>No. de Cuotas</label>
								<input type='number' name='cuotas' id='cuotas' class='form-control' value='$cuotas' placeholder='1'/>
								<label>Deposito / Abono</label>
								<input type='text' name='abono' id='abono' class='form-control' placeholder='" . number_format($valorCotiza, 0, ",", ".") . "' value='$abono'/>
							</div>
						</div>
					</div>
				</div>

				<div class='forms'>
					<div class='form-two widget-shadow'>
						<div class='row mb40'>
							<div class='col-md-4'>
								<div class='form-group'>
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<input type='hidden' name='cliente_id' value='$id_cliente'>
									<input type='hidden' name='invitados' value='$invitados'>
									<input type='hidden' name='nombre_pedido' value='$nombre_pedido'>
									<input type='hidden' name='instalaciones' value='$inst_id'>
									<input type='hidden' name='cotizacion_id' value='$cotizacion_id'>
									<label>Entrada</label>
									<select name='entrada' class='form-control'>
									<option value='" . $entrada_id . "'>" . $nombre_entrada . "</option>
									" . $entrada . "</select>
									<h5>-</h5> 
									<label>Plato fuerte</label> 
									<select name='platoFuerte' class='form-control'>
									<option value='".$plato_fuerte_id."'>" . $nombre_plato . "</option>
									" . $platoFuerte . "</select>
									<h5>-</h5> 
									<label>Mezcladores</label> 
									<select name='mezcladores' class='form-control'>
									<option value='".$mezcladores_id."'>" . $nombre_mezcladores . "</option>
									" . $mezcladores . "</select>
								</div>
							</div>
							<div class='col-md-4'>
								<label>Menaje</label> 
								<select name='menaje' class='form-control'>
								<option value='".$menaje_id."'>" . $nombre_menaje . "</option>
								" . $menaje . "</select>
								<h5>-</h5>
								<label>Personal de Servicios</label>
								<select name='personalServicio' class='form-control'>
								<option value='".$personal_id."'>" . $nombre_personal . "</option>
								" . $personalServicio . "</select>
								<h5>-</h5> 
								<label>Direccionamiento del Evento</label> 
								<select name='direccionamiento' class='form-control'>
								<option value='".$direccionamiento_id."'>" . $nombre_direccionamiento . "</option>
								" . $direccionamiento . "</select>
							</div>
							<div class='col-md-4'>
								<label>Licor</label> 
								<select name='licor' class='form-control'>
								<option value='".$licor_id."'>" . $nombre_licor . "</option>
								" . $licor . "</select>
								<h5>-</h5> 
								<label>Observaciones:</label> 
								<textarea name='observaciones' class='form-control'>" . $observaciones . "</textarea>
							</div>
						</div>
						<button type='submit' class='btn btn-primary btn-block'>Guardar y Generar Cotización</button> 
						</form>
						<h5>-</h5>
						<form class='form-horizontal' action='hacerPedido.php' method='post'>
							<input type='hidden' name='pedido_id' value='$id_pedido'>
							<input type='hidden' name='sede' value='$sede_id'>
							<button type='submit' class='btn btn-block btn-primary'>Confirmar Evento</button> 
						</form> 
						<form class='form-horizontal' action='contrato.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
								<input type='hidden' id='copy-cuotas' name='copy-cuotas'>
								<input type='hidden' id='copy-abono' name='copy-abono'>
								<input type='hidden' name='pedido_id' value='$id_pedido'>
							<button type='submit' class='btn btn-block btn-primary'>Generar Contrato</button>
						</form>
						" . $form . "
					</div>
				</div>

				<!-- //tables -->
				<div class='col-md-2'>
				</div>
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
	<script type='text/javascript'>
		document.getElementById('cuotas').addEventListener('keyup', autoCompleteNew);
		function autoCompleteNew(e) {            
		    var value = $(this).val();         
		    $('#copy-cuotas').val(value.replace(/\s/g, '').toLowerCase()); 
	}
	</script>
	<script type='text/javascript'>
		document.getElementById('abono').addEventListener('keyup', autoCompleteNew);
		function autoCompleteNew(e) {            
		    var value = $(this).val();         
		    $('#copy-abono').val(value.replace(/\s/g, '').toLowerCase()); 
	}
	</script>
</body>
</html>";

echo $html;
