<?php
require_once('../conexion.php');
require_once('CifrasEnLetras.php');

$conex = new conection();
$result = $conex->conex();

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id 	= $_POST['pedido_id'];
$cuotas = $_POST['copy-cuotas'];
$abono 	= $_POST['copy-abono'];

if ($abono != '') {
	
	$query = mysqli_query($result,"UPDATE cotizacion SET abono = '$abono' where pedido_id = '$id';");
	
} else if ($cuotas != '') {
	
	$query = mysqli_query($result,"UPDATE cotizacion SET cuotas = '$cuotas' where pedido_id = '$id';");

}

// Utilizamos esta consulta para obtener la información del contrato
$query = mysqli_query($result, "select * from contrato where pedido_id = '$id'");

 $conteo = mysqli_num_rows($query);

$row = $query->fetch_assoc();
$contenido = $row['contenido'];

if ($conteo == 1) {

	$query = mysqli_query($result, "select * from contrato where pedido_id = '$id'");
	$row = $query->fetch_assoc();
	$contenido = urldecode($row['contenido']);

} else {

//Se definen variables
$meses = ''; 
$count = ''; 

// Utilizamos esta consulta para obtener el nombre del cliente, del pedido y su historial
$query = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, estado, invitados, instalacion_id, sede_id, start, end, empresa, documento from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row = $query->fetch_assoc();

$nombre_pedido 	= $row['nombre_pedido'];
$nombre_empresa = $row['empresa'];
$nombre_cliente = $row['nombres'];
$documento 	 	= $row['documento'];
$id_cliente 	= $row['id'];
$estado 		= $row['estado'];
$invitados 		= $row['invitados'];
$inst_id 		= $row['instalacion_id'];
$sede_id 		= $row['sede_id'];
$fecha_inicio 	= $row['start'];
$fecha_fin 		= $row['end'];

// Utilizamos esta consulta para obtener los datos de la cotización
$query = mysqli_query($result, "select * from cotizacion where pedido_id = '$id'");
$row = $query->fetch_assoc();

$tipo_evento 		= $row['tipo_evento'];
$entrada 			= $row['entrada'];
$plato_fuerte 		= $row['plato_fuerte'];
$mezcladores 		= $row['mezcladores'];
$menaje		 		= $row['menaje'];
$personal	 		= $row['personal'];
$direccionamiento	= $row['direccionamiento'];
$licor		 		= $row['licor'];
$observaciones		= $row['observaciones'];
$valor		 		= $row['valor'];
$abono		 		= number_format($row['abono'], 0, ",", ".");
$cuotas		 		= $row['cuotas'];


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

$empresa 			= $datos['empresa'];
$tipo 				= $datos['tipo_identificacion'];
$identificacion		= $datos['identificacion'];
$lugar_expedicion	= $datos['lugar_expedicion'];
$forma_de_pago		= $datos['forma_de_pago'];
$cel				= $datos['cel'];
$tel				= $datos['tel'];

// Realiza una consultas a lista de precios
 $query = mysqli_query($result,"SELECT * FROM sede where sede_id = $inst_id");

 $row = $query->fetch_array(MYSQLI_BOTH);
 $desInstala = $row['nombre'];

 $query = mysqli_query($result,"SELECT * FROM lista_precios where id = $entrada");

 $row = $query->fetch_array(MYSQLI_BOTH);
 $desEntrada 	= $row['descripcion'];

 $query1 = mysqli_query($result,"SELECT * FROM lista_precios where id = $plato_fuerte");

 $row1 = $query1->fetch_array(MYSQLI_BOTH);
 $desPlaFuerte 	= $row1['descripcion'];
 
 $query2 = mysqli_query($result,"SELECT * FROM lista_precios where id = $mezcladores");

 $row2 = $query2->fetch_array(MYSQLI_BOTH);
 $desMezcla 	= $row2['descripcion'];

 $query3 = mysqli_query($result,"SELECT * FROM lista_precios where id = $menaje");

 $row3 = $query3->fetch_array(MYSQLI_BOTH);
 $desMenaje 	= $row3['descripcion'];

 $query4 = mysqli_query($result,"SELECT * FROM lista_precios where id = $personal");

 $row4 = $query4->fetch_array(MYSQLI_BOTH);
 $desPerServicio 	= $row4['descripcion'];

 $query5 = mysqli_query($result,"SELECT * FROM lista_precios where id = $direccionamiento");

 $row5 = $query5->fetch_array(MYSQLI_BOTH);
 $desDireccion 	= $row5['descripcion'];

 $query7 = mysqli_query($result,"SELECT * FROM lista_precios where id = $licor");

 $row7 = $query7->fetch_array(MYSQLI_BOTH);
 $desLicor 	= $row7['descripcion'];


//Toma en cuenta el abono total y lo divide por la cantidad de cuotas

 $subtotal = $valor - $abono;

 $cuota_mensual = $subtotal / $cuotas;

// Realiza una lista de cada fecha con su valor según su numero de cuotas.

 $count = 1;

 $i = 1;

 while ($count <= $cuotas){

 $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

 	$meses .=	"Cuota $count. 15 de " . $mes[date('n')-$i] . " - $ " . number_format($cuota_mensual, 0, ",", ".") . "<br />";
	
	$count++;
	$i--;
 }

 $valorPersona = $valor / $invitados;

 $hoy = date("d-m-Y");


$valorLetraPersona 	= CifrasEnLetras::convertirNumeroEnLetras($valorPersona,2);
$valorLetras 		= CifrasEnLetras::convertirNumeroEnLetras($valor,2);
$valorLetraPersona 	= CifrasEnLetras::convertirNumeroEnLetras($valorPersona,2);
$LetraPersonas 		= CifrasEnLetras::convertirNumeroEnLetras($invitados,0);

$valorPersona = number_format($valorPersona, 0, ",", ".");
$valor = number_format($valor, 0, ",", ".");

$query = mysqli_query($result, "select * from contrato_base where id = 1");

 $conteo = mysqli_num_rows($query);

$row = $query->fetch_assoc();

$contenido = urldecode($row['contrato']);

$old=array(	"-empresa-",
			"-tipo-",
			"-identificacion-",
			"-nombre_empresa-",
			"-documento-",
			"-desInstala-",
			"-desEntrada-",
			"-desPlaFuerte-",
			"-desMezcla-",
			"-desMenaje-",
			"-desPerServicio-",
			"-desDireccion-",
			"-desLicor-",
			"-valorLetraPersona-",
			"-valorPersona-",
			"-valorLetras-",
			"-invitados-",
			"-abono-",
			"-cuotas-",
			"-meses-",
			"-tipo_evento-",
			"-LetraPersonas-",
			"-fecha_inicio-",
			"-fecha_fin-",
			"-nombre_cliente-",
			"-valor-",
			"-hoy-");

$new=array(	"$empresa",
			"$tipo",
			"$identificacion",
			"$nombre_empresa",
			"$documento",
			"$desInstala",
			"$desEntrada",
			"$desPlaFuerte",
			"$desMezcla",
			"$desMenaje",
			"$desPerServicio",
			"$desDireccion",
			"$desLicor",
			"$valorLetraPersona",
			"$valorPersona",
			"$valorLetras",
			"$invitados",
			"$abono",
			"$cuotas",
			"$meses",
			"$tipo_evento",
			"$LetraPersonas",
			"$fecha_inicio",
			"$fecha_fin",
			"$nombre_cliente",
			"$valor",
			"$hoy");

$contenido = str_replace($old, $new, $contenido);
}

$query = mysqli_query($result, "select nombre_pedido, nombres, pedido_id, id, estado, invitados, instalacion_id, sede_id, start, end, empresa, documento from pedidos p inner join clientes c on p.cliente_id = c.id where pedido_id = '$id'");
$row = $query->fetch_assoc();

$id_cliente 	= $row['id'];

$html = "<!DOCTYPE html>
<html lang='en'
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>CONTRATO</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../asset/style-print.css' media='print' />
	<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
	<link rel='stylesheet' type='text/css' href='../../asset/summernote.css' rel='stylesheet' />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css'>
	<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js'></script> 
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js'></script> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.min.js'></script>
	<script type='text/javascript' src='../../asset/summernote.js'></script>
	<script type='text/javascript'>
	    $(document).ready(function() {
	      $('#table').basictable();
	    }); 
		function abrir(url) { 
		open(url,'','top=100,left=100,width=900,height=700') ; 
		}
	</script>

	</head>
<body>
	<div class='hoja' style='margin-top: 50px !important;'>
		<form action='guardarContrato.php' method='post'>
			<textarea id='summernote' name='contenido'>
			" . $contenido . "
			</textarea>
		</div>
		<div class='botones'>
			<input type='hidden' name='pedido_id' value='$id'>
			<input type='hidden' name='cliente_id' value='$id_cliente'>
			<button type='submit' id='btn' class='btn btn-primary'>Guardar</button>
			<button type='button' id='btn' class='btn btn-primary' onclick='window.location.reload();'>Actualizar</button>
			<button type='button' id='btn' class='btn btn-primary' onclick='window.close();'>Cerrar</button>
		</div>
	</form>
	</div>
	<script type='text/javascript'>
		$(document).ready(function() {
		  $('#summernote').summernote({
		  	height: 400,
        	toolbar: [
        	  ['style', ['style']],
	          ['font', ['bold', 'underline', 'clear']],
	          ['fontname', ['fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
	          ['misc', ['print']]
	        ]
		  });
		});
	</script>
	<script type='text/javascript' src='../../asset/summernote-ext-print.js'></script>
</body>
</html>";

echo $html;