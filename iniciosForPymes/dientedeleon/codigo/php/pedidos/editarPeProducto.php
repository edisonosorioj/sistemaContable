<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$id=$_GET['id'];

$query = mysqli_query($result, "select * from pedidoProductos where peProducto_id ='$id'");

$row = $query->fetch_assoc();

$pedido_id = $row['pedido_id'];
$cantidad = $row['cantidad'];

$query3 = mysqli_query($result, "select * from pedidos where pedido_id = '$pedido_id'");

$row3 = $query3->fetch_assoc();

$estado = $row3['estado'];

if ($estado == 1) {
	 
	$msg = "El pedido ya fue realizado, no es posible cambiar los productos. Si desea cambiarlos debe cancelarlo primero el pedido y despues realizar de nuevo el procedimiento";

	$html = "<script>
		window.alert('$msg');
		window.close();
	</script>";

	echo $html;	
}else{

$option='';

$query2 = mysqli_query($result,'select * from productos order by nombres ASC');

$producto = $row['producto'];

while ($row2 = $query2->fetch_array()){

	 	$option .=	"<option value='" . $row2['idproducto'] . "'>" . $row2['nombres'] . "</option>";
	}


$option2='';

$query2 = mysqli_query($result,'select * from tipoProducto order by nombre ASC');

while ($row2 = $query2->fetch_array()){

	 	$option2 .=	"<option value='" . $row3['idtipo'] . "'>" . $row3['nombre'] . "</option>";
	}
	
$html = "
<!-- Se crea el HTML con la información del Pedido -->
<!DOCTYPE html>
<head>
<title>Editar Producto del Pedido</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Administración de Negocios, Admin, Negocios' />
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
		
</head>
<body class='dashboard-page'>

	<section class='wrapper scrollable'>
		<div class='main-grid'>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading grids-heading'>
						<h2>Editar Producto del Pedido</h2>
					</div>
					<div class='panel panel-widget forms-panel'>
						<div class='forms'>
							<div class='form-grids widget-shadow' data-example-id='basic-forms'> 
								<div class='form-title'>
									<h4>Datos Básicos :</h4>
								</div>
								<div class='form-body'>
									<form action='actPeProducto.php' method='post'>

										<div class='form-group'> 
											<input type='hidden' name='id' value='$id' class='form-control'> 
										</div>
										<div class='form-group'> 
											<label>Producto Actual</label> 
											<input type='text' name='producto_actual' class='form-control' value='$producto' disabled> 
										</div> 
										<div class='form-group'> 
											<label>Producto</label> 
											<select name='nuevo_producto' class='form-control1'>
												<option value='Seleccionar'>Seleccionar</option>
												$option
											</select>
										</div> 
										<div class='form-group'> 
											<label>Tipo Producto</label> 
											<select name='nuevo_tipo' class='form-control1'>
												<option value='Seleccionar'>Seleccionar</option>
												$option2
											</select>
										</div> 
										<div class='form-group'> 
											<label>Detalles</label> 
											<input type='text' name='detalles' class='form-control' placeholder='Nuevos detalles'> 
										</div> 
										<div class='form-group'> 
											<label>Cantidad</label> 
											<input type='text' name='cantidad' class='form-control' placeholder='Cantidad' value='$cantidad'> 
										</div>

										<button type='submit' class='btn btn-default w3ls-button'>Guardar</button> 
										<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button> 
									</form> 
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- //input-forms -->
			</div>
		</div>
	</section>
	<script src='../../js/bootstrap.js'></script>
	<script src='../../js/proton.js'></script>
</body>
</html>";

echo $html;
}