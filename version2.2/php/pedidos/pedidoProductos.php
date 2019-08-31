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

if ($idrol == 0) {
	include "../menu.php";
}else{
	include "../menu2.php";
}

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_GET['id'];

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query3 = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, p.estado as estado from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row3=$query3->fetch_assoc();
$id_pedido 		= $row3['pedido_id'];
$nombre_pedido 	= $row3['nombre_pedido'];
$nombre_cliente = $row3['nombres'];
$id_cliente 	= $row3['id'];
$estado 		= $row3['estado'];

// Realiza la consulta para ser visualizada en un tabla por medio de un While
$query = mysqli_query($result,"select pp.peproducto_id as idproducto, pp.producto as producto, pp.valoru as valoru, pp.cantidad as cantidad, pp.valort as valort from pedidos p inner join pedidoProductos pp inner join clientes c on p.pedido_id = pp.pedido_id and pp.cliente_id = c.id where p.pedido_id = '$id' order by pp.peproducto_id ASC");


 while ($row = $query->fetch_array(MYSQLI_BOTH)){

 	$valoru = ($row['valoru'] == '')? 0 : $row['valoru'];
 	$valort = ($row['valort'] == '')? 0 : $row['valort'];

 	$tr .=	"<tr class='rows' id='rows'>
				<td>" 	. 	$row['idproducto'] 	. "</td>
				<td>" 	. 	$row['producto'] 	. "</td>
				<td align='right'>$ " . number_format($valoru, 0, ",", ".") 	. "</td>
				<td>" 	. 	$row['cantidad'] 	. "</td>
				<td align='right'>$ " . number_format($valort, 0, ",", ".") 	. "</td>
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

// Utilizamos esta consulta para obtener el datos de las variables de configuracion
$query4 = mysqli_query($result, "select * from variables;");

$rows = mysqli_num_rows ($query4);  
          
if ($rows > 0)  
{  
    for ($i=0; $i<$rows; $i++)  
    {  
        $row4 = mysqli_fetch_array($query4);  
        $rows4[$i] = $row4["nombre"];  
        $datos[$rows4[$i]] = $row4["detalle"];  
    }  
              
}  

$varIva	= $datos['iva'];

// Se encarga de reemplazar los valores de subtotal e Iva.
$valorPedido = $row3['valor'];


if ($varIva == 1) {
	$valorSubTotal = $row3['valor'];
	$valorIva = $row3['valor'] * 0.19;
	$valorPedido = $valorSubTotal + $valorIva;
	$iva = "<tr>
				<td colspan='3'></td>
				<td><b>SubTotal</b></td>
				<td align='left'>$ " . number_format($valorSubTotal, 0, ",", ".") . "</td>
			</tr>
			<tr>
				<td colspan='3'></td>
				<td><b>Iva</b></td>
				<td align='left'>$ " . number_format($valorIva, 0, ",", ".") . "</td>
			</tr>";
	}else{
		$iva = "";
	};

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
					<h2>$nombre_cliente - $nombre_pedido</h2>
				</div>
				<div class='forms'>
					<div class='form-two widget-shadow'>
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
										<input type='text' name='cantidad' class='form-control' id='cantidad' required/>
									</div> 
									<button type='submit' class='btn btn-primary'>Agregar</button> 
							</div>
							<div class='col-md-3'>
									<div class='form-group'> <label>Detalles: </label> 
										<input type='text' name='detalles' class='form-control'>
									</div> 
								</form>
							</div>
							<div class='col-md-1'>
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='hacerPedido.php' method='post'>
									<input type='hidden' name='pedido_id' value='$id_pedido'>
									<div class='form-group'> <label>Valor a Cobrar: </label> 
										<input type='text' name='cobrado' class='form-control'>
									</div> 
									<button type='submit' class='btn btn-primary'>Hacer Pedido</button> 
								</form> 
							</div>
							<div class='col-md-2'>
								<form class='form-horizontal' action='cuenta_de_cobro.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'> 
									<div class='form-group'> <label>Cuenta Cobro #</label>
										<input type='hidden' name='pedido_id' value='$id_pedido'>
										<input type='text' name='nuevo_pedido_id' class='form-control' value='$id_pedido' disabled/>
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
							<th>Cod.</th>
							<th>Producto</th>
							<th>V.Unitario</th>
							<th>Cantidad</th>
							<th>V.Total</th>
							<th>Acciones</th>
						  </tr>
						</thead>
						<tbody>
						  ". 
						  $tr
						  .
						  $iva
						  ."
						<tr>
							<td colspan='3'></td>
							<td><b>TOTAL</b></td>
							<td align='left'>$ " . number_format($valorPedido, 0, ",", ".") . "</td>
						</tr>
						</tbody>
					  </table>
					</div>
				</div>
				<!-- //tables -->
				<div class='col-md-2'>
					<form class='form-horizontal' action='cotizacion.php' method='post' target='confirma' onSubmit='confirma = window.open(\"\",\"confirma\", \"top=100 left=100 width=900 height=600, status=no scrollbars=no, location=no, resizable=no, manu=no\");'>
						<label></label>
						<input type='hidden' name='pedido_id' value='$id_pedido'>
						<button type='submit' class='btn btn-primary'>Cotizacion</button> 
					</form> 
				</div>
				<div class='col-md-2'>
					<form class='form-horizontal' action='cancelarPedido.php' method='post'>
						<label></label>
						<input type='hidden' name='pedido_id' value='$id_pedido'>
						<button type='submit' class='btn btn-primary'>Cancelar Pedido</button> 
					</form> 
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
