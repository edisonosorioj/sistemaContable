<?php
	
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();
	
// Con el ID que se trae de productos del pedido y permite abrir un nuevo html y con información existente
$html 		= '';
$id 		= $_GET['id'];
$mesa 		= $_GET['mesa'];
$div 		= '';
$div2 		= '';
$option 	= '';
$conteo 	= 1;

$query3 = mysqli_query($result, "select pi.iditems as iditems, i.nombre as nombre, pi.nombre as tipo, pi.valor as valor, i.grupo as grupo from precio_x_item pi inner join items i on pi.iditems = i.iditems where idprecios = '$id';");
$row3	= $query3->fetch_assoc();

$iditems	= $row3['iditems'];
$nombre 	= $row3['nombre'];
$tipo 		= $row3['tipo'];
$valor 		= $row3['valor'];
$grupo 		= $row3['grupo'];


$query3 = mysqli_query($result, "select * from pedidos where pedido_id = '$mesa';");
$row3	= $query3->fetch_assoc();

$cliente_id	= $row3['cliente_id'];

if ($grupo == 1) {
	$div = "<div class='checkbox'>
			    <div class='radio'>
			        <label style='font-size: 2em'>
			            <input type='radio' name='tamano' value='0' checked>
			            <span class='cr'><i class='cr-icon fa fa-circle'></i></span>
			            Media
			        </label>
			    </div>
		    </div>
		    <div class='radio'>
		        <label style='font-size: 2em'>
					<input type='hidden' name='grupo' value='$grupo'>
		            <input type='radio' name='tamano' value='1' checked>
		            <span class='cr'><i class='cr-icon fa fa-circle'></i></span>
		            Completa
		        </label>
		    </div>
		    <br />";

	$div2 = "<div class='radio'>
	            <label style='font-size: 2em'>
	            	<b>Adiciones</b><br/>
	                	<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Maicitos' style='transform: scale(2);'>&nbsp;&nbsp;Maicitos</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Tocineta' style='transform: scale(2);'>&nbsp;&nbsp;Tocineta<br /></div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Champiñon' style='transform: scale(2);'>&nbsp;&nbsp;Champiñon</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Jamón' style='transform: scale(2);'>&nbsp;&nbsp;Jamón</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Jalapeños' style='transform: scale(2);'>&nbsp;&nbsp;Jalapeños</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Pollo' style='transform: scale(2);'>&nbsp;&nbsp;Pollo</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Albahaca' style='transform: scale(2);'>&nbsp;&nbsp;Albahaca</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Salami' style='transform: scale(2);'>&nbsp;&nbsp;Salami</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Peperoni' style='transform: scale(2);'>&nbsp;&nbsp;Peperoni</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Tomate' style='transform: scale(2);'>&nbsp;&nbsp;Tomate</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Queso' style='transform: scale(2);'>&nbsp;&nbsp;Queso</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Pasta' style='transform: scale(2);'>&nbsp;&nbsp;Pasta</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Piña' style='transform: scale(2);'>&nbsp;&nbsp;Piña</div>
	            </label>
	        </div>
			";
} else {
	$div = "<input type='hidden' name='tamano' value='1'>
			<input type='hidden' name='grupo' value='$grupo'>
			";
}

if ($iditems == 20 || $iditems == 21) {
	$div2 = "<div class='radio'>
	            <label style='font-size: 2em'>
	            	<b>Adiciones</b><br/>
	                	<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Maicitos' style='transform: scale(2);'>&nbsp;&nbsp;Maicitos</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Tocineta' style='transform: scale(2);'>&nbsp;&nbsp;Tocineta</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Champiñon' style='transform: scale(2);'>&nbsp;&nbsp;Champiñon</div>
						<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Jamón' style='transform: scale(2);'>&nbsp;&nbsp;Jamón</div>
	            </label>
	        </div>
			";
	}

if ($iditems == 23) {
	$div2 = "<div class='radio'>
	            <label style='font-size: 2em'>
	            	<b>Adiciones</b><br/>
	                <div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Maicitos' style='transform: scale(2);'>&nbsp;&nbsp;Pollo</div>
					<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Tocineta' style='transform: scale(2);'>&nbsp;&nbsp;Tocineta</div>
					<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Champiñon' style='transform: scale(2);'>&nbsp;&nbsp;Champiñon</div>
					<div style='font-size:18px; display: inline-block;'><input type='checkbox' name='adicion[]' value='Jamón' style='transform: scale(2);'>&nbsp;&nbsp;Jamón</div>
	            </label>
	        </div>
			";
	}


while ($conteo <= 20) {
	$option .= "<option value='" . $conteo . "'>" . $conteo . "</option>";
	$conteo++;
}


$html = "
<!DOCTYPE html>
<head>
<title>Pedidos</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='Administración de Negocios, Admin, Negocios' />
<!-- bootstrap-css -->
<link rel='stylesheet' href='../../css/bootstrap.css'>
<!-- //bootstrap-css -->
<link rel='stylesheet' type='text/css' href='../../css/style3.css' />
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel='stylesheet' href='../../css/font.css' type='text/css'/>
<link href='../../css/font-awesome.css' rel='stylesheet'> 
<!-- //font-awesome icons -->
<script src='../../js/jquery2.0.3.min.js'></script>
<script src='../../js/modernizr.js'></script>
<script src='../../js/jquery.cookie.js'></script>
<script src='../../js/screenfull.js'></script>
</head>
<body>
	<section>
		<div>
			<div class='agile-grids'>	
				<!-- input-forms -->
				<div class='grids'>
					<div class='progressbar-heading'>
						<h1>$nombre</h1>
					</div>
					<div style='align-content:right;'>
						<form action='addPeProductoMesas.php' method='post'>
			            	<table style='width:100%;'>
			            		<tr>
			            			<td>
				            			<input type='hidden' name='id' value='$id'>
						            	<input type='hidden' name='producto' value='$nombre'>
						            	<input type='hidden' name='detalles' value='$tipo'>
						            	<input type='hidden' name='valor' value='$valor'>
						            	<input type='hidden' name='cliente_id' value='$cliente_id'>
						            	<input type='hidden' name='pedido_id' value='$mesa'>
										".$div."
			            			</td>
			            			<td>
							            <div class='radio'>
								            <label style='font-size: 1.5em'>
								                Cantidad
								                <select name='cantidad'>
								                	" . $option . "
								                </select>
								            </label>
								        </div>
			            			</td>
			            		</tr>
			            		<tr>
			            			<td colspan='2'>
							        	".$div2."
			            			</td>
			            		</tr>
			            		<tr>
			            			<td colspan='2'>
							            <div class='radio'>
								            <label style='font-size: 1.5em'>
								                Nota<br/>
								                <textarea name='nota' cols='20' rows='3'></textarea>
								            </label>
								        </div>
							        <button type='submit' class='btn btn-default w3ls-button'>Guardar</button> 
									<button type='button' class='btn btn-default w3ls-button' onclick='window.close();'>Cancelar</button> 
			            			</td>
			            		</tr>
				            	
			            	</table>
						</form>
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