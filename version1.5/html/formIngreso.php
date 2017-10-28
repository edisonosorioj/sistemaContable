<?php
if( !session_id() )
{
    session_start();
}
require_once '../php/conexion.php';

$conex = new conection();
$result = $conex->conex();

$option='';

$query = mysqli_query($result,'select * from productos order by idproductos');

while ($row = $query->fetch_array()){

	 	$option .=	"<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";

 }


$html = "<html>
			<head>
				<meta charset='UTF-8' />
				<meta name='viewport' content='width=device-width'/>
				<title>Agregar Ingreso</title>
				<script src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
				<script src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
				<script src='http://code.jquery.com/ui/1.11.3/jquery-ui.min.js'></script>
				<link rel='stylesheet' href='../../css/reset.css' />
				<link rel='stylesheet' href='../../css/estilos.css' />
				<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet'>
			</head>
			<body>
			<form method='post' action='../ingresos/addIngreso.php' id='formadd'>
				<input type='hidden' name='fecha' value='" . date('Y-m-d') . "' disabled='disabled'>
				<input type='number' name='cantidad' placeholder='Cantidad'>
				<input type='producto' name='producto' placeholder='Producto'>
				<input type='text' name='detalles' placeholder='Detalles'>
				<input type='number' name='valor' placeholder='Valor'><br />
				<input type='submit' name='agregar' id='enviarform' value='Guardar'>
				<input type='reset' name='reset' value='Limpiar'>
				<input type='button' onclick='hideForm()' name='cancelar' value='Cancelar'>
				<a href='../cliente/clientes.php' class='menu'>Abono Cliente</a>
			</form>
			</body>
			<script src='../../js/acciones.js'></script>
		</html>";

echo $html;