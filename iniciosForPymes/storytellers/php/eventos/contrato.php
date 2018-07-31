<?php
require_once "../conexion.php";

$conex = new conection();
$result = $conex->conex();


$html="<!DOCTYPE html>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<title>Cotización</title>
	<link rel='stylesheet' type='text/css' href='../../css/informes/style.css' media='screen' />
	<link rel='stylesheet' type='text/css' href='../../css/informes/print.css' media='print' />
</head>
<body>
	<div class='hoja'>
		<div class='logo'><img src='../../images/logoInformes.png'></div>
		<div class='imprimir'><a href=javascript:window.print();>Imprimir</a></div>
		<div class='titulo'><h3>CONTRATO DE PRESTACIÓN DE SERVICIOS LOGÍSTICOS DE EVENTO SOCIAL</h3></div>

		<div class='parrafo'>Por una parte INVERSIONES TP S.A.S, sociedad identificada con NIT. No 900999387 representada legalmente por DAVID PINEDA DUQUE, mayor de edad,
		identificado con Cédula	de Ciudadanía No 1.037.616.900 quien para efectos de este documento se denominará EL CONTRATISTA y por otro lado MARIA ORTIZ, identificado con
		Cedula de Ciudadanía No 43222252 persona igualmente mayor de edad quien en adelante se denominará EL CONTRATANTE. Han decidido celebrar el Presente Contrato de
		Prestación de Servicios Logísticos de Evento Social el cual se regirá por las siguientes cláusulas:</div>

		<div class='parrafo'><b>PRIMERA. OBJETO. EL CONTRATISTA</b> prestará los servicios de logística en el inmueble de su propiedad llamado Casa Cartagena, ubicado en
		Rionegro, para lo cual dispondrádel todos los recursos necesarios para su desarrollo de acuerdo con la etiqueta del evento. Adicionalmente ofrecerá parqueadero para 50
		carros y espacio al aire libre.</div>

		<div class='parrafo'><b>SEGUNDA. PERSONAL. El CONTRATISTA</b> tendrá su propio personal bajo su exclusiva subordinación y dependencia laboral, salarial y de seguridad
		social, quien será personal	idóneo para cumplir con el objeto de este contrato.</div>

		<div class='parrafo'><b>TERCERA. SERVICIOS.</b> El servicio ofrecido por el CONTRATISTA consta de:</div>
		
		// INGRESAR TABLA


		<div class='parrafo2'>PARAGRAFO 1. El menú a ofrecer será acordado previamente, según las opciones ofrecidas por el CONTRATISTA, incluyendo la prueba del mismo.</div>
		<div class='parrafo2'>PARAGRAFO 2. El CONTRATANTE tendrá exclusividad con el CONTRATISTA para la prestación de servicios de alimentación mencionadas a continuación: entradas, plato fuerte, pasabocas y mesa de sal.</div>


		<div class='parrafo'><b>CUARTA. VALOR DEL SERVICIO. Él CONTRATANTE</b> cancelará al CONTRATISTA por el servicio de alimentación y logística la suma de Ochenta y Tres Mil Trescientos Treinta y Cuatro Pesos Con Cero Centavos($ 83334) por persona. Para un total de Diez Millones Un Pesos Con Cero Centavos ($ 10000001) para 120 personas. Los cuáles serán cancelados de la siguiente manera:</div>

		//LISTADO DE ABONO Y PAGOS<br /><br />
		1.	Abono de $ 500000<br />
		2.	Julio $ 1357143<br />
		3.	Agosto $ 1357143<br />
		4.	Septiembre$ Septiembre<br />
		5.	Octubre$ Octubre<br />
		6.	Noviembre$ 1.357.143<br />
		7.	Diciembre$ 1.357.143`<br />
		8.	Enero$ 1.357.143<br />
		9.	$ <br />


		<div class='parrafo2'>PARAGRAFO. El costo por persona adicional será de Cincuenta y Seis Mil Cuatrocientos Treinta y Siete Pesos Con Treinta y Tres Centavos ($ 56437,3333).</div>

		<div class='parrafo'><b>QUINTA. HORARIO Y OBJETO DE LA PRESTACIÓN DEL SERVICIO.</b> Se destinará a la realización y celebración de la boda de Maria & Humberto, para un mínimo de Ciento veinte (120) personas, dicho servicio se prestará el día 2/2/2019 a las 6:00:00 PM. Hasta las 2:00:00 AM. Del 2/3/2019.</div>
		<div class='parrafo2'>PARAGRAFO 1. El número total de personas a participar del evento, será confirmado por EL CONTRATANTE a más tardar un mes antes del evento.</div>
		<div class='parrafo2'>PARAGRAFO 2. El valor de la hora adicional es de $ 6.000 por persona según la cantidad de invitados en la confirmación final, basados en el parágrafo anterior.</div>

		<div class='parrafo'><b>SEXTA OBLIGACIONES DE LAS PARTES.</b></div>
		<div class='parrafo'><b>6.1 OBLIGACIONES DEL CONTRATISTA: EL CONTRATISTA</b> se obliga a con las siguientes: 1. Ejecutar debidamente y bajo el principio de buena fe, el servicio de alimentación y logística que mediante este documento se contrata, 2. Tener a su personal con uniformes idóneos para las labores del servicio, al igual que suministrarles los elementos necesarios para la ejecución de sus labores, 3. Atender las recomendaciones que el CONTRATANTE  le haga respecto al servicio desarrollado y las labores de su personal, 4. Se obliga a entregar el inmueble aseado con todos sus servicios de energía, alcantarillado y acueducto entre otros servicios que dice en la tercera cláusula de servicios al CONTRATANTE o a la persona designada por este para recibirlo. 5 Para tal efecto, las partes firmarán un acta en la que se haga constar el estado en el que se recibe el Inmueble (paredes, pisos, puertas, ventanas, instalaciones sanitarias, manteles, sobre manteles, cocina con los electrodomésticos contenidos en ella y en general todo los elementos incluidos en el contrato).</div>
		<div class='parrafo'><b>6.2 OBLIGACIONES DEL CONTRATANTE: EL CONTRATANTE se obliga a: 1. Informar al CONTRATISTA inmediatamente tenga conocimiento de cualquier irregularidad con la ejecución de este contrato. 2. Pagar en su totalidad el valor del contrato, según lo acordado en la cláusula CUARTA en los tiempos definidos 3. Enviar una lista de invitados para tener el control en la entrada para mayor seguridad. 4. NO PRENDER POLVORA, globos o cualquier elemento pirotécnico e informar a los invitados del evento sobre esta restricción, dado el caso de que se incumpla este punto, el evento se cancela inmediatamente sin derecho a devoluciones. Únicamente será permitido el uso de pólvora fría. 5. NO TIRAR CONFETI y si lo hacen deben de pagar aseo adicional de $ 100.000. 6. A más tardar 4 horas antes del evento una persona designada por el CONTRATANTE o este mismo, deberá recibir el lugar y constatar todas sus condiciones en un acta de entrega, adicionalmente deberá contar y revisar el menaje; al día siguiente esa misma persona en horas de la mañana deberá volver al lugar para verificar de nuevo las condiciones y revisar si hubo daños o faltantes. En caso de que estas actividades no se lleven a cabo por el CONTRATANTE, éste no podrá hacer reclamaciones sobre los respectivos daños o faltantes que comunique el CONTRATISTA 7. En caso de que EL CONTRATANTE cuente con servicios de proveedores externos, este deberá revisar el instructivo de montaje y de desmontaje, velar para que todas las instrucciones del mismo se lleven a cabalidad y se hará responsable de que todo su personal esté asegurado. En caso de faltar alguno de estos parámetros, aplicarán penalizaciones ya descritas en dichos instructivos. 8. EL CONTRATANTE será el responsable sobre los daños causados por el personal de servicio de mesa y bar Independientemente de la forma de contrato, puesto que la prestación de los servicios esta sobre su evento.
		<div class='parrafo'><b>PARAGRAFO:</b> Si el montaje es responsabilidad completa del CONTRATISTA, el CONTRATANTE podrá hacer caso omiso a estos instructivos.</div>

		<div class='parrafo'><b>SEPTIMA. RESPONSABILIDAD DE LAS PARTES.</b></div>
		<div class='parrafo'><b>7.1 RESPONSABILIDAD DEL CONTRATISTA</b></div>
		<div class='parrafo'><b>1. El CONTRATISTA</b> no se hace responsable por robos que tengan lugar en el Inmueble o en los vehículos estacionados en el mismo, ni por los deterioros de los vehículos en caso de choque, rayones o cualquier otro a que hubiere lugar, como tampoco se hará responsable por la seguridad de los asistentes al EVENTO. 2. Teniendo en cuenta que EL CONTRATISTA no es productor, distribuidor, proveedor y no tiene relación de ningún tipo frente al licor que se distribuirá en EL EVENTO, no se hace responsable por cualquier situación que pueda derivarse de su distribución y consumo. Igualmente, EL CONTRATISTA no se hace responsable por la distribución de licor a menores de edad. De esta forma EL CONTRATANTE exonera expresamente de cualquier daño que se pueda sufrir por circunstancias inherentes al licor utilizado en el EVENTO. 3.  El CONTRATISTA se hace responsable por la calidad y el estado de los alimentos proporcionados en el evento siempre y cuando sean suministrados por este mismo. En caso de una intoxicación la póliza de responsabilidad civil lo cubre. El CONTRATISTA queda exonerado de toda responsabilidad si el CONTRATANTE toma los servicios de Alimentos & Bebidas con otros proveedores debido al desconocimiento de la procedencia de los mismos.</div>
		<div class='parrafo'><b>7.2 RESPONSABILIDADES DEL CONTRATANTE</b></div>
		<div class='parrafo'><b>1. El CONTRATANTE</b> será responsable de los daños causados por los asistentes del evento. Por tal motivo deberá entregar ocho (8) días antes del evento, un depósito de un millón de pesos ($ 1´000.000) para cubrir los posibles daños. El depósito será restituido al CONTRATANTE en su totalidad, a más tardar el segundo día hábil posterior a la fecha del EVENTO, siempre que no haya habido daños. En caso de presentarse daños imputables al CONTRATANTE, éstos se evaluarán en conjunto por las Partes o por sus representantes y se hará una cotización que deberá ser aprobada por ambas partes. En este último caso, y de presentarse un saldo a favor del CONTRATANTE, se devolverá al día siguiente de la reparación. En caso de que los daños superen el monto del depósito, el CONTRATANTE deberá asumir el pago total de los mismos.</div>

		<div class='parrafo'><b>OCTAVA. EXCLUSION.</b></div>
		<div class='parrafo'><b>El CONTRATANTE</b>, no será responsable de las obligaciones o acreencias de carácter civil, comercial o laboral que EL CONTRATISTA contraiga con su personal para la ejecución del presente contrato.</div>
		<div class='parrafo'><b>PARÁGRAFO:</b> Se deja claramente establecido que entre las partes no existe relación laboral, pues el presente es un contrato civil y <b>EL CONTRATANTE</b> desconoce la forma de vinculación y/o contratación entre EL CONTRATISTA y sus empleados y por lo tanto, solo se entenderá con EL CONTRATISTA.</div>

		<div class='parrafo'><b>NOVENA.</b> Reprogramación o cancelación del EVENTO.</div>
		<div class='parrafo'>En caso de que por cualquier motivo, independiente de su naturaleza, el CONTRATANTE se viera obligado a reprogramar la fecha del EVENTO, deberá notificar al <b>CONTRATISTA</b> con un mínimo de seis (6) meses de anticipación para que no se cobre penalidad alguna.  Las Partes podrán de mutuo acuerdo y por escrito establecer una nueva fecha para la realización del EVENTO, pero esto podrá hacerse una sola vez. En ningún caso podrá hacerse devolución del primer depósito.</div>

		<div class='parrafo'><b>Parágrafo 1</b>. En caso de que el preaviso de la reprogramación se dé por fuera del término estipulado en esta cláusula, se procederá así:</div>

		<div class='parrafo'>Si el preaviso se da por debajo de los seis (6) meses y hasta los dos (2) meses anteriores a la fecha programada para el EVENTO, <b>EL CONTRATISTA buscará arrendar nuevamente la fecha. En caso que EL CONTRATISTA consiga arrendar nuevamente la fecha, se imputará el 20% del VALOR DEL CONTRATO a título de perjuicios; en caso de quedar el CONTRATANTE con un saldo a favor, este podrá ser utilizado para la nueva fecha arrendada. 
		En caso que no sea posible arrendar nuevamente la fecha, el CONTRATISTA imputará el 50% del VALOR DEL CONTRATO a título de perjuicios, por lo cual dicho dinero no será restituido a EL CONTRATANTE. En caso de quedar el CONTRATANTE con un saldo a favor, este podrá ser utilizado para la reprogramación de una nueva fecha según disponibilidad. 
		EL CONTRATANTE tendrá derecho a reprogramar una sola vez. En caso de que la reprogramación no sea posible, EL CONTRATISTA se quedara con el 100% del anticipo.  

		Parágrafo 2. En caso de que EL CONTRATANTE se viera obligado a cancelar definitivamente EL EVENTO, se procederá así:

		1.	Si esta cancelación se hace con seis (6) meses de anticipación al evento ésta podrá ceder para la misma fecha el presente contrato a otro interesado en tomar su fecha, sin que dicha cesión genere para EL CONTRATANTE, la obligación de pagar multa o indemnización alguna al CONTRATISTA y el valor previamente cancelado por EL CONTRATANTE será restituido en su totalidad en el momento que el cesionario de la fecha consigne el anticipo. 
		2.	Si el preaviso se da por debajo de los seis (6) meses EL CONTRATISTA se quedará con el 50% del VALOR DEL CONTRATO.
		3.	Si el preaviso se da por debajo de los dos (2) meses EL CONTRATISTA se quedará con el 100% del VALOR DEL CONTRATO.

		Parágrafo 3. Si por caso fortuito o de fuerza mayor el evento no puede realizarse por culpa del CONTRATISTA; EL CONTRATISTA deberá acordar entre las partes una nueva fecha para la realización del evento o la devolución de dinero pagado a la fecha, en caso de la devolución del dinero, EL CONTRATISTA le otorgará al CONTRATANTE una compensación equivalente al 10% del valor pagado a la fecha.

		Parágrafo 4. El CONTRATISTA tendrá la autoridad para cancelar el evento en ejecución si hay algún tipo de encuentro violento durante el desarrollo del mismo.

		 DECIMA. MÉRITO EJECUTIVO. 
		El presente contrato presta mérito ejecutivo para el cobro de las obligaciones aquí consagradas. Las partes renuncian de forma previa a cualquier requerimiento en mora. 

		Se firma en Rionegro - Antioquia, el __________.



		 


		 
		_________________________		                               
		EL CONTRATISTA
		Representante Legal de Inversiones TP S.A.S. NIT: 900999387-7
		DAVID PINEDA DUQUE 		    Cedula de Ciudadanía 1.037.6169.00
		___________________________
		EL CONTRATANTE 
		MARIA ORTIZ
		Cedula de Ciudadanía 43222252
 </div>
		<div class='firma'><p>Atentamente,<br /><br />CEL: <br />Tel: </p></div>
	</div>
</body>
</html>";

echo $html;


 
