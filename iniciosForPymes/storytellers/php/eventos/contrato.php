<?php
require_once('../conexion.php');
require_once('CifrasEnLetras.php');

$conex = new conection();
$result = $conex->conex();

// Obtiene el ID enviado desde Pedido para visualizar los productos solicitados para el pedido
$id = $_POST['pedido_id'];

// Utilizamos esta consulta para obtener la información del contrato
$query = mysqli_query($result, "select * from contrato where pedido_id = '$id'");

 $conteo = mysqli_num_rows($query);

$row = $query->fetch_assoc();
$contenido = $row['contenido'];

if ($conteo == 1) {
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
$abono		 		= $row['abono'];
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


	$contenido .= "<div id='prueba'><h3 style='text-align: center;'>CONTRATO DE PRESTACIÓN DE SERVICIOS LOGÍSTICOS DE EVENTO SOCIAL</h3></div>

			<div class='parrafo'>Por una parte $empresa, sociedad identificada con $tipo. No $identificacion representada legalmente por $empresa, mayor de edad, identificado con $tipo No $identificacion quien para efectos de este documento se denominará <b>EL CONTRATISTA</b> y por otro lado $nombre_empresa, con identificación No $documento persona igualmente mayor de edad quien en adelante se denominará <b>EL CONTRATANTE</b>. Han decidido celebrar el Presente Contrato de Prestación de Servicios Logísticos de Evento Social el cual se regirá por las siguientes cláusulas:
			</div>
			
			<div class='parrafo'><b>PRIMERA. OBJETO. EL CONTRATISTA</b> prestará los servicios de logística en el inmueble de su propiedad llamado Casa Cartagena, ubicado en Rionegro, para lo cual dispondrá de todos los recursos necesarios para su desarrollo de acuerdo con la etiqueta del evento. Adicionalmente ofrecerá parqueadero para 50 carros y espacio al aire libre.</div>

			<div class='parrafo'><b>SEGUNDA. PERSONAL. El CONTRATISTA</b> tendrá su propio personal bajo su exclusiva subordinación y dependencia laboral, salarial y de seguridad social, quien será personal idóneo para cumplir con el objeto de este contrato.</div>

			<div class='parrafo'><b>TERCERA. SERVICIOS.</b> El servicio ofrecido por el CONTRATISTA consta de:</div>
			
			<div class='parrafo'>
				<table class='table-fill'>
					<tr>
						<th class='text-center' colspan='5'>Cotización</th>
					</tr>
					<tr>
						<th class='text-center'>Item</th>
						<th class='text-center'>Descripción</th>
					</tr>
					<tr>
						<td class='text-center'>Instalaciones</td>
						<td class='text-center'>$desInstala</td>
					</tr>
					<tr>
						<td class='text-center'>Entrada</td>
						<td class='text-center'>$desEntrada</td>
					</tr>
					<tr>
						<td class='text-center'>Plato fuerte</td>
						<td class='text-center'>$desPlaFuerte</td>
					</tr>
					<tr>
						<td class='text-center'>Mezcladores</td>
						<td class='text-center'>$desMezcla</td>
					</tr>
					<tr>
						<td class='text-center'>Menaje</td>
						<td class='text-center'>$desMenaje</td>
					</tr>
					<tr>
						<td class='text-center'>Personal Servicio</td>
						<td class='text-center'>$desPerServicio</td>
					</tr>
					<tr>
						<td class='text-center'>Direccionamiento del evento</td>
						<td class='text-center'>$desDireccion</td>
					</tr>
					<tr>
						<td class='text-center'>Licor</td>
						<td class='text-center'>$desLicor</td>
					</tr>
				</table>
			</div>


			<div class='parrafo2'>PARAGRAFO 1. El menú a ofrecer será acordado previamente, según las opciones ofrecidas por el CONTRATISTA, incluyendo la prueba del mismo.</div>
			<div class='parrafo2'>PARAGRAFO 2. El CONTRATANTE tendrá exclusividad con el CONTRATISTA para la prestación de servicios de alimentación mencionadas a continuación: entradas, plato fuerte, pasabocas y mesa de sal.</div>


			<div class='parrafo'><b>CUARTA. VALOR DEL SERVICIO. Él CONTRATANTE</b> cancelará al CONTRATISTA por el servicio de alimentación y logística la suma de " . $valorLetraPersona . " centavos (&#36; " . number_format($valorPersona, 0, ",", ".") . ") por persona. Para un total de " . $valorLetras . " centavos (&#36; " . number_format($valor, 0, ",", ".") . " ) para $invitados personas. Los cuáles serán cancelados de la siguiente manera:</div>

			<div class='parrafo'>
				<br />Abono de $ " . number_format($abono, 0, ",", ".") . "<br />
			Numero de Cuotas " . $cuotas . "<br /><br />
			
			" . $meses . "<br />

			</div>
			<div class='parrafo2'>PARAGRAFO. El costo por persona adicional será de " . $valorLetraPersona . " centavos (\$ " . number_format($valorPersona, 0, ",", ".") . ").</div>

			<div class='parrafo'><b>QUINTA. HORARIO Y OBJETO DE LA PRESTACIÓN DEL SERVICIO.</b> Se destinará a la realización y celebración de la boda de " . $tipo_evento . ", para un mínimo de $LetraPersonas ($invitados) personas, dicho servicio se prestará el día $fecha_inicio. Hasta el $fecha_fin.</div>
			<div class='parrafo2'>PARAGRAFO 1. El número total de personas a participar del evento, será confirmado por <b>EL CONTRATANTE</b> a más tardar un mes antes del evento.</div>
			<div class='parrafo2'>PARAGRAFO 2. El valor de la hora adicional es de &#36; 6.000 por persona según la cantidad de invitados en la confirmación final, basados en el parágrafo anterior.</div>

			<div class='parrafo'><b>SEXTA OBLIGACIONES DE LAS PARTES.</b></div>
			<div class='parrafo'><b>6.1 OBLIGACIONES DEL CONTRATISTA: EL CONTRATISTA</b> se obliga a con las siguientes: 1. Ejecutar debidamente y bajo el principio de buena fe, el servicio de alimentación y logística que mediante este documento se contrata, 2. Tener a su personal con uniformes idóneos para las labores del servicio, al igual que suministrarles los elementos necesarios para la ejecución de sus labores, 3. Atender las recomendaciones que <b>EL CONTRATANTE</b>  le haga respecto al servicio desarrollado y las labores de su personal, 4. Se obliga a entregar el inmueble aseado con todos sus servicios de energía, alcantarillado y acueducto entre otros servicios que dice en la tercera cláusula de servicios al <b>CONTRATANTE</b> o a la persona designada por este para recibirlo. 5 Para tal efecto, las partes firmarán un acta en la que se haga constar el estado en el que se recibe el Inmueble (paredes, pisos, puertas, ventanas, instalaciones sanitarias, manteles, sobre manteles, cocina con los electrodomésticos contenidos en ella y en general todo los elementos incluidos en el contrato).</div>
			<div class='parrafo'><b>6.2 OBLIGACIONES DEL CONTRATANTE: EL CONTRATANTE</b> se obliga a: 1. Informar al CONTRATISTA inmediatamente tenga conocimiento de cualquier irregularidad con la ejecución de este contrato. 2. Pagar en su totalidad el valor del contrato, según lo acordado en la cláusula CUARTA en los tiempos definidos 3. Enviar una lista de invitados para tener el control en la entrada para mayor seguridad. 4. NO PRENDER POLVORA, globos o cualquier elemento pirotécnico e informar a los invitados del evento sobre esta restricción, dado el caso de que se incumpla este punto, el evento se cancela inmediatamente sin derecho a devoluciones. Únicamente será permitido el uso de pólvora fría. 5. NO TIRAR CONFETI y si lo hacen deben de pagar aseo adicional de &#36; 100.000. 6. A más tardar 4 horas antes del evento una persona designada por el CONTRATANTE o este mismo, deberá recibir el lugar y constatar todas sus condiciones en un acta de entrega, adicionalmente deberá contar y revisar el menaje; al día siguiente esa misma persona en horas de la mañana deberá volver al lugar para verificar de nuevo las condiciones y revisar si hubo daños o faltantes. En caso de que estas actividades no se lleven a cabo por el CONTRATANTE, éste no podrá hacer reclamaciones sobre los respectivos daños o faltantes que comunique el CONTRATISTA 7. En caso de que EL CONTRATANTE cuente con servicios de proveedores externos, este deberá revisar el instructivo de montaje y de desmontaje, velar para que todas las instrucciones del mismo se lleven a cabalidad y se hará responsable de que todo su personal esté asegurado. En caso de faltar alguno de estos parámetros, aplicarán penalizaciones ya descritas en dichos instructivos. 8. EL CONTRATANTE será el responsable sobre los daños causados por el personal de servicio de mesa y bar Independientemente de la forma de contrato, puesto que la prestación de los servicios esta sobre su evento.
			<div class='parrafo'><b>PARAGRAFO:</b> Si el montaje es responsabilidad completa del CONTRATISTA, el CONTRATANTE podrá hacer caso omiso a estos instructivos.</div>

			<div class='parrafo'><b>SEPTIMA. RESPONSABILIDAD DE LAS PARTES.</b></div>
			<div class='parrafo'><b>7.1 RESPONSABILIDAD DEL CONTRATISTA</b></div>
			<div class='parrafo'><b>1. El CONTRATISTA</b> no se hace responsable por robos que tengan lugar en el Inmueble o en los vehículos estacionados en el mismo, ni por los deterioros de los vehículos en caso de choque, rayones o cualquier otro a que hubiere lugar, como tampoco se hará responsable por la seguridad de los asistentes al EVENTO. 2. Teniendo en cuenta que EL <b>CONTRATISTA</b> no es productor, distribuidor, proveedor y no tiene relación de ningún tipo frente al licor que se distribuirá en EL EVENTO, no se hace responsable por cualquier situación que pueda derivarse de su distribución y consumo. Igualmente, EL <b>CONTRATISTA</b> no se hace responsable por la distribución de licor a menores de edad. De esta forma EL CONTRATANTE exonera expresamente de cualquier daño que se pueda sufrir por circunstancias inherentes al licor utilizado en el EVENTO. 3.  El <b>CONTRATISTA</b> se hace responsable por la calidad y el estado de los alimentos proporcionados en el evento siempre y cuando sean suministrados por este mismo. En caso de una intoxicación la póliza de responsabilidad civil lo cubre. El <b>CONTRATISTA</b> queda exonerado de toda responsabilidad si el CONTRATANTE toma los servicios de Alimentos & Bebidas con otros proveedores debido al desconocimiento de la procedencia de los mismos.</div>
			<div class='parrafo'><b>7.2 RESPONSABILIDADES DEL CONTRATANTE</b></div>
			<div class='parrafo'><b>1. El CONTRATANTE</b> será responsable de los daños causados por los asistentes del evento. Por tal motivo deberá entregar ocho (8) días antes del evento, un depósito de un millón de pesos (&#36; 1´000.000) para cubrir los posibles daños. El depósito será restituido al CONTRATANTE en su totalidad, a más tardar el segundo día hábil posterior a la fecha del EVENTO, siempre que no haya habido daños. En caso de presentarse daños imputables al CONTRATANTE, éstos se evaluarán en conjunto por las Partes o por sus representantes y se hará una cotización que deberá ser aprobada por ambas partes. En este último caso, y de presentarse un saldo a favor del CONTRATANTE, se devolverá al día siguiente de la reparación. En caso de que los daños superen el monto del depósito, el CONTRATANTE deberá asumir el pago total de los mismos.</div>

			<div class='parrafo'><b>OCTAVA. EXCLUSION.</b></div>
			<div class='parrafo'><b>El CONTRATANTE</b>, no será responsable de las obligaciones o acreencias de carácter civil, comercial o laboral que EL <b>CONTRATISTA</b> contraiga con su personal para la ejecución del presente contrato.</div>
			<div class='parrafo'><b>PARÁGRAFO:</b> Se deja claramente establecido que entre las partes no existe relación laboral, pues el presente es un contrato civil y <b>EL CONTRATANTE</b> desconoce la forma de vinculación y/o contratación entre EL <b>CONTRATISTA</b> y sus empleados y por lo tanto, solo se entenderá con EL <b>CONTRATISTA</b>.</div>

			<div class='parrafo'><b>NOVENA.</b> Reprogramación o cancelación del EVENTO.</div>
			<div class='parrafo'>En caso de que por cualquier motivo, independiente de su naturaleza, el CONTRATANTE se viera obligado a reprogramar la fecha del EVENTO, deberá notificar al <b>CONTRATISTA</b> con un mínimo de seis (6) meses de anticipación para que no se cobre penalidad alguna.  Las Partes podrán de mutuo acuerdo y por escrito establecer una nueva fecha para la realización del EVENTO, pero esto podrá hacerse una sola vez. En ningún caso podrá hacerse devolución del primer depósito.</div>

			<div class='parrafo'><b>Parágrafo 1</b>. En caso de que el preaviso de la reprogramación se dé por fuera del término estipulado en esta cláusula, se procederá así:</div>

			<div class='parrafo'>Si el preaviso se da por debajo de los seis (6) meses y hasta los dos (2) meses anteriores a la fecha programada para el EVENTO, <b>EL CONTRATISTA</b> buscará arrendar nuevamente la fecha. En caso que EL CONTRATISTA consiga arrendar nuevamente la fecha, se imputará el 20% del VALOR DEL CONTRATO a título de perjuicios; en caso de quedar el <b>CONTRATANTE</b> con un saldo a favor, este podrá ser utilizado para la nueva fecha arrendada.</div>
			<div class='parrafo'>En caso que no sea posible arrendar nuevamente la fecha, el <b>CONTRATISTA</b> imputará el 50% del VALOR DEL CONTRATO a título de perjuicios, por lo cual dicho dinero no será restituido a <b>EL CONTRATANTE</b>. En caso de quedar <b>EL CONTRATANTE</b> con un saldo a favor, este podrá ser utilizado para la reprogramación de una nueva fecha según disponibilidad.</b>
			<div class='parrafo'><b>EL CONTRATANTE</b> tendrá derecho a reprogramar una sola vez. En caso de que la reprogramación no sea posible, <b>EL CONTRATISTA</b> se quedara con el 100% del anticipo.  

			<div class='parrafo'>Parágrafo 2. En caso de que EL <b>CONTRATANTE</b> se viera obligado a cancelar definitivamente EL EVENTO, se procederá así:</b>

			<div class='parrafo2'><b>1.</b>	Si esta cancelación se hace con seis (6) meses de anticipación al evento ésta podrá ceder para la misma fecha el presente contrato a otro interesado en tomar su fecha, sin que dicha cesión genere para <b>EL CONTRATANTE</b>, la obligación de pagar multa o indemnización alguna al <b>CONTRATISTA</b> y el valor previamente cancelado por <b>EL CONTRATANTE</b> será restituido en su totalidad en el momento que el cesionario de la fecha consigne el anticipo.</div>
			<div class='parrafo2'><b>2.</b>	Si el preaviso se da por debajo de los seis (6) meses EL <b>CONTRATISTA</b> se quedará con el 50% del <b>VALOR DEL CONTRATO.</b></div>
			<div class='parrafo2'><b>3.</b>	Si el preaviso se da por debajo de los dos (2) meses EL <b>CONTRATISTA</b> se quedará con el 100% del <b>VALOR DEL CONTRATO.</b></div>

			<div class='parrafo'>Parágrafo 3. Si por caso fortuito o de fuerza mayor el evento no puede realizarse por culpa del <b>CONTRATISTA</b>; EL <b>CONTRATISTA</b> deberá acordar entre las partes una nueva fecha para la realización del evento o la devolución de dinero pagado a la fecha, en caso de la devolución del dinero, EL <b>CONTRATISTA</b> le otorgará al <b>CONTRATANTE</b> una compensación equivalente al 10% del valor pagado a la fecha.</div>

			<div class='parrafo'>Parágrafo 4. El <b>CONTRATISTA</b> tendrá la autoridad para cancelar el evento en ejecución si hay algún tipo de encuentro violento durante el desarrollo del mismo.</div>

			 <div class='parrafo'><b>DECIMA. MÉRITO EJECUTIVO.</b></div>
			<div class='parrafo'>El presente contrato presta mérito ejecutivo para el cobro de las obligaciones aquí consagradas. Las partes renuncian de forma previa a cualquier requerimiento en mora.</div>

			<div class='parrafo'>Se firma en Rionegro - Antioquia, el $hoy.</div>

			<div class='table'>
				<table class='table-fill'>
					<tr>
						<td class='text-center text-big'>
						</br></br></br></br><b>___________________________</br>
						EL CONTRATISTA</br>
						Representante Legal de Inversiones</br>
						TP S.A.S. NIT: 900999387-7</br>
						DAVID PINEDA DUQUE</br>
						CC 1.037.6169.00</b>
						</td>
						<td class='text-center text-big'>
						</br></br></br><b>___________________________</br>
						EL CONTRATANTE </br>
						$nombre_cliente</br>
						CC $documento</b>
						</td>
					</tr>
				</table>
			</div>";
}



$html="<!DOCTYPE html>
<html lang='es'
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>CONTRATO</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
	<link href='http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css' rel='stylesheet'>
	<link href='../../asset/summernote.css' rel='stylesheet'>

	<script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js'></script> 
	<script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js'></script> 
	<script type='text/javascript' src='../../asset/summernote.js'></script>
	<script type='text/javascript' src='../../asset/summernote-ext-print.js'></script>
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
		  $('#summernote').summernote();
		});
	</script>
</body>
</html>";

echo $html;