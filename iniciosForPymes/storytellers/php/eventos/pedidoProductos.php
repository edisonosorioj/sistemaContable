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

$conex = new conection();
$result = $conex->conex();
$tr = '';
$option = '';
$estado = '';
$form = '';

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, estado, invitados, instalacion_id, sede_id, start from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row = $query->fetch_assoc();
$id_pedido 		= $row['pedido_id'];
$nombre_pedido 	= $row['nombre_pedido'];
$nombre_cliente = $row['nombres'];
$id_cliente 	= $row['id'];
$estado 		= $row['estado'];
$invitados 		= $row['invitados'];
$inst_id 		= $row['instalacion_id'];
$sede_id 		= $row['sede_id'];
$dia 			= date($row['start']);


// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query1 = mysqli_query($result,"select SUM(valort) as valor from pedidos c inner join pedidoProductos cr on c.pedido_id = cr.pedido_id where c.pedido_id = '$id'");

$row1 = $query1->fetch_assoc();

$valorPedido = "Valor Pedido: $ " . number_format($row1['valor'], 0, ",", ".") . "";


// Consulta el nombre de la sede

$query11 = mysqli_query($result,"select * from sede where sede_id = '$sede_id'");

$sede = $query11->fetch_assoc();

$nombre_sede = $sede['nombre'];


//Sale la lista de productos disponibles.

$query2 = mysqli_query($result,"select * from lista_precios where id = '$inst_id'");

$row2 = $query2->fetch_assoc();

$instalacion = $row2['descripcion'];


//Sale la lista de productos disponibles.

$entrada='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 2 order by id');

while ($row3 = $query3->fetch_array()){

	 	$entrada .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$platoFuerte='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 3 order by id DESC');

while ($row3 = $query3->fetch_array()){

	 	$platoFuerte .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$mezcladores='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 4 order by id DESC');

while ($row3 = $query3->fetch_array()){

	 	$mezcladores .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$menaje='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 5 order by id DESC');

while ($row3 = $query3->fetch_array()){

	 	$menaje .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$personalServicio='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 6 order by id');

while ($row3 = $query3->fetch_array()){

	 	$personalServicio .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}

//Sale la lista de productos disponibles.

$direccionamiento='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 8 order by id');

while ($row3 = $query3->fetch_array()){

	 	$direccionamiento .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}


//Sale la lista de productos disponibles.

$rustico='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 9 order by id');

while ($row3 = $query3->fetch_array()){

	 	$rustico .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}

//Sale la lista de productos disponibles.

$licor='';

$query3 = mysqli_query($result,'select * from lista_precios where item_id = 7 order by id');

while ($row3 = $query3->fetch_array()){

	 	$licor .=	"<option value='" . $row3['id'] . "'>" . $row3['descripcion'] . "</option>";
	}

if ($estado == 1) {
	$form .= "<form class='form-horizontal' action='cuenta_de_cobro.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
		<input type='hidden' name='pedido_id' value='$id_pedido'>
		<button type='submit' class='btn btn-block btn-primary'>Cuenta Cobro / Factura</button>
	</form>";
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
					<h2>$nombre_cliente - $nombre_pedido</h2>
				</div>
				<div class='forms'>
					<div class='form-two widget-shadow'>
						
						<div class='row mb40'>
							<div class='col-md-4'>
								<div class='form-group'> 
								<form class='form-horizontal' action='editarPedido.php?id=$id' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
									<label>Tipo de Evento:</label> 
									<input type='input' name='tipoEvento' class='form-control' value='$nombre_pedido' disabled/>
									<label>Instalaciones:</label>
									<input type='input' class='form-control' value='$instalacion' disabled/>
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
								<label>No. de Cuotas</label>
								<input type='number' name='cuotas' class='form-control' id='cuotas' value='1' required/>
								<label>Día del Evento</label>
								<input type='text' name='diaEvento' class='form-control' value='$dia' disabled/>
							</div>
							<div class='col-md-2'>
								<label>Deposito</label>
								<input type='number' name='cuotas' class='form-control' id='cuotas' value='1000000' required/>
								<label>-</label> 
								<button type='submit' class='btn btn-primary btn-block'>Cambiar</button> 
							</div>
							</form>
						</div>
					</div>
				</div>

				<div class='forms'>
					<div class='form-two widget-shadow'>
								<form class='form-horizontal' action='addCotizacion.php' method='post' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
						<div class='row mb40'>
							<div class='col-md-4'>
								<div class='form-group'>
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<input type='hidden' name='cliente_id' value='$id_cliente'>
									<input type='hidden' name='invitados' value='$invitados'>
									<input type='hidden' name='nombre_pedido' value='$nombre_pedido'>
									<input type='hidden' name='instalaciones' value='$inst_id'>
									<label>Entrada:</label>
									<select name='entrada' class='form-control'>" . $entrada . "</select>
									<h5>-</h5> 
									<label>Plato fuerte:</label> 
									<select name='platoFuerte' class='form-control'>" . $platoFuerte . "</select>
									<h5>-</h5> 
									<label>Mezcladores:</label> 
									<select name='mezcladores' class='form-control'>" . $mezcladores . "</select>
								</div>
							</div>
							<div class='col-md-4'>
								<label>Menaje:</label> 
								<select name='menaje' class='form-control'>" . $menaje . "</select>
								<h5>-</h5>
								<label>Personal de Servicios:</label> 
								<select name='personalServicio' class='form-control'>" . $personalServicio . "</select>
								<h5>-</h5> 
								<label>Direccionamiento del Evento:</label> 
								<select name='direccionamiento' class='form-control'>" . $direccionamiento . "</select>
							</div>
							<div class='col-md-4'>
								<label>Licor:</label> 
								<select name='licor' class='form-control'>" . $licor . "</select>
								<h5>-</h5> 
								<label>Observaciones:</label> 
								<textarea name='observaciones' class='form-control'></textarea>
							</div>
						</div>
						<button type='submit' class='btn btn-primary btn-block'>Generar Cotización</button> 
						</form>
						<form class='form-horizontal' action='hacerPedido.php' method='post'>
							<input type='hidden' name='pedido_id' value='$id_pedido'>
							<button type='submit' class='btn btn-block btn-primary'>Confirmar Evento</button> 
						</form> 
						<form class='form-horizontal' action='contrato.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
								<input type='hidden' name='pedido_id' value='$id_pedido'>
							<button type='submit' class='btn btn-block btn-primary'>Generar Contrato</button>
						</form>
						" . $form . "
						<form class='form-horizontal' action='cancelarPedido.php' method='post'>
							<label></label>
							<input type='hidden' name='pedido_id' value='$id_pedido'>
							<button type='submit' class='btn btn-block btn-danger'>Cancelar Pedido</button> 
						</form>
					</div>
				</div>

				<!-- //tables -->
				<div class='col-md-2'>
				</div>
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
