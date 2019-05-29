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
$varIva = '';
$iva = '';

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
$id_pedido 		= $row3['pedido_id'];
$nombre_pedido 	= $row3['nombre_pedido'];
$nombre_cliente = $row3['nombres'];
$id_cliente 	= $row3['id'];
$estado 		= $row3['estado'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select pp.peproducto_id as idproducto, pp.producto as producto, pp.valoru as valoru, pp.cantidad as cantidad, pp.valort as valort from pedidos p inner join pedidoProductos pp inner join clientes c on p.pedido_id = pp.pedido_id and pp.cliente_id = c.id where p.pedido_id = '$id' order by pp.peproducto_id ASC");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['producto'] 	. "</td>
				<td>" 	. 	$row['cantidad'] 	. "</td>
				<td align='right'>$ " . number_format($row['valort'], 0, ",", ".") 	. "</td>
				<td>
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

$query4 = mysqli_query($result,'select * from items order by iditems');
$row4 = $query4->fetch_assoc();

$grupo = $row4['grupo'];

// Se contruye el HTML para imprimirlo mas adelante.

$html="<!DOCTYPE html>
<head>
<title>Pedido</title>
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
<link rel='stylesheet' type='text/css' href='../../css/style.css' />
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
	open(url,'','top=50,left=50,width=900,height=600') ; 
	}
</script>
<!-- //tables -->
</head>
<body class='dashboard-page'>

		<div class='main-grid'>
			<div class='agile-grids'>	
				
				<div class='table-heading'>
					<h2>$nombre_cliente</h2>
				</div>
				<div class='forms'>
					<div class='form-two widget-shadow'>
						<div class='row mb40'>
							
							<div class='col-md-2'>
								<div class='ordenes pizza'> 
									<a href='#' onclick='javascript:abrir(\"veritem.php?id=1\")'>
						 				<h1>Pizzas</h1>
						 			</a>
								</div>
							</div>
							<div class='col-md-2'>
								<div class='ordenes carnes'> 
									<a href='#' onclick='javascript:abrir(\"veritem.php?id=2\")'>
						 				<h1>Carnes</h1>
						 			</a>
								</div>
							</div>
							<div class='col-md-2'>
								<div class='ordenes otros'> 
									<a href='#' onclick='javascript:abrir(\"veritem.php?id=3\")'>
						 				<h1>Otros</h1>
						 			</a>
								</div>
							</div>
							<div class='col-md-2'>
								<div class='ordenes bebidas'> 
									<a href='#' onclick='javascript:abrir(\"veritem.php?id=4\")'>
						 				<h1>Bebidas</h1>
						 			</a>
								</div>
							</div>
							<div class='col-md-2'>
							</div>
							<div class='col-md-2'>
								<div class='ordenes pagos'> 
									<a href='#' onclick='javascript:abrir(\"veritem.php?id=" . $grupo . "\")'>
						 				<h1>Pago</h1>
						 			</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='agile-tables'>
					<div class='w3l-table-info'>
					    <table id='table'>
						<thead>
						  <tr>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>V.Total</th>
							<th>Eliminar</th>
						  </tr>
						</thead>
						<tbody>
						  ". 
						  $tr
						  .
						  "
						<tr>
							<td colspan='2'></td>
							<td><b>TOTAL</b></td>
							<td align='left'>$ " . $valorPedido . "</td>
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
