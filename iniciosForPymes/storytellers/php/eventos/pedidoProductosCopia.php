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
$option = '';
$estado = '';

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query3 = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, estado from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row3=$query3->fetch_assoc();
$id_pedido = $row3['pedido_id'];
$nombre_pedido = $row3['nombre_pedido'];
$nombre_cliente = $row3['nombres'];
$id_cliente = $row3['id'];
$estado = $row3['estado'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select pp.peproducto_id as idproducto, pp.producto as producto, pp.valoru as valoru, pp.cantidad as cantidad, pp.valort as valort from pedidos p inner join pedidoProductos pp inner join clientes c on p.pedido_id = pp.pedido_id and pp.cliente_id = c.id where p.pedido_id = '$id' order by pp.peproducto_id ASC");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['idproducto'] 	. "</td>
				<td>" 	. 	$row['producto'] 	. "</td>
				<td align='right'>$ " . number_format($row['valoru'], 0, ",", ".") 	. "</td>
				<td>" 	. 	$row['cantidad'] 	. "</td>
				<td align='right'>$ " . number_format($row['valort'], 0, ",", ".") 	. "</td>
				<td>
				<a class='botonTab' onclick='javascript:abrir(\"editarPeProducto.php?id=" . $row['idproducto'] . "\")'><span data-tooltip='Editar'><i class='fa fa-pencil'></i></spam></a>&nbsp;&nbsp;
				<a onClick=\"return confirmar('¿Estas seguro de eliminar?')\" href='eliminarPeProducto.php?id=" . $row['idproducto'] . "' class='botonTab'><span data-tooltip='Eliminar'><i class='fa icon-off'></i></spam></a>
				</td>
			</tr>";

 }

// Obtenemos el total que adeuda el cliente y los mostramos en diferentes colores si debe o no
$query3 = mysqli_query($result,"select SUM(valort) as valor from pedidos c inner join pedidoProductos cr on c.pedido_id = cr.pedido_id where c.pedido_id = '$id'");

$row3 = $query3->fetch_assoc();

$valorPedido = "Valor Pedido: $ " . number_format($row3['valor'], 0, ",", ".") . "";

//Sale la lista de productos disponibles.

$option='';

$query4 = mysqli_query($result,'select * from productos order by idproductos');

while ($row = $query4->fetch_array()){

	 	$option .=	"<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
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
						<div class='form-title'>
							<h4>" . $valorPedido . "</h4>
						</div>
						<div class='row mb40'>
							<div class='col-md-1'>
							</div>	
							<div class='col-md-2'>
								<form class='form-horizontal' action='addPeProducto.php' method='post'> 
									<div class='form-group'> 
										<input type='hidden' name='pedido_id' value='$id_pedido'>
										<input type='hidden' name='cliente_id' value='$id_cliente'>
										<label>Producto:</label> 
										<select name='producto' class='form-control'>" . $option . "</select>
									</div>
							</div>
							<div class='col-md-1'>
									<div class='form-group'> <label>Cantidad: </label> 
										<input type='number' name='cantidad' class='form-control' id='cantidad' required/>
									</div> 
									<button type='submit' class='btn btn-xs btn-primary'>Agregar</button> 
							</div>
							<div class='col-md-2'>
									<div class='form-group'> <label>Detalles: </label> 
										<input type='text' name='detalles' class='form-control'>
									</div> 
								</form>
							</div>
							<div class='col-md-2'>
								<label>Cotizaci&oacute;n # $id_pedido</label>
								<label>No. de Cuotas</label>
								<input type='number' name='cuotas' class='form-control' id='cuotas' value='1' required/>
								<label>Deposito</label>
								<input type='number' name='cuotas' class='form-control' id='cuotas' value='1000000' required/>
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='cotizacion.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
									<div class='form-group'> <label></label>
									</div>
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<button type='submit' class='btn btn-xs btn-block btn-primary'>Cotizacion</button> 
								</form>
								<form class='form-horizontal' action='cuenta_de_cobro.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
										<input type='hidden' name='pedido_id' value='$id_pedido'>
									<button type='submit' class='btn btn-xs btn-block btn-primary'>Cuenta Cobro</button>
								</form>
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='hacerPedido.php' method='post'>
									<div class='form-group'><label></label> 
									</div> 
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<button type='submit' class='btn btn-xs btn-block btn-primary'>Hacer Pedido</button> 
								</form> 
								<form class='form-horizontal' action='cancelarPedido.php' method='post'>
									<label></label>
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<button type='submit' class='btn btn-xs btn-block btn-danger'>Cancelar Pedido</button> 
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
							<th>Cod.</th>
							<th>Producto</th>
							<th>V.Unitario</th>
							<th>Cantidad</th>
							<th>V.Total</th>
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
